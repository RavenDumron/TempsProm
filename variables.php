<?php

// Récupération des variables à l'aide du client MySQL
$SQLclients = $mysqlClient->prepare('SELECT * FROM clients');
$SQLclients->execute();
$clients = $SQLclients->fetchAll();

// vérifie si une année a été sélectionnée, autrement prend l'année en cours
// vérifie également si la date actuelle se situe entre octobre et décembre, afin de sélectionner la bonne année fiscale
$getData = $_GET;

if (!isset($getData['year'])) {
    if (date('m')>=10) {
        $year1 = date('Y');
    }
    else $year1 = (date('Y')-1);

}

elseif (!is_numeric($getData['year'])) {
    if (date('m')>=10) {
        $year1 = date('Y');
    }
    else $year1 = (date('Y')-1);
}

else $year1 = $getData['year'];

$year2 = ($year1 + 1);

// définit les dates de début et de fin pour l'année fiscale
$yearStart = $year1 . '-10-1';
$yearEnd = $year2 . '-9-30';

// récupération des contrats dans la base SQL pour l'année sélectionnée
$SQLcontracts = $mysqlClient->prepare(
    "SELECT 
        c.clients_nom, 
        cc.clients_contrat_ouverture,
        cc.clients_contrat_fermeture,
        cc.clients_contrat_prix_vente_ht
    FROM clients_contrat cc 
    INNER JOIN clients c 
    ON cc.clients_id = c.clients_id 
    WHERE cc.clients_contrat_fermeture >= :yearStart AND cc.clients_contrat_ouverture <= :yearEnd
    ORDER BY c.clients_nom ASC"
    );

$SQLcontracts ->execute([
    'yearStart' => $yearStart,
    'yearEnd' => $yearEnd,
]);

$contracts = $SQLcontracts->fetchAll();

// initialisation du tableau pour recueillir les contrats rassemblés par entreprise
$contractsCombined = [];

// compilation des contracts avec une seule entrée par entreprise, qui comprend à la fois le compte de mois et le budget pour contract 1 et contrat 2
foreach ($contracts as $contract) {
    $clientName = $contract['clients_nom'];
    
    // Vérifie si une ligne existe déjà pour l'entreprise, sinon l'initialise
    if (!isset($contractsCombined[$clientName])) {
        $contractsCombined[$clientName] = [
            'clients_nom' => $clientName,
            'contract1Budget' => null,
            'contract1Months' => null,
            'contract1Start' => null,            
            'contract1End' => null,
            'contract2Budget' => null,
            'contract2Months' => null,
            'contract2Start' => null,
            'contract2End' => null,
        ];
    }

    // remplissage des contrats : 
    // calcule combien de mois occupe chaque contrat
    // recalcule le budget par mois en proportion de cela
    // assigne une date de début ou de fin de contrat pour pouvoir déterminer quelle valeur prendre en compte selon l'onglet
    if ($contract['clients_contrat_ouverture'] > $yearStart) {
        // si le contrat démarre après le début de l'année fiscale, on l'assigne à contrat 2
        $contractsCombined[$clientName]['contract2Months'] = calculateMonthsRoundedUp($contract['clients_contrat_ouverture'], $yearEnd);
        $contractsCombined[$clientName]['contract2Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined[$clientName]['contract2Months']);
        $contractsCombined[$clientName]['contract2Start'] = $contract['clients_contrat_ouverture'];
        $contractsCombined[$clientName]['contract2End'] = $contract['clients_contrat_fermeture'];
    } elseif ($contract['clients_contrat_fermeture'] < $yearEnd) {
        // si le contrat finit avant la fin de l'année fiscale, on l'assigne à contrat 1
        $contractsCombined[$clientName]['contract1Months'] = calculateMonthsRoundedUp($yearStart, $contract['clients_contrat_fermeture']);
        $contractsCombined[$clientName]['contract1Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined[$clientName]['contract1Months']);
        $contractsCombined[$clientName]['contract1Start'] = $contract['clients_contrat_ouverture'];
        $contractsCombined[$clientName]['contract1End'] = $contract['clients_contrat_fermeture'];
    } else {
        // si le contrat englobe toute l'année fiscale, on l'assigne à contrat 1 par défaut
        if (is_null($contractsCombined[$clientName]['contract1Budget'])) {
            $contractsCombined[$clientName]['contract1Months'] = calculateMonthsRoundedUp($yearStart, $contract['clients_contrat_fermeture']);
            $contractsCombined[$clientName]['contract1Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined[$clientName]['contract1Months']);
            $contractsCombined[$clientName]['contract1Start'] = $contract['clients_contrat_ouverture'];
            $contractsCombined[$clientName]['contract1End'] = $contract['clients_contrat_fermeture'];
        } else {
            // on assigne à contrat 2 si contrat 1 est déjà rempli
            $contractsCombined[$clientName]['contract2Months'] = calculateMonthsRoundedUp($contract['clients_contrat_ouverture'], $yearEnd);
            $contractsCombined[$clientName]['contract2Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined[$clientName]['contract2Months']);
            $contractsCombined[$clientName]['contract2Start'] = $contract['clients_contrat_ouverture'];
            $contractsCombined[$clientName]['contract2End'] = $contract['clients_contrat_fermeture'];
        }
    }
}

// calcule la somme de tous les budgets
$totalBudget0 = (array_sum(array_column($contractsCombined, 'contract1Budget')) + array_sum(array_column($contractsCombined, 'contract2Budget')));

// initialisation de tableaux de budgets totaux pour chaque mois
for ($loopCounter = 1; $loopCounter <=12; $loopCounter++) {
    ${'totalBudget' . $loopCounter} = 0;
} 

// récupération des interventions dans la base SQL pour l'année sélectionnée en séparant par type d'intérvention
$SQLyearExtract = $mysqlClient->prepare(
    "SELECT 
        c.clients_nom, 
        i.intervention_date_debut, 
        i.intervention_date_fin, 
        i.intervention_lib,
        t.techniciens_nom,
        t.techniciens_prenom,
        CASE WHEN i.intervention_type_id = '1' THEN TIME_TO_SEC (i.intervention_temp) ELSE NULL END AS 'temps_infogerance', 
        CASE WHEN i.intervention_type_id IN ('2', '6', '9', '12','13') THEN TIME_TO_SEC (i.intervention_temp) ELSE NULL END AS 'temps_hm'
    FROM intervention i 
    INNER JOIN clients c 
    ON i.clients_id = c.clients_id 
    INNER JOIN techniciens t 
    ON i.techniciens_id = t.techniciens_id
    WHERE 
        (DATE (i.intervention_date_debut) BETWEEN :yearStart AND :yearEnd) 
        AND i.intervention_type_id IN ('1', '2', '6', '9', '12','13')
    ORDER BY c.clients_nom ASC"
    );

// exécution en utilisant les dates d'année fiscale définies plus haut
$SQLyearExtract ->execute([
    'yearStart' => $yearStart,
    'yearEnd' => $yearEnd,
]);
        
$extract0 = $SQLyearExtract->fetchAll();

// initialisation de tableaux pour chaque mois, où 1=janvier, 2=février, etc. 
for ($loopCounter = 1; $loopCounter <=12; $loopCounter++) {
    ${'extract' . $loopCounter} = [];
} 

// Boucle pour scinder les données de l'année ($extract0) en 12 en remplissant chaque tableau de mois ($extract1-12) individuellement
foreach ($extract0 as $intervention) {
    $month = date('m', strtotime($intervention['intervention_date_debut']));
    
    switch ($month) {
        case '01':
            $extract1[] = $intervention;
            break;
        case '02':
            $extract2[] = $intervention;
            break;
        case '03':
            $extract3[] = $intervention;
            break;
        case '04':
            $extract4[] = $intervention;
            break;
        case '05':
            $extract5[] = $intervention;
            break;
        case '06':
            $extract6[] = $intervention;
            break;
        case '07':
            $extract7[] = $intervention;
            break;
        case '08':
            $extract8[] = $intervention;
            break;
        case '09':
            $extract9[] = $intervention;
            break;
        case '10':
            $extract10[] = $intervention;
            break;
        case '11':
            $extract11[] = $intervention;
            break;
        case '12':
            $extract12[] = $intervention;
            break;
    }
}

// initialisation de tableaux pour cumuler les temps de chaque client, où 0=année sélectionnée, 1=janvier, 2=février, etc. 
for ($loopCounter = 0; $loopCounter <=12; $loopCounter++) {
    ${'sum' . $loopCounter} = [];
} 

// compteur pour la boucle de cumul des temps clients
$sumCounter = 0;

        
// cumule les temps de chaque client dans $sum# pour afficher un seul temps d'infogérance et hors mission par client
// incrémente en commençant par le tableau de l'année, puis de chaque mois 
// /!\ Attention, l'ordre des mois est celui calendaire, donc 1-9 sont année n+1, et 10-12 année n
// fait également la somme totale du temps d'infogérance et HM dans $TotalSumIn# et $TotalSumHM#
while ($sumCounter < 13)
{
    foreach(${'extract' . $sumCounter} as $currentSum){
        if(array_key_exists($currentSum['clients_nom'],${'sum' . $sumCounter})){
            ${'sum' . $sumCounter}[$currentSum['clients_nom']]['temps_infogerance'] += $currentSum['temps_infogerance'];
            ${'sum' . $sumCounter}[$currentSum['clients_nom']]['temps_hm'] += $currentSum['temps_hm'];
            ${'sum' . $sumCounter}[$currentSum['clients_nom']]['clients_nom'] = $currentSum['clients_nom'];
        }
        else{
            ${'sum' . $sumCounter}[$currentSum['clients_nom']]  = $currentSum;
        }
    }
    ${'sum' . $sumCounter}['Prometech']['temps_infogerance'] = '0';
    ${'TotalSumIn' . $sumCounter} = array_sum(array_column(${'sum' . $sumCounter}, 'temps_infogerance'));
    ${'TotalSumHM' . $sumCounter} = array_sum(array_column(${'sum' . $sumCounter}, 'temps_hm'));
    $sumCounter++;
}

//Compteur pour les onglets, 0 = la période annuelle sélectionnée, 1-12 étant le mois dans l'ordre calendaire
//Est incrémenté directement par les onglets
$tabCounter = 0;


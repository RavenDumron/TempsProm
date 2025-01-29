<?php

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');

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

// initialisation du tableau pour recueillir les contrats rassemblés par entreprise pour l'année
$contractsCombined0 = [];

// compilation des contracts avec une seule entrée par entreprise, qui comprend à la fois le compte de mois et le budget pour contract 1 et contrat 2
foreach ($contracts as $contract) {
    $clientName = $contract['clients_nom'];
    
    // Vérifie si une ligne existe déjà pour l'entreprise, sinon l'initialise
    if (!isset($contractsCombined0[$clientName])) {
        $contractsCombined0[$clientName] = [
            'clients_nom' => $clientName,
            'contract1Budget' => null,
            'contract1Months' => null,
            'contract1Start' => null,            
            'contract1End' => null,
            'contract2Budget' => null,
            'contract2Months' => null,
            'contract2Start' => null,
            'contract2End' => null,
            'totalBudget' => 0,
            'totalTime' => null,
        ];
    }

    // remplissage des contrats : 
    // calcule combien de mois occupe chaque contrat
    // recalcule le budget par mois en proportion de cela
    // assigne une date de début ou de fin de contrat pour pouvoir déterminer quelle valeur prendre en compte selon l'onglet
    if ($contract['clients_contrat_ouverture'] > $yearStart) {
        // si le contrat démarre après le début de l'année fiscale, on l'assigne à contrat 2
        $contractsCombined0[$clientName]['contract2Months'] = calculateMonthsRoundedUp($contract['clients_contrat_ouverture'], $yearEnd);
        $contractsCombined0[$clientName]['contract2Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined0[$clientName]['contract2Months']);
        $contractsCombined0[$clientName]['contract2Start'] = $contract['clients_contrat_ouverture'];
        $contractsCombined0[$clientName]['contract2End'] = $contract['clients_contrat_fermeture'];
    } elseif ($contract['clients_contrat_fermeture'] < $yearEnd) {
        // si le contrat finit avant la fin de l'année fiscale, on l'assigne à contrat 1
        $contractsCombined0[$clientName]['contract1Months'] = calculateMonthsRoundedUp($yearStart, $contract['clients_contrat_fermeture']);
        $contractsCombined0[$clientName]['contract1Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined0[$clientName]['contract1Months']);
        $contractsCombined0[$clientName]['contract1Start'] = $contract['clients_contrat_ouverture'];
        $contractsCombined0[$clientName]['contract1End'] = $contract['clients_contrat_fermeture'];
    } else {
        // si le contrat englobe toute l'année fiscale, on l'assigne à contrat 1 par défaut
        if (is_null($contractsCombined0[$clientName]['contract1Budget'])) {
            $contractsCombined0[$clientName]['contract1Months'] = calculateMonthsRoundedUp($yearStart, $contract['clients_contrat_fermeture']);
            $contractsCombined0[$clientName]['contract1Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined0[$clientName]['contract1Months']);
            $contractsCombined0[$clientName]['contract1Start'] = $contract['clients_contrat_ouverture'];
            $contractsCombined0[$clientName]['contract1End'] = $contract['clients_contrat_fermeture'];
        } else {
            // on assigne à contrat 2 si contrat 1 est déjà rempli
            $contractsCombined0[$clientName]['contract2Months'] = calculateMonthsRoundedUp($contract['clients_contrat_ouverture'], $yearEnd);
            $contractsCombined0[$clientName]['contract2Budget'] = ($contract['clients_contrat_prix_vente_ht'] /12 * $contractsCombined0[$clientName]['contract2Months']);
            $contractsCombined0[$clientName]['contract2Start'] = $contract['clients_contrat_ouverture'];
            $contractsCombined0[$clientName]['contract2End'] = $contract['clients_contrat_fermeture'];
        }
    }
}

for ($loopCounter = 1; $loopCounter <=12; $loopCounter++) {
    ${'contractsCombined' . $loopCounter} = [];
    if ($loopCounter <=9) {
        $currentMonth = $year2 . '-0' . $loopCounter . '-05';
    }
    else {
        $currentMonth = $year1 . '-' . $loopCounter . '-05';
    }
echo $currentMonth;
}

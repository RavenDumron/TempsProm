<?php

// Récupération des variables à l'aide du client MySQL
$SQLclients = $mysqlClient->prepare('SELECT * FROM clients');
$SQLclients->execute();
$clients = $SQLclients->fetchAll();

//vérifie si une année a été sélectionnée, autrement prend l'année en cours
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

// définit les dates de début et de fin pour l'année
$yearStart = $year1 . '-10-1';
$yearEnd = $year2 . '-9-30';

//récupération des données dans la base SQL pour l'année sélectionnée en séparant 
$SQLyearExtract = $mysqlClient->prepare(
    "SELECT 
        c.clients_nom, 
        i.intervention_date_debut, 
        CASE WHEN i.intervention_type_id = '1' THEN TIME_TO_SEC (i.intervention_temp) ELSE NULL END AS 'temps_infogerance', 
        CASE WHEN i.intervention_type_id IN ('2', '6', '9', '12','13') THEN TIME_TO_SEC (i.intervention_temp) ELSE NULL END AS 'temps_hm'
    FROM intervention i 
    INNER JOIN clients c 
    ON i.clients_id = c.clients_id 
    WHERE 
        (DATE (i.intervention_date_debut) BETWEEN :yearStart AND :yearEnd) 
        AND i.intervention_type_id IN ('1', '2', '6', '9', '12','13')
    ORDER BY c.clients_nom ASC"
    );

$SQLyearExtract ->execute([
    'yearStart' => $yearStart,
    'yearEnd' => $yearEnd,
]);
        
$yearExtract = $SQLyearExtract->fetchAll();

// initialisation des tableaux pour chaque mois
$october = [];
$november = [];
$december = [];
$january = [];
$february = [];
$march = [];
$april = [];
$may = [];
$june = [];
$july = [];
$august = [];
$september = [];

// Boucle pour remplir chaque tableau de mois individuellement
foreach ($yearExtract as $intervention) {
    $month = date('m', strtotime($intervention['intervention_date_debut']));
    
    switch ($month) {
        case '10':
            $october[] = $intervention;
            break;
        case '11':
            $november[] = $intervention;
            break;
        case '12':
            $december[] = $intervention;
            break;
        case '01':
            $january[] = $intervention;
            break;
        case '02':
            $february[] = $intervention;
            break;
        case '03':
            $march[] = $intervention;
            break;
        case '04':
            $april[] = $intervention;
            break;
        case '05':
            $may[] = $intervention;
            break;
        case '06':
            $june[] = $intervention;
            break;
        case '07':
            $july[] = $intervention;
            break;
        case '08':
            $august[] = $intervention;
            break;
        case '09':
            $september[] = $intervention;
            break;
    }
}

        
//cumule les temps de chaque client pour afficher un seul temps d'infogérance et hors mission par client

$year_sum  = array();
foreach($yearExtract as $sum0){
    if(array_key_exists($sum0['clients_nom'],$year_sum)){
        $year_sum[$sum0['clients_nom']]['temps_infogerance'] += $sum0['temps_infogerance'];
        $year_sum[$sum0['clients_nom']]['temps_hm'] += $sum0['temps_hm'];
        $year_sum[$sum0['clients_nom']]['clients_nom'] = $sum0['clients_nom'];
    }
    else{
        $year_sum[$sum0['clients_nom']]  = $sum0;
    }
}
$year_sum['Prometech']['temps_infogerance'] = '0';

$oct_sum  = array();
foreach($october as $sum1){
    if(array_key_exists($sum1['clients_nom'],$oct_sum)){
        $oct_sum[$sum1['clients_nom']]['temps_infogerance'] += $sum1['temps_infogerance'];
        $oct_sum[$sum1['clients_nom']]['temps_hm'] += $sum1['temps_hm'];
        $oct_sum[$sum1['clients_nom']]['clients_nom'] = $sum1['clients_nom'];
    }
    else{
        $oct_sum[$sum1['clients_nom']]  = $sum1;
    }
}
$oct_sum['Prometech']['temps_infogerance'] = '0';

$nov_sum  = array();
foreach($november as $sum2){
    if(array_key_exists($sum2['clients_nom'],$nov_sum)){
        $nov_sum[$sum2['clients_nom']]['temps_infogerance'] += $sum2['temps_infogerance'];
        $nov_sum[$sum2['clients_nom']]['temps_hm'] += $sum2['temps_hm'];
        $nov_sum[$sum2['clients_nom']]['clients_nom'] = $sum2['clients_nom'];
    }
    else{
        $nov_sum[$sum2['clients_nom']]  = $sum2;
    }
}
$nov_sum['Prometech']['temps_infogerance'] = '0';

$dec_sum  = array();
foreach($december as $sum3){
    if(array_key_exists($sum3['clients_nom'],$dec_sum)){
        $dec_sum[$sum3['clients_nom']]['temps_infogerance'] += $sum3['temps_infogerance'];
        $dec_sum[$sum3['clients_nom']]['temps_hm'] += $sum3['temps_hm'];
        $dec_sum[$sum3['clients_nom']]['clients_nom'] = $sum3['clients_nom'];
    }
    else{
        $dec_sum[$sum3['clients_nom']]  = $sum3;
    }
}
$dec_sum['Prometech']['temps_infogerance'] = '0';

$jan_sum  = array();
foreach($january as $sum4){
    if(array_key_exists($sum4['clients_nom'],$jan_sum)){
        $jan_sum[$sum4['clients_nom']]['temps_infogerance'] += $sum4['temps_infogerance'];
        $jan_sum[$sum4['clients_nom']]['temps_hm'] += $sum4['temps_hm'];
        $jan_sum[$sum4['clients_nom']]['clients_nom'] = $sum4['clients_nom'];
    }
    else{
        $jan_sum[$sum4['clients_nom']]  = $sum4;
    }
}
$jan_sum['Prometech']['temps_infogerance'] = '0';

$feb_sum  = array();
foreach($february as $sum5){
    if(array_key_exists($sum5['clients_nom'],$feb_sum)){
        $feb_sum[$sum5['clients_nom']]['temps_infogerance'] += $sum5['temps_infogerance'];
        $feb_sum[$sum5['clients_nom']]['temps_hm'] += $sum5['temps_hm'];
        $feb_sum[$sum5['clients_nom']]['clients_nom'] = $sum5['clients_nom'];
    }
    else{
        $feb_sum[$sum5['clients_nom']]  = $sum5;
    }
}
$feb_sum['Prometech']['temps_infogerance'] = '0';

$mar_sum  = array();
foreach($march as $sum6){
    if(array_key_exists($sum6['clients_nom'],$mar_sum)){
        $mar_sum[$sum6['clients_nom']]['temps_infogerance'] += $sum6['temps_infogerance'];
        $mar_sum[$sum6['clients_nom']]['temps_hm'] += $sum6['temps_hm'];
        $mar_sum[$sum6['clients_nom']]['clients_nom'] = $sum6['clients_nom'];
    }
    else{
        $mar_sum[$sum6['clients_nom']]  = $sum6;
    }
}
$mar_sum['Prometech']['temps_infogerance'] = '0';

$apr_sum  = array();
foreach($april as $sum7){
    if(array_key_exists($sum7['clients_nom'],$apr_sum)){
        $apr_sum[$sum7['clients_nom']]['temps_infogerance'] += $sum7['temps_infogerance'];
        $apr_sum[$sum7['clients_nom']]['temps_hm'] += $sum7['temps_hm'];
        $apr_sum[$sum7['clients_nom']]['clients_nom'] = $sum7['clients_nom'];
    }
    else{
        $apr_sum[$sum7['clients_nom']]  = $sum7;
    }
}
$apr_sum['Prometech']['temps_infogerance'] = '0';

$may_sum  = array();
foreach($may as $sum8){
    if(array_key_exists($sum8['clients_nom'],$may_sum)){
        $may_sum[$sum8['clients_nom']]['temps_infogerance'] += $sum8['temps_infogerance'];
        $may_sum[$sum8['clients_nom']]['temps_hm'] += $sum8['temps_hm'];
        $may_sum[$sum8['clients_nom']]['clients_nom'] = $sum8['clients_nom'];
    }
    else{
        $may_sum[$sum8['clients_nom']]  = $sum8;
    }
}
$may_sum['Prometech']['temps_infogerance'] = '0';

$jun_sum  = array();
foreach($june as $sum9){
    if(array_key_exists($sum9['clients_nom'],$jun_sum)){
        $jun_sum[$sum9['clients_nom']]['temps_infogerance'] += $sum9['temps_infogerance'];
        $jun_sum[$sum9['clients_nom']]['temps_hm'] += $sum9['temps_hm'];
        $jun_sum[$sum9['clients_nom']]['clients_nom'] = $sum9['clients_nom'];
    }
    else{
        $jun_sum[$sum9['clients_nom']]  = $sum9;
    }
}
$jun_sum['Prometech']['temps_infogerance'] = '0';

$jul_sum  = array();
foreach($july as $sum10){
    if(array_key_exists($sum10['clients_nom'],$jul_sum)){
        $jul_sum[$sum10['clients_nom']]['temps_infogerance'] += $sum10['temps_infogerance'];
        $jul_sum[$sum10['clients_nom']]['temps_hm'] += $sum10['temps_hm'];
        $jul_sum[$sum10['clients_nom']]['clients_nom'] = $sum10['clients_nom'];
    }
    else{
        $jul_sum[$sum10['clients_nom']]  = $sum10;
    }
}
$jul_sum['Prometech']['temps_infogerance'] = '0';

$aug_sum  = array();
foreach($august as $sum11){
    if(array_key_exists($sum11['clients_nom'],$aug_sum)){
        $aug_sum[$sum11['clients_nom']]['temps_infogerance'] += $sum11['temps_infogerance'];
        $aug_sum[$sum11['clients_nom']]['temps_hm'] += $sum11['temps_hm'];
        $aug_sum[$sum11['clients_nom']]['clients_nom'] = $sum11['clients_nom'];
    }
    else{
        $aug_sum[$sum11['clients_nom']]  = $sum11;
    }
}
$aug_sum['Prometech']['temps_infogerance'] = '0';

$sep_sum  = array();
foreach($september as $sum12){
    if(array_key_exists($sum12['clients_nom'],$sep_sum)){
        $sep_sum[$sum12['clients_nom']]['temps_infogerance'] += $sum12['temps_infogerance'];
        $sep_sum[$sum12['clients_nom']]['temps_hm'] += $sum12['temps_hm'];
        $sep_sum[$sum12['clients_nom']]['clients_nom'] = $sum12['clients_nom'];
    }
    else{
        $sep_sum[$sum12['clients_nom']]  = $sum12;
    }
}
$sep_sum['Prometech']['temps_infogerance'] = '0';

//Calcul du total de l'ensemble des temps d'infogérance
$yearlyTotalSumIn = array_sum(array_column($year_sum, 'temps_infogerance'));
$octoberTotalSumIn = array_sum(array_column($oct_sum, 'temps_infogerance'));
$novemberTotalSumIn = array_sum(array_column($nov_sum, 'temps_infogerance'));
$decemberTotalSumIn = array_sum(array_column($dec_sum, 'temps_infogerance'));      
$januaryTotalSumIn = array_sum(array_column($jan_sum, 'temps_infogerance'));
$februaryTotalSumIn = array_sum(array_column($feb_sum, 'temps_infogerance'));
$marchTotalSumIn = array_sum(array_column($mar_sum, 'temps_infogerance'));
$aprilTotalSumIn = array_sum(array_column($apr_sum, 'temps_infogerance'));
$mayTotalSumIn = array_sum(array_column($may_sum, 'temps_infogerance'));
$juneTotalSumIn = array_sum(array_column($jun_sum, 'temps_infogerance'));
$julyTotalSumIn = array_sum(array_column($jul_sum, 'temps_infogerance'));
$augustTotalSumIn = array_sum(array_column($aug_sum, 'temps_infogerance'));
$septemberTotalSumIn = array_sum(array_column($sep_sum, 'temps_infogerance'));

//Calcul du total de l'ensemble des temps hors mission
$yearlyTotalSumHM = array_sum(array_column($year_sum, 'temps_hm'));
$octoberTotalSumHM = array_sum(array_column($oct_sum, 'temps_hm'));
$novemberTotalSumHM = array_sum(array_column($nov_sum, 'temps_hm'));
$decemberTotalSumHM = array_sum(array_column($dec_sum, 'temps_hm'));      
$januaryTotalSumHM = array_sum(array_column($jan_sum, 'temps_hm'));
$februaryTotalSumHM = array_sum(array_column($feb_sum, 'temps_hm'));
$marchTotalSumHM = array_sum(array_column($mar_sum, 'temps_hm'));
$aprilTotalSumHM = array_sum(array_column($apr_sum, 'temps_hm'));
$mayTotalSumHM = array_sum(array_column($may_sum, 'temps_hm'));
$juneTotalSumHM = array_sum(array_column($jun_sum, 'temps_hm'));
$julyTotalSumHM = array_sum(array_column($jul_sum, 'temps_hm'));
$augustTotalSumHM = array_sum(array_column($aug_sum, 'temps_hm'));
$septemberTotalSumHM = array_sum(array_column($sep_sum, 'temps_hm'));

//ébauche de fonction pour faire toutes les sommes en une seule boucle
//function clientSum (array $monthArray, array $month_client_sum): array {
   // $year_sum  = array();
   // $oct_sum  = array();
   // $nov_sum  = array();
   // $dec_sum  = array();
   // $jan_sum  = array();
   // $feb_sum  = array();
   // $mar_sum  = array();
   // $apr_sum  = array();
   // $may_sum  = array();
   // $jun_sum  = array();
   // $jul_sum  = array();
   // $aug_sum  = array();
   // $sep_sum  = array();
   // $month_client_sum = [$year_sum, $oct_sum, $nov_sum, $dec_sum, $jan_sum, $feb_sum, $mar_sum, $apr_sum, $may_sum, $jun_sum, $jul_sum, $aug_sum, $sep_sum];


//}
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

//récupération des données dans la base SQL pour l'année sélectionnée
$SQLyearExtract = $mysqlClient->prepare(
    "SELECT i.total_time, c.name, i.intervention_start
    FROM interventions i 
    INNER JOIN clients c 
    ON i.client_id = c.client_id 
    WHERE DATE (i.intervention_start) BETWEEN :yearStart AND :yearEnd
    ORDER BY c.name ASC"
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
    $month = date('m', strtotime($intervention['intervention_start']));
    
    switch ($month) {
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
        case '10':
            $october[] = $intervention;
            break;
        case '11':
            $november[] = $intervention;
            break;
        case '12':
            $december[] = $intervention;
            break;
    }
}

        
//cumule les temps de chaque client pour afficher un seul résultat   
$oct_sum  = array();
foreach($october as $sum1){
    if(array_key_exists($sum1['name'],$oct_sum)){
        $oct_sum[$sum1['name']]['total_time'] += $sum1['total_time'];
        $oct_sum[$sum1['name']]['name'] = $sum1['name'];
    }
    else{
        $oct_sum[$sum1['name']]  = $sum1;
    }
}

$nov_sum  = array();
foreach($november as $sum2){
    if(array_key_exists($sum2['name'],$nov_sum)){
        $nov_sum[$sum2['name']]['total_time'] += $sum2['total_time'];
        $nov_sum[$sum2['name']]['name'] = $sum2['name'];
    }
    else{
        $nov_sum[$sum2['name']]  = $sum2;
    }
}

$dec_sum  = array();
foreach($december as $sum3){
    if(array_key_exists($sum3['name'],$dec_sum)){
        $dec_sum[$sum3['name']]['total_time'] += $sum3['total_time'];
        $dec_sum[$sum3['name']]['name'] = $sum3['name'];
    }
    else{
        $dec_sum[$sum3['name']]  = $sum3;
    }
}

$jan_sum  = array();
foreach($january as $sum4){
    if(array_key_exists($sum4['name'],$jan_sum)){
        $jan_sum[$sum4['name']]['total_time'] += $sum4['total_time'];
        $jan_sum[$sum4['name']]['name'] = $sum4['name'];
    }
    else{
        $jan_sum[$sum4['name']]  = $sum4;
    }
}

$feb_sum  = array();
foreach($february as $sum5){
    if(array_key_exists($sum2['name'],$feb_sum)){
        $feb_sum[$sum5['name']]['total_time'] += $sum5['total_time'];
        $feb_sum[$sum5['name']]['name'] = $sum5['name'];
    }
    else{
        $feb_sum[$sum5['name']]  = $sum5;
    }
}

$mar_sum  = array();
foreach($march as $sum6){
    if(array_key_exists($sum6['name'],$mar_sum)){
        $mar_sum[$sum6['name']]['total_time'] += $sum6['total_time'];
        $mar_sum[$sum6['name']]['name'] = $sum6['name'];
    }
    else{
        $mar_sum[$sum6['name']]  = $sum6;
    }
}

$apr_sum  = array();
foreach($april as $sum7){
    if(array_key_exists($sum7['name'],$apr_sum)){
        $apr_sum[$sum7['name']]['total_time'] += $sum7['total_time'];
        $apr_sum[$sum7['name']]['name'] = $sum7['name'];
    }
    else{
        $apr_sum[$sum7['name']]  = $sum7;
    }
}

$may_sum  = array();
foreach($may as $sum8){
    if(array_key_exists($sum8['name'],$may_sum)){
        $may_sum[$sum8['name']]['total_time'] += $sum8['total_time'];
        $may_sum[$sum8['name']]['name'] = $sum8['name'];
    }
    else{
        $may_sum[$sum8['name']]  = $sum8;
    }
}

$jun_sum  = array();
foreach($june as $sum9){
    if(array_key_exists($sum9['name'],$jun_sum)){
        $jun_sum[$sum9['name']]['total_time'] += $sum9['total_time'];
        $jun_sum[$sum9['name']]['name'] = $sum9['name'];
    }
    else{
        $jun_sum[$sum9['name']]  = $sum9;
    }
}

$jul_sum  = array();
foreach($july as $sum10){
    if(array_key_exists($sum10['name'],$jul_sum)){
        $jul_sum[$sum10['name']]['total_time'] += $sum10['total_time'];
        $jul_sum[$sum10['name']]['name'] = $sum10['name'];
    }
    else{
        $jul_sum[$sum10['name']]  = $sum10;
    }
}

$aug_sum  = array();
foreach($august as $sum11){
    if(array_key_exists($sum11['name'],$aug_sum)){
        $aug_sum[$sum11['name']]['total_time'] += $sum11['total_time'];
        $aug_sum[$sum11['name']]['name'] = $sum11['name'];
    }
    else{
        $aug_sum[$sum11['name']]  = $sum11;
    }
}

$sep_sum  = array();
foreach($september as $sum12){
    if(array_key_exists($sum12['name'],$sep_sum)){
        $sep_sum[$sum12['name']]['total_time'] += $sum12['total_time'];
        $sep_sum[$sum12['name']]['name'] = $sum12['name'];
    }
    else{
        $sep_sum[$sum12['name']]  = $sum12;
    }
}

//Calcul du total de l'ensemble des temps  
$octoberTotalSum = array_sum(array_column($oct_sum, 'total_time'));
$novemberTotalSum = array_sum(array_column($nov_sum, 'total_time'));
$decemberTotalSum = array_sum(array_column($dec_sum, 'total_time'));      
$januaryTotalSum = array_sum(array_column($jan_sum, 'total_time'));
$februaryTotalSum = array_sum(array_column($feb_sum, 'total_time'));
$marchTotalSum = array_sum(array_column($mar_sum, 'total_time'));
$aprilTotalSum = array_sum(array_column($apr_sum, 'total_time'));
$mayTotalSum = array_sum(array_column($may_sum, 'total_time'));
$juneTotalSum = array_sum(array_column($jun_sum, 'total_time'));
$julyTotalSum = array_sum(array_column($jul_sum, 'total_time'));
$augustTotalSum = array_sum(array_column($aug_sum, 'total_time'));
$septemberTotalSum = array_sum(array_column($sep_sum, 'total_time'));


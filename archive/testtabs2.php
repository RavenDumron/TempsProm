<?php

//inclusions des variables et de la config SQL
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');	

//vérifie si une année a été sélectionnée, autrement prend l'année en cours
$getData = $_GET;

if (!isset($getData['year'])) {
    $year = date('Y');

}

elseif (!is_numeric($getData['year'])) {
    $year = date('Y');
}

else $year = $getData['year'];

// définit les dates de début et de fin pour l'année
$yearStart = $year . '-1-1';
$yearEnd = $year . '-12-31';

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
$january = [];
$february = [];
$march = [];
$april = [];
$may = [];
$june = [];
$july = [];
$august = [];
$september = [];
$october = [];
$november = [];
$december = [];

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
$jan_sum  = array();
foreach($january as $sum1){
    if(array_key_exists($sum1['name'],$jan_sum)){
        $jan_sum[$sum1['name']]['total_time'] += $sum1['total_time'];
        $jan_sum[$sum1['name']]['name'] = $sum1['name'];
    }
    else{
        $jan_sum[$sum1['name']]  = $sum1;
    }
}

$feb_sum  = array();
foreach($february as $sum2){
    if(array_key_exists($sum2['name'],$feb_sum)){
        $feb_sum[$sum2['name']]['total_time'] += $sum2['total_time'];
        $feb_sum[$sum2['name']]['name'] = $sum2['name'];
    }
    else{
        $feb_sum[$sum1['name']]  = $sum2;
    }
}

$mar_sum  = array();
foreach($march as $sum3){
    if(array_key_exists($sum3['name'],$mar_sum)){
        $mar_sum[$sum3['name']]['total_time'] += $sum3['total_time'];
        $mar_sum[$sum2['name']]['name'] = $sum3['name'];
    }
    else{
        $mar_sum[$sum1['name']]  = $sum3;
    }
}

$apr_sum  = array();
foreach($april as $sum4){
    if(array_key_exists($sum4['name'],$apr_sum)){
        $apr_sum[$sum4['name']]['total_time'] += $sum4['total_time'];
        $apr_sum[$sum4['name']]['name'] = $sum4['name'];
    }
    else{
        $apr_sum[$sum4['name']]  = $sum4;
    }
}

$may_sum  = array();
foreach($may as $sum5){
    if(array_key_exists($sum5['name'],$may_sum)){
        $may_sum[$sum5['name']]['total_time'] += $sum5['total_time'];
        $may_sum[$sum5['name']]['name'] = $sum5['name'];
    }
    else{
        $may_sum[$sum5['name']]  = $sum5;
    }
}

$jun_sum  = array();
foreach($june as $sum6){
    if(array_key_exists($sum6['name'],$jun_sum)){
        $jun_sum[$sum6['name']]['total_time'] += $sum6['total_time'];
        $jun_sum[$sum6['name']]['name'] = $sum6['name'];
    }
    else{
        $jun_sum[$sum6['name']]  = $sum6;
    }
}

$jul_sum  = array();
foreach($july as $sum7){
    if(array_key_exists($sum7['name'],$jul_sum)){
        $jul_sum[$sum7['name']]['total_time'] += $sum7['total_time'];
        $jul_sum[$sum7['name']]['name'] = $sum7['name'];
    }
    else{
        $jul_sum[$sum7['name']]  = $sum7;
    }
}

$aug_sum  = array();
foreach($august as $sum8){
    if(array_key_exists($sum8['name'],$aug_sum)){
        $aug_sum[$sum8['name']]['total_time'] += $sum8['total_time'];
        $aug_sum[$sum8['name']]['name'] = $sum8['name'];
    }
    else{
        $aug_sum[$sum8['name']]  = $sum8;
    }
}

$sep_sum  = array();
foreach($september as $sum9){
    if(array_key_exists($sum9['name'],$sep_sum)){
        $sep_sum[$sum9['name']]['total_time'] += $sum9['total_time'];
        $sep_sum[$sum9['name']]['name'] = $sum9['name'];
    }
    else{
        $sep_sum[$sum9['name']]  = $sum9;
    }
}

$oct_sum  = array();
foreach($october as $sum10){
    if(array_key_exists($sum10['name'],$oct_sum)){
        $oct_sum[$sum10['name']]['total_time'] += $sum10['total_time'];
        $oct_sum[$sum10['name']]['name'] = $sum10['name'];
    }
    else{
        $oct_sum[$sum10['name']]  = $sum10;
    }
}

$nov_sum  = array();
foreach($november as $sum11){
    if(array_key_exists($sum11['name'],$nov_sum)){
        $nov_sum[$sum11['name']]['total_time'] += $sum11['total_time'];
        $nov_sum[$sum11['name']]['name'] = $sum11['name'];
    }
    else{
        $nov_sum[$sum11['name']]  = $sum11;
    }
}

$dec_sum  = array();
foreach($december as $sum12){
    if(array_key_exists($sum12['name'],$dec_sum)){
        $dec_sum[$sum12['name']]['total_time'] += $sum12['total_time'];
        $dec_sum[$sum12['name']]['name'] = $sum12['name'];
    }
    else{
        $dec_sum[$sum12['name']]  = $sum12;
    }
}

//Calcul du total de l'ensemble des temps        
$januaryTotalSum = array_sum(array_column($jan_sum, 'total_time'));
$februaryTotalSum = array_sum(array_column($feb_sum, 'total_time'));
$marchTotalSum = array_sum(array_column($mar_sum, 'total_time'));
$aprilTotalSum = array_sum(array_column($apr_sum, 'total_time'));
$mayTotalSum = array_sum(array_column($may_sum, 'total_time'));
$juneTotalSum = array_sum(array_column($jun_sum, 'total_time'));
$julyTotalSum = array_sum(array_column($jul_sum, 'total_time'));
$augustTotalSum = array_sum(array_column($aug_sum, 'total_time'));
$septemberTotalSum = array_sum(array_column($sep_sum, 'total_time'));
$octoberTotalSum = array_sum(array_column($oct_sum, 'total_time'));
$novemberTotalSum = array_sum(array_column($nov_sum, 'total_time'));
$decemberTotalSum = array_sum(array_column($dec_sum, 'total_time'));

?>

<!DOCTYPE html><html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test onglets</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
</head>
<body>

 <!--liste des onglets proposés-->
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Janvier</a></li>
    <li><a href="#tabs-2">Février</a></li>
    <li><a href="#tabs-3">Mars</a></li>
    <li><a href="#tabs-4">Avril</a></li>
    <li><a href="#tabs-5">Mai</a></li>
    <li><a href="#tabs-6">Juin</a></li>
    <li><a href="#tabs-7">Juillet</a></li>
    <li><a href="#tabs-8">Août</a></li>
    <li><a href="#tabs-9">Septembre</a></li>
    <li><a href="#tabs-10">Octobre</a></li>
    <li><a href="#tabs-11">Novembre</a></li>
    <li><a href="#tabs-12">Décembre</a></li>
  </ul>

<!--contenu des onglets-->
  <div id="tabs-1">
	<div><strong>Temps d'intervention pour janvier</strong></div></br>
        <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
            <tr>
                <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
            </tr>
            <?php foreach ($jan_sum as $january_client_times): ?>
				<tr>
					<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $january_client_times['name'];?></td>
					<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $januart_client_times['total_time']);?></td>
				</tr>
            <?php endforeach; ?>
                <tr>
                    <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                    <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $januaryTotalSum);?></td>
                </tr>
        </table> 
  </div>

  <div id="tabs-2">
    <div><strong>Temps d'intervention pour février</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($feb_sum as $february_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $february_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $february_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $februaryTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-3">
    <div><strong>Temps d'intervention pour mars</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($mar_sum as $march_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $march_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $march_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $marchTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-4">
    <div><strong>Temps d'intervention pour avril</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($apr_sum as $april_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $april_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $april_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $aprilTotalSum);?></th>
        </tr>
    </table>
</div>
 
<div id="tabs-5">
    <div><strong>Temps d'intervention pour mai</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($may_sum as $may_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $may_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $may_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $mayTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-6">
    <div><strong>Temps d'intervention pour juin</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($jun_sum as $june_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $june_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $june_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $juneTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-7">
    <div><strong>Temps d'intervention pour juillet</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($jul_sum as $july_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $july_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $july_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $julyTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-8">
    <div><strong>Temps d'intervention pour août</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($aug_sum as $august_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $august_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $august_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $augustTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-9">
    <div><strong>Temps d'intervention pour septembre</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($sep_sum as $september_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $september_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $september_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $septemberTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-10">
    <div><strong>Temps d'intervention pour octobre</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($oct_sum as $october_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $october_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $october_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $octoberTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-11">
    <div><strong>Temps d'intervention pour novembre</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($nov_sum as $november_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $november_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $november_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $novemberTotalSum);?></th>
        </tr>
    </table>
</div>

<div id="tabs-12">
    <div><strong>Temps d'intervention pour décembre</strong></div></br>
    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
        </tr>
        <?php foreach ($dec_sum as $december_client_times): ?>
            <tr>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $december_client_times['name'];?></td>
                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $december_client_times['total_time']);?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $decemberTotalSum);?></th>
        </tr>
    </table>
</div> 
 
</body></html>
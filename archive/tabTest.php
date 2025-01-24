<?php

//inclusions des variables et de la config SQL
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');	

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temps d'intervention Prometech - Accueil</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
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
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <article>
            <br><?php require_once(__DIR__ . '/year_form.php'); ?>
            <!--liste des onglets proposés-->
            <div id="tabs">
            <ul>
                <li><a href="#tabs-0">Période <?php echo($year1 . '-' . $year2)?></a></li>
                <li><a href="#tabs-1">Octobre</a></li>
                <!--<li><a href="#tabs-2">Novembre</a></li>
                <li><a href="#tabs-3">Décembre</a></li>
                <li><a href="#tabs-4">Janvier</a></li>
                <li><a href="#tabs-5">Février</a></li>
                <li><a href="#tabs-6">Mars</a></li>
                <li><a href="#tabs-7">Avril</a></li>
                <li><a href="#tabs-8">Mai</a></li>
                <li><a href="#tabs-9">Juin</a></li>
                <li><a href="#tabs-10">Juillet</a></li>
                <li><a href="#tabs-11">Août</a></li>
                <li><a href="#tabs-12">Septembre</a></li>-->
            </ul>

            <!--contenu des onglets-->
<?php $tabCounter = 0;
$get_sum = [];

require_once(__DIR__ . '/functions.php');

?>
<?php while ($tabCounter < 2) : ?> 
<div id="tabs-<?php echo ($tabCounter)?>">
                <div><strong>Temps d'intervention pour la période <?php echo(fillPeriod($tabCounter, $year1, $year2))?></strong></div></br>
                <?php if ((fillTotalSumIn($tabCounter, $yearlyTotalSumIn, $octoberTotalSumIn) !== 0) && (fillTotalSumHM($tabCounter, $yearlyTotalSumHM, $octoberTotalSumHM) !== 0)) : ?>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                        </tr>
                        <?php foreach (fill_sum($tabCounter, $year_sum, $oct_sum) as $client_times): ?>
                            <?php if ($client_times['clients_nom'] != 'Prometech') : ?>
                                <tr>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['clients_nom'];?></td>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $client_times['temps_infogerance'] % 3600);?></td>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($client_times['temps_hm'] / 3600) . gmdate(":i:s", $client_times['temps_hm'] % 3600);?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor(fill_sum($tabCounter, $year_sum, $oct_sum)['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", fill_sum($tabCounter, $year_sum, $oct_sum)['Prometech']['temps_infogerance'] % 3600);?></td>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor(fill_sum($tabCounter, $year_sum, $oct_sum)['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", fill_sum($tabCounter, $year_sum, $oct_sum)['Prometech']['temps_hm'] % 3600);?></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor(fillTotalSumIn($tabCounter, $yearlyTotalSumIn, $octoberTotalSumIn) / 3600) . gmdate(":i:s", fillTotalSumIn($tabCounter, $yearlyTotalSumIn, $octoberTotalSumIn) % 3600);?></th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor(fillTotalSumHM($tabCounter, $yearlyTotalSumHM, $octoberTotalSumHM) / 3600) . gmdate(":i:s", fillTotalSumHM($tabCounter, $yearlyTotalSumHM, $octoberTotalSumHM) % 3600);?></th>
                        </tr>
                    </table>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">Aucune intervention enregistrée pour la période <strong><?php echo(fillPeriod($tabCounter, $year1, $year2))?></strong></div>
                <?php endif; ?>
            </div>
            <?php $tabCounter++; ?>
<?php endwhile; ?>
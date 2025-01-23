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
                <li><a href="#tabs-2">Novembre</a></li>
                <li><a href="#tabs-3">Décembre</a></li>
                <li><a href="#tabs-4">Janvier</a></li>
                <li><a href="#tabs-5">Février</a></li>
                <li><a href="#tabs-6">Mars</a></li>
                <li><a href="#tabs-7">Avril</a></li>
                <li><a href="#tabs-8">Mai</a></li>
                <li><a href="#tabs-9">Juin</a></li>
                <li><a href="#tabs-10">Juillet</a></li>
                <li><a href="#tabs-11">Août</a></li>
                <li><a href="#tabs-12">Septembre</a></li>
            </ul>

            <!--contenu des onglets-->
            <div id="tabs-0">
                <div><strong>Temps d'intervention pour la période <?php echo ($year1 . '-' . $year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($year_sum as $yearly_client_times): ?>
                        <?php if ($yearly_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $yearly_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($yearly_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $yearly_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($yearly_client_times['temps_hm'] / 3600) . gmdate(":i:s", $yearly_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($year_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $year_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($year_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $year_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($yearlyTotalSumIn / 3600) . gmdate(":i:s", $yearlyTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($yearlyTotalSumHM / 3600) . gmdate(":i:s", $yearlyTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-1">
                <div><strong>Temps d'intervention pour octobre <?php echo ($year1)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($oct_sum as $october_client_times): ?>
                        <?php if ($october_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $october_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($october_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $october_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($october_client_times['temps_hm'] / 3600) . gmdate(":i:s", $october_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($oct_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $oct_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($oct_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $oct_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($octoberTotalSumIn / 3600) . gmdate(":i:s", $octoberTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($octoberTotalSumHM / 3600) . gmdate(":i:s", $octoberTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-2">
                <div><strong>Temps d'intervention pour novembre <?php echo ($year1)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($nov_sum as $november_client_times): ?>
                        <?php if ($november_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $november_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($november_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $november_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($november_client_times['temps_hm'] / 3600) . gmdate(":i:s", $november_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($nov_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $nov_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($nov_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $nov_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($novemberTotalSumIn / 3600) . gmdate(":i:s", $novemberTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($novemberTotalSumHM / 3600) . gmdate(":i:s", $novemberTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-3">
                <div><strong>Temps d'intervention pour décembre <?php echo ($year1)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($dec_sum as $december_client_times): ?>
                        <?php if ($december_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $december_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($december_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $december_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($december_client_times['temps_hm'] / 3600) . gmdate(":i:s", $december_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($dec_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $dec_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($dec_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $dec_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($decemberTotalSumIn / 3600) . gmdate(":i:s", $decemberTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($decemberTotalSumHM / 3600) . gmdate(":i:s", $decemberTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div> 

            <div id="tabs-4">
                <div><strong>Temps d'intervention pour janvier <?php echo ($year2)?></strong></div></br>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                        </tr>
                        <?php foreach ($jan_sum as $january_client_times): ?>
                            <?php if ($january_client_times['clients_nom'] != 'Prometech') : ?>
                                <tr>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $january_client_times['clients_nom'];?></td>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($january_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $january_client_times['temps_infogerance'] % 3600);?></td>
                                    <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($january_client_times['temps_hm'] / 3600) . gmdate(":i:s", $january_client_times['temps_hm'] % 3600);?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jan_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $jan_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jan_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $jan_sum['Prometech']['temps_hm'] % 3600);?></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($januaryTotalSumIn / 3600) . gmdate(":i:s", $januaryTotalSumIn % 3600);?></th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($januaryTotalSumHM / 3600) . gmdate(":i:s", $januaryTotalSumHM % 3600);?></th>
                        </tr>
                    </table> 
            </div>

            <div id="tabs-5">
                <div><strong>Temps d'intervention pour février <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($feb_sum as $february_client_times): ?>
                        <?php if ($february_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $february_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($february_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $february_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($february_client_times['temps_hm'] / 3600) . gmdate(":i:s", $february_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($feb_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $feb_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($feb_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $feb_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($februaryTotalSumIn / 3600) . gmdate(":i:s", $februaryTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($februaryTotalSumHM / 3600) . gmdate(":i:s", $februaryTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-6">
                <div><strong>Temps d'intervention pour mars <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($mar_sum as $march_client_times): ?>
                        <?php if ($march_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $march_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($march_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $march_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($march_client_times['temps_hm'] / 3600) . gmdate(":i:s", $march_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($mar_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $mar_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($mar_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $mar_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($marchTotalSumIn / 3600) . gmdate(":i:s", $marchTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($marchTotalSumHM / 3600) . gmdate(":i:s", $marchTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-7">
                <div><strong>Temps d'intervention pour avril <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($apr_sum as $april_client_times): ?>
                        <?php if ($april_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $april_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($april_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $april_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($april_client_times['temps_hm'] / 3600) . gmdate(":i:s", $april_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($apr_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $apr_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($apr_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $apr_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($aprilTotalSumIn / 3600) . gmdate(":i:s", $aprilTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($aprilTotalSumHM / 3600) . gmdate(":i:s", $aprilTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>
            
            <div id="tabs-8">
                <div><strong>Temps d'intervention pour mai <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($may_sum as $may_client_times): ?>
                        <?php if ($may_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $may_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($may_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $may_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($may_client_times['temps_hm'] / 3600) . gmdate(":i:s", $may_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($may_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $may_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($may_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $may_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($mayTotalSumIn / 3600) . gmdate(":i:s", $mayTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($mayTotalSumHM / 3600) . gmdate(":i:s", $mayTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-9">
                <div><strong>Temps d'intervention pour juin <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($jun_sum as $june_client_times): ?>
                        <?php if ($june_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $june_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($june_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $june_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($june_client_times['temps_hm'] / 3600) . gmdate(":i:s", $june_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jun_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $jun_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jun_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $jun_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($juneTotalSumIn / 3600) . gmdate(":i:s", $juneTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($juneTotalSumHM / 3600) . gmdate(":i:s", $juneTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-10">
                <div><strong>Temps d'intervention pour juillet <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($jul_sum as $july_client_times): ?>
                        <?php if ($july_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $july_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($july_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $july_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($july_client_times['temps_hm'] / 3600) . gmdate(":i:s", $july_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jul_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $jul_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($jul_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $jul_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($julyTotalSumIn / 3600) . gmdate(":i:s", $julyTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($julyTotalSumHM / 3600) . gmdate(":i:s", $julyTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-11">
                <div><strong>Temps d'intervention pour août <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($aug_sum as $august_client_times): ?>
                        <?php if ($august_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $august_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($august_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $august_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($august_client_times['temps_hm'] / 3600) . gmdate(":i:s", $august_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($aug_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $aug_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($aug_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $aug_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($augustTotalSumIn / 3600) . gmdate(":i:s", $augustTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($augustTotalSumHM / 3600) . gmdate(":i:s", $augustTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-12">
                <div><strong>Temps d'intervention pour septembre <?php echo ($year2)?></strong></div></br>
                <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps infogérance</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps hors mission</th>
                    </tr>
                    <?php foreach ($sep_sum as $september_client_times): ?>
                        <?php if ($september_client_times['clients_nom'] != 'Prometech') : ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $september_client_times['clients_nom'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($september_client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $september_client_times['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($september_client_times['temps_hm'] / 3600) . gmdate(":i:s", $september_client_times['temps_hm'] % 3600);?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;">Prometech</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($sep_sum['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", $sep_sum['Prometech']['temps_infogerance'] % 3600);?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($sep_sum['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", $sep_sum['Prometech']['temps_hm'] % 3600);?></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($septemberTotalSumIn / 3600) . gmdate(":i:s", $septemberTotalSumIn % 3600);?></th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo floor($septemberTotalSumHM / 3600) . gmdate(":i:s", $septemberTotalSumHM % 3600);?></th>
                    </tr>
                </table>
            </div>
        </article></br>
    </div>

<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


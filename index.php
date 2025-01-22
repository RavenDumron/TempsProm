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
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($year_sum as $yearly_client_times): ?>
                        <tr>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $yearly_client_times['name'];?></td>
                            <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $yearly_client_times['total_time']);?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $yearlyTotalSum);?></th>
                    </tr>
                </table>
            </div>

            <div id="tabs-1">
                <div><strong>Temps d'intervention pour octobre <?php echo ($year1)?></strong></div></br>
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

            <div id="tabs-2">
                <div><strong>Temps d'intervention pour novembre <?php echo ($year1)?></strong></div></br>
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

            <div id="tabs-3">
                <div><strong>Temps d'intervention pour décembre <?php echo ($year1)?></strong></div></br>
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

            <div id="tabs-4">
                <div><strong>Temps d'intervention pour janvier <?php echo ($year2)?></strong></div></br>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                        </tr>
                        <?php foreach ($jan_sum as $january_client_times): ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $january_client_times['name'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $january_client_times['total_time']);?></td>
                            </tr>
                        <?php endforeach; ?>
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                                <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $januaryTotalSum);?></td>
                            </tr>
                    </table> 
            </div>

            <div id="tabs-5">
                <div><strong>Temps d'intervention pour février <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-6">
                <div><strong>Temps d'intervention pour mars <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-7">
                <div><strong>Temps d'intervention pour avril <?php echo ($year2)?></strong></div></br>
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
            
            <div id="tabs-8">
                <div><strong>Temps d'intervention pour mai <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-9">
                <div><strong>Temps d'intervention pour juin <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-10">
                <div><strong>Temps d'intervention pour juillet <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-11">
                <div><strong>Temps d'intervention pour août <?php echo ($year2)?></strong></div></br>
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

            <div id="tabs-12">
                <div><strong>Temps d'intervention pour septembre <?php echo ($year2)?></strong></div></br>
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
        </article></br>
    </div>

<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


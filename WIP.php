<?php

//inclusions des variables et de la config SQL
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
        <?php require_once(__DIR__ . '/header.php'); //intégration du header ?>
        <article>
            <br><?php require_once(__DIR__ . '/year_form.php'); //intégration du forumlaire de sélection de l'année fiscale ?>
            <!--liste des onglets proposés-->
            <div id="tabs">
            <ul>
                <li><a href="#tabs-0">Période <?php echo($year1 . '-' . $year2)?></a></li>
                <li><a href="#tabs-10">Octobre</a></li>
                <li><a href="#tabs-11">Novembre</a></li>
                <li><a href="#tabs-12">Décembre</a></li>
                <li><a href="#tabs-1">Janvier</a></li>
                <li><a href="#tabs-2">Février</a></li>
                <li><a href="#tabs-3">Mars</a></li>
                <li><a href="#tabs-4">Avril</a></li>
                <li><a href="#tabs-5">Mai</a></li>
                <li><a href="#tabs-6">Juin</a></li>
                <li><a href="#tabs-7">Juillet</a></li>
                <li><a href="#tabs-8">Août</a></li>
                <li><a href="#tabs-9">Septembre</a></li>
            </ul>


            <!--boucle de génération du contenu des onglets-->
            <?php while ($tabCounter < 13) : ?> 
                <div id="tabs-<?php echo ($tabCounter)?>"> <!--donne le nom de l'onglet en fonction de l'état actuel du compteur de contrôle de la boucle-->
                     <div><strong>Temps d'intervention pour la période <?php echo(fillPeriod($tabCounter))?></strong></div></br>
                    <!--s'assure qu'il y a bien du contenu à afficher, sinon renvoie une erreur-->
                    <?php if ((${'TotalSumIn' . $tabCounter} !== 0) && (${'TotalSumHM' . $tabCounter} !== 0)): ?>
                        <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Société</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps budgétisé</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps infogérance réel</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps hors mission</th>
                            </tr>
                            <?php $clientCounter = 1; //activation du compteur pour rendre unique chaque bouton de sous-tableau de détail de temps ?>
                            <?php foreach (${'sum' . $tabCounter} as $client_times): //boucle pour générer une ligne de temps pour chaque société ?>
                                <?php if ($client_times['clients_nom'] != 'Prometech'): //exclusion de Prometech pour pouvoir le mettre en fin de tableau ?>
                                        <!--script pour les boutons permettant d'afficher le sous-tableau de détail de chaque temps-->
                                        <!--nomenclature boutons : Tab(numéro de l'onglet en cours)/Wrapper ou Opener A ou B (A=infogerance, B=hors mission)/numéro du client en cours-->
                                        <script type="text/javascript">
                                        $(document).ready(function() {

                                            $('#Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>').dialog({
                                                autoOpen: false,
                                                title: 'Détail infogérance <?php echo($client_times['clients_nom'])?>',
                                                width: 'auto',
                                                maxHeight: 750,
                                                height: 'auto'
                                            });
                                            $('#Tab<?php echo ($tabCounter)?>OpenerA<?php echo ($clientCounter)?>').click(function() {
                                                $('#Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>').dialog('open');
                                            });
                                            $('#Tab<?php echo ($tabCounter)?>WrapperB<?php echo ($clientCounter)?>').dialog({
                                                autoOpen: false,
                                                title: 'Détail infogérance <?php echo($client_times['clients_nom'])?>',
                                                width: 'auto',
                                                maxHeight: 750,
                                                height: 'auto'
                                            });
                                            $('#Tab<?php echo ($tabCounter)?>OpenerB<?php echo ($clientCounter)?>').click(function() {
                                                $('#Tab<?php echo ($tabCounter)?>WrapperB<?php echo ($clientCounter)?>').dialog('open');
                                            });
                                        });
                                        </script>
                                    <tr>
                                        <!--nom de l'entreprise cliente-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo $client_times['clients_nom'];?></td>
                                        <!--temps budgetisé-->
                                        <?php $currentClient = $client_times['clients_nom']; // on récupère le nom du client pour pouvoir le rechercher dans le tableau des budgets?>
                                        <!--pour l'onglet année fiscale-->
                                        <?php if ($tabCounter === 0): ?>
                                            <?php if (isset($contractsCombined[$currentClient])): //vérifie si une ligne existe pour le client?>
                                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                    <!--combine les deux budgets possibles sur une année et les convertis en temps-->
                                                    <?php echo floor(
                                                        ($contractsCombined[$currentClient]['contract1Budget'] + $contractsCombined[$currentClient]['contract2Budget']) / 50) 
                                                        . gmdate(":i:s", round(($contractsCombined[$currentClient]['contract1Budget'] + $contractsCombined[$currentClient]['contract2Budget']) /50 *3600) % 3600);
                                                    ?>
                                                </td>
                                            <?php else: // renvoie une erreur si aucun budget renseigné ?>
                                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                </td>
                                            <?php endif; ?>
                                        <!--pour les onglets octobre à décembre-->
                                        <?php elseif ($tabCounter >=10 && $tabCounter <=12): ?>
                                            <?php if (isset($contractsCombined[$currentClient])): //vérifie si une ligne existe pour le client ?>
                                                <?php $currentMonth = $year1 . '-' . $tabCounter . '-05'; //crée la date de vérification du mois en cours (au 5 car certains contrats finissent au 1er) ?>
                                                <!--vérifie si le 5 du mois en cours est comprise dans contrat 1-->
                                                <?php if (check_in_range($contractsCombined[$currentClient]['contract1Start'], $contractsCombined[$currentClient]['contract1End'], $currentMonth)): ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <?php echo floor(
                                                            ($contractsCombined[$currentClient]['contract1Budget'] / $contractsCombined[$currentClient]['contract1Months']) / 50) 
                                                            . gmdate(":i:s", round(($contractsCombined[$currentClient]['contract1Budget'] / $contractsCombined[$currentClient]['contract1Months']) /50 *3600) % 3600);
                                                        ?>
                                                    </td>
                                                    <?php ${'totalBudget' . $tabCounter} += $contractsCombined[$currentClient]['contract1Budget']; //ajoute le budget 1 mensualisé de l'entreprise au total du mois?>
                                                <!--vérifie si le 5 du mois en cours est comprise dans contrat 2-->
                                                <?php elseif (check_in_range($contractsCombined[$currentClient]['contract2Start'], $contractsCombined[$currentClient]['contract2End'], $currentMonth)): ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <?php echo floor(
                                                            ($contractsCombined[$currentClient]['contract2Budget'] / $contractsCombined[$currentClient]['contract2Months']) / 50) 
                                                            . gmdate(":i:s", round(($contractsCombined[$currentClient]['contract2Budget'] / $contractsCombined[$currentClient]['contract2Months']) /50 *3600) % 3600);
                                                        ?>
                                                    </td>
                                                    <?php ${'totalBudget' . $tabCounter} += $contractsCombined[$currentClient]['contract2Budget']; //ajoute le budget 2 mensualisé de l'entreprise au total du mois?>
                                                <?php else: //renvoie une erreur si le budget qui correspondrait à la date est vide ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                    </td>
                                                <?php endif; ?>
                                            <?php else: //renvoie une erreur si aucun budget renseigné ?>
                                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                </td>
                                            <?php endif; ?>
                                        <!--pour les onglets janvier à septembre-->
                                        <?php elseif ($tabCounter >=1 && $tabCounter <=9): ?>
                                            <?php if (isset($contractsCombined[$currentClient])): //vérifie si une ligne existe pour le client ?>
                                                <?php $currentMonth = $year2 . '-' . $tabCounter . '-05'; //crée la date de vérification du mois en cours (au 5 car certains contrats finissent au 1er) ?>
                                                <!--vérifie si le 5 du mois en cours est comprise dans contrat 1-->
                                                <?php if (check_in_range($contractsCombined[$currentClient]['contract1Start'], $contractsCombined[$currentClient]['contract1End'], $currentMonth)): ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <?php echo floor(
                                                            ($contractsCombined[$currentClient]['contract1Budget'] / $contractsCombined[$currentClient]['contract1Months']) / 50) 
                                                            . gmdate(":i:s", round(($contractsCombined[$currentClient]['contract1Budget'] / $contractsCombined[$currentClient]['contract1Months']) /50 *3600) % 3600);
                                                        ?>
                                                    </td>
                                                    <?php ${'totalBudget' . $tabCounter} += $contractsCombined[$currentClient]['contract1Budget']; //ajoute le budget 1 mensualisé de l'entreprise au total du mois?>
                                                <!--vérifie si le 5 du mois en cours est comprise dans contrat 2-->
                                                <?php elseif (check_in_range($contractsCombined[$currentClient]['contract2Start'], $contractsCombined[$currentClient]['contract2End'], $currentMonth)): ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <?php echo floor(
                                                            ($contractsCombined[$currentClient]['contract2Budget'] / $contractsCombined[$currentClient]['contract2Months']) / 50) 
                                                            . gmdate(":i:s", round(($contractsCombined[$currentClient]['contract2Budget'] / $contractsCombined[$currentClient]['contract2Months']) /50 *3600) % 3600);
                                                        ?>
                                                    </td>
                                                    <?php ${'totalBudget' . $tabCounter} += $contractsCombined[$currentClient]['contract2Budget']; //ajoute le budget 2 mensualisé de l'entreprise au total du mois?>
                                                <?php else: //renvoie une erreur si le budget qui correspondrait à la date est vide ?>
                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                    </td>
                                                <?php endif; ?>
                                            <?php else: //renvoie une erreur si aucun budget renseigné ?>
                                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                </td>
                                            <?php endif; ?>
                                        <?php else: //renvoie une erreur si le tabCounter ne correspond pas à l'année ou aux mois?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Onglet invalide</div> 
                                                </td>
                                        <?php endif; ?>
                                        <!--temps d'infogérance-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <!--conversion des secondes en heures:minutes:secondes-->
                                            <?php echo floor($client_times['temps_infogerance'] / 3600) . gmdate(":i:s", $client_times['temps_infogerance'] % 3600);?>
                                            <!--bouton pour afficher le sous-tableau de détail des temps dans les onglets de mois, si présent-->
                                            <?php if (($tabCounter > 0) && ($client_times['temps_infogerance'] > 0)) :?>
                                                <button id="Tab<?php echo ($tabCounter)?>OpenerA<?php echo ($clientCounter)?>" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                                    <i class="fa-regular fa-window-restore"></i>
                                                </button>
                                                <div id="Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>">
                                                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                        <tr>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                        </tr>
                                                        <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                            <?php if (($client_details['clients_nom'] === $client_times['clients_nom']) && ($client_details['temps_infogerance'] !== NULL)): ?>
                                                                <tr>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo ($client_details['techniciens_nom'] . ' ' . $client_details['techniciens_prenom']);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_debut']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_fin']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo floor($client_details['temps_infogerance'] / 3600) . gmdate(":i:s", $client_details['temps_infogerance'] % 3600);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_lib']?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <!--temps hors mission-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <!--conversion des secondes en heures:minutes:secondes-->
                                            <?php echo floor($client_times['temps_hm'] / 3600) . gmdate(":i:s", $client_times['temps_hm'] % 3600);?>
                                            <!--bouton pour afficher le sous-tableau de détail des temps-->
                                            <?php if (($tabCounter > 0) && ($client_times['temps_hm'] > 0)): ?>
                                                <button id="Tab<?php echo ($tabCounter)?>OpenerB<?php echo ($clientCounter)?>" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                                    <i class="fa-regular fa-window-restore"></i>
                                                </button>
                                                <div id="Tab<?php echo ($tabCounter)?>WrapperB<?php echo ($clientCounter)?>">
                                                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                        <tr>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                        </tr>
                                                        <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                            <?php if (($client_details['clients_nom'] === $client_times['clients_nom']) && ($client_details['temps_hm'] !== NULL)): ?>
                                                                <tr>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo ($client_details['techniciens_nom'] . ' ' . $client_details['techniciens_prenom']);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_debut']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_fin']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo floor($client_details['temps_hm'] / 3600) . gmdate(":i:s", $client_details['temps_hm'] % 3600);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_lib']?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $clientCounter++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <!--script de bouton pour Prometech-->
                            <script type="text/javascript">
                                $(document).ready(function() {

                                    $('#Tab<?php echo ($tabCounter)?>WrapperP').dialog({
                                        autoOpen: false,
                                        title: 'Détail clients Prometech',
                                        width: 'auto',
                                        maxHeight: 750,
                                        height: 'auto'
                                    });
                                    $('#Tab<?php echo ($tabCounter)?>OpenerP').click(function() {
                                        $('#Tab<?php echo ($tabCounter)?>WrapperP').dialog('open');
                                    });
                                });
                                </script>
                            <!--ligne de l'onglet dédiée à Prometech afin qu'il apparaisse tout en bas-->
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Prometech</td>
                                <!--pour l'onglet année fiscale-->
                                <?php if ($tabCounter === 0): ?>
                                    <?php if (isset($contractsCombined['Prometech'])): //vérifie si une ligne existe pour le client?>
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <!--combine les deux budgets possibles sur une année et les convertis en temps-->
                                            <?php echo floor(
                                                ($contractsCombined['Prometech']['contract1Budget'] + $contractsCombined['Prometech']['contract2Budget']) / 50) 
                                                . gmdate(":i:s", round(($contractsCombined['Prometech']['contract1Budget'] + $contractsCombined['Prometech']['contract2Budget']) /50 *3600) % 3600);
                                            ?>
                                        </td>
                                    <?php else: // renvoie une erreur si aucun budget renseigné ?>
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                        </td>
                                    <?php endif; ?>
                                <!--pour les onglets octobre à décembre-->
                                <?php elseif ($tabCounter >=10 && $tabCounter <=12): ?>
                                    <?php if (isset($contractsCombined['Prometech'])): //vérifie si une ligne existe pour le client ?>
                                        <?php $currentMonth = $year1 . '-' . $tabCounter . '-05'; //crée la date de vérification du mois en cours (au 5 car certains contrats finissent au 1er) ?>
                                        <!--vérifie si le 5 du mois en cours est comprise dans contrat 1-->
                                        <?php if (check_in_range($contractsCombined['Prometech']['contract1Start'], $contractsCombined['Prometech']['contract1End'], $currentMonth)): ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <?php echo floor(
                                                    ($contractsCombined['Prometech']['contract1Budget'] / $contractsCombined['Prometech']['contract1Months']) / 50) 
                                                    . gmdate(":i:s", round(($contractsCombined['Prometech']['contract1Budget'] / $contractsCombined['Prometech']['contract1Months']) /50 *3600) % 3600);
                                                ?>
                                            </td>
                                            <?php ${'totalBudget' . $tabCounter} += $contractsCombined['Prometech']['contract1Budget']; //ajoute le budget 1 mensualisé de l'entreprise au total du mois?>
                                        <!--vérifie si le 5 du mois en cours est comprise dans contrat 2-->
                                        <?php elseif (check_in_range($contractsCombined['Prometech']['contract2Start'], $contractsCombined['Prometech']['contract2End'], $currentMonth)): ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <?php echo floor(
                                                    ($contractsCombined['Prometech']['contract2Budget'] / $contractsCombined['Prometech']['contract2Months']) / 50) 
                                                    . gmdate(":i:s", round(($contractsCombined['Prometech']['contract2Budget'] / $contractsCombined['Prometech']['contract2Months']) /50 *3600) % 3600);
                                                ?>
                                            </td>
                                            <?php ${'totalBudget' . $tabCounter} += $contractsCombined['Prometech']['contract2Budget']; //ajoute le budget 2 mensualisé de l'entreprise au total du mois?>
                                        <?php else: //renvoie une erreur si le budget qui correspondrait à la date est vide ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                            </td>
                                        <?php endif; ?>
                                    <?php else: //renvoie une erreur si aucun budget renseigné ?>
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                        </td>
                                    <?php endif; ?>
                                <!--pour les onglets janvier à septembre-->
                                <?php elseif ($tabCounter >=1 && $tabCounter <=9): ?>
                                    <?php if (isset($contractsCombined['Prometech'])): //vérifie si une ligne existe pour le client ?>
                                        <?php $currentMonth = $year2 . '-' . $tabCounter . '-05'; //crée la date de vérification du mois en cours (au 5 car certains contrats finissent au 1er) ?>
                                        <!--vérifie si le 5 du mois en cours est comprise dans contrat 1-->
                                        <?php if (check_in_range($contractsCombined['Prometech']['contract1Start'], $contractsCombined['Prometech']['contract1End'], $currentMonth)): ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <?php echo floor(
                                                    ($contractsCombined['Prometech']['contract1Budget'] / $contractsCombined['Prometech']['contract1Months']) / 50) 
                                                    . gmdate(":i:s", round(($contractsCombined['Prometech']['contract1Budget'] / $contractsCombined['Prometech']['contract1Months']) /50 *3600) % 3600);
                                                ?>
                                            </td>
                                            <?php ${'totalBudget' . $tabCounter} += $contractsCombined['Prometech']['contract1Budget']; //ajoute le budget 1 mensualisé de l'entreprise au total du mois?>
                                        <!--vérifie si le 5 du mois en cours est comprise dans contrat 2-->
                                        <?php elseif (check_in_range($contractsCombined['Prometech']['contract2Start'], $contractsCombined['Prometech']['contract2End'], $currentMonth)): ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <?php echo floor(
                                                    ($contractsCombined['Prometech']['contract2Budget'] / $contractsCombined['Prometech']['contract2Months']) / 50) 
                                                    . gmdate(":i:s", round(($contractsCombined['Prometech']['contract2Budget'] / $contractsCombined['Prometech']['contract2Months']) /50 *3600) % 3600);
                                                ?>
                                            </td>
                                            <?php ${'totalBudget' . $tabCounter} += $contractsCombined['Prometech']['contract2Budget']; //ajoute le budget 2 mensualisé de l'entreprise au total du mois?>
                                        <?php else: //renvoie une erreur si le budget qui correspondrait à la date est vide ?>
                                            <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                            </td>
                                        <?php endif; ?>
                                    <?php else: //renvoie une erreur si aucun budget renseigné ?>
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                        </td>
                                    <?php endif; ?>
                                <?php else: //renvoie une erreur si le tabCounter ne correspond pas à l'année ou aux mois?>
                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Onglet invalide</div> 
                                        </td>
                                <?php endif; ?>
                                <!--conversion des secondes en heures:minutes:secondes ; pas de bouton de détail car doit être 0:00:00-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo floor(${'sum' . $tabCounter}['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}['Prometech']['temps_infogerance'] % 3600);?></td>
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php echo floor(${'sum' . $tabCounter}['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}['Prometech']['temps_hm'] % 3600);?>
                                    <!--bouton pour afficher le sous-tableau de détail des temps hors mission de Prometech-->
                                    <?php if (($tabCounter > 0) && (${'sum' . $tabCounter}['Prometech']['temps_hm'] > 0)) :?>
                                        <button id="Tab<?php echo ($tabCounter)?>OpenerP" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                            <i class="fa-regular fa-window-restore"></i>
                                        </button>
                                        <div id="Tab<?php echo ($tabCounter)?>WrapperP">
                                                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                        <tr>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                        </tr>
                                                        <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                            <?php if (($client_details['clients_nom'] === 'Prometech') && ($client_details['temps_hm'] !== NULL)): ?>
                                                                <tr>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo ($client_details['techniciens_nom'] . ' ' . $client_details['techniciens_prenom']);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_debut']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_date_fin']?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo floor($client_details['temps_hm'] / 3600) . gmdate(":i:s", $client_details['temps_hm'] % 3600);?>
                                                                    </td>
                                                                    <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                                                        <?php echo $client_details['intervention_lib']?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!--ligne des totaux de l'onglet-->
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Total</th>
                                <!--affichage du total des temps budgetisés-->
                                <?php if (isset(${'totalBudget' . $tabCounter})): //vérifie qu'un total a bien été calculé pour l'onglet ?>
                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                        <!--convertis en temps le total des budgets-->
                                        <?php echo floor(
                                            ${'totalBudget' . $tabCounter} / 50) 
                                            . gmdate(":i:s", round(${'totalBudget' . $tabCounter} /50 *3600) % 3600);
                                        ?>
                                    </th>
                                <?php else: // renvoie une erreur si aucun total calculé ?>
                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun total disponible</div> 
                                    </th>
                                <?php endif; ?>
                                <!--total des temps d'infogérance-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo floor(${'TotalSumIn' . $tabCounter} / 3600) . gmdate(":i:s", ${'TotalSumIn' . $tabCounter} % 3600);?></th>
                                <!--total des temps hors mission-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo floor(${'TotalSumHM' . $tabCounter} / 3600) . gmdate(":i:s", ${'TotalSumHM' . $tabCounter} % 3600);?></th>
                            </tr>
                        </table>
                    <?php else: // retour d'erreur si aucun temps enregistré ?>
                        <div class="alert alert-danger" role="alert">Aucune intervention enregistrée pour la période <strong><?php echo(fillPeriod($tabCounter))?></strong></div>
                    <?php endif; ?>
                </div>
                <?php $tabCounter++; ?>
            <?php endwhile; ?>
        </article></br>
    </div>

<!-- intégration du footer -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


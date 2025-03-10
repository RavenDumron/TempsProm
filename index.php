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
            <!--formulaire de sélection de l'année fiscale à extraire de la base SQL-->
            <br><form action="index.php" method="GET">
                <div class="mb-3">
                    <strong><label for="year" class="form-label">Quelle année (début de période) souhaitez-vous extraire ?</label></strong>
                    <input input type="number" min="1900" max="2099" step="1" value=<?php echo($year1)?> name='year' id='year' required>
                    <div id="form-help" class="form-text">Exemple : pour la période fiscale 2024-2025, sélectionner 2024.</div>
                </div>
                <button type="submit" class="dbtn btn-primary">Go</button>
            </form></br>
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
            <?php for ($tabCounter = 0; $tabCounter <=12; $tabCounter++) : ?> 
                <div id="tabs-<?php echo ($tabCounter)?>"> <!--donne le nom de l'onglet en fonction de l'état actuel du compteur de contrôle de la boucle-->
                    <div><strong>Temps d'intervention pour la période <?php echo(fillPeriod($tabCounter))?></strong></div>
                    <?php if ($tabCounter >= 1) :?>
                        <div id="form-help" class="form-text">Cliquez sur <i class="fa-regular fa-window-restore"></i> pour afficher le détail.</div>
                    <?php endif; ?></br>
                    <!--s'assure qu'il y a bien du contenu à afficher, sinon renvoie une erreur-->
                    <?php if ((${'TotalSumIn' . $tabCounter} !== 0) && (${'TotalSumHM' . $tabCounter} !== 0)): ?>
                        <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                            <!--Nom des onglets à afficher-->
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Société</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps budgétisé</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps infogérance réel</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps hors mission</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Boni/Mali infogérance</th>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Taux horaire réel</th>
                            </tr>
                            <?php $clientCounter = 1; //activation du compteur pour rendre unique chaque bouton de sous-tableau de détail de temps ?>
                            <?php foreach (${'clientList' . $tabCounter} as $client): //boucle pour générer une ligne de temps pour chaque société ?>
                                <!--exclusion de Prometech pour pouvoir le mettre en fin de tableau, ainsi que des clients sans temps renseigné pour le mois-->
                                <?php if (($client['clients_nom'] != 'Prometech') && ($tabCounter !== 0 ? array_key_exists($client['clients_nom'], ${'sum' . $tabCounter}): true)): ?>
                                    <?php $currentClient = $client['clients_nom']; // on récupère le nom du client pour pouvoir le rechercher dans les tableaux externes?>
                                    <!--script pour les boutons permettant d'afficher le sous-tableau de détail de chaque temps-->
                                    <!--nomenclature boutons : Tab(numéro de l'onglet en cours)/Wrapper ou Opener A ou B (A=infogerance, B=hors mission)/numéro du client en cours-->
                                    <script type="text/javascript">
                                        $(document).ready(function() {

                                            $('#Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>').dialog({
                                                autoOpen: false,
                                                title: 'Détail infogérance <?php echo($client['clients_nom'])?>',
                                                width: 'auto',
                                                maxHeight: 750,
                                                height: 'auto'
                                            });
                                            $('#Tab<?php echo ($tabCounter)?>OpenerA<?php echo ($clientCounter)?>').click(function() {
                                                $('#Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>').dialog('open');
                                            });
                                            $('#Tab<?php echo ($tabCounter)?>WrapperB<?php echo ($clientCounter)?>').dialog({
                                                autoOpen: false,
                                                title: 'Détail infogérance <?php echo($client['clients_nom'])?>',
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
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo $currentClient;?></td>
                                        <!--temps budgetisé-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                                <?php if (isset(${'contractsCombined' . $tabCounter}[$currentClient])): //vérifie si une ligne existe pour le client ?>
                                                    <!--combine les deux budgets possibles pour l'année et les convertis en temps-->
                                                    <?php echo
                                                        floor((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) / 50) 
                                                        . gmdate(":i:s", round((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) /50 *3600) % 3600)
                                                    ; ?>
                                                <?php else: // renvoie une erreur si aucune ligne renseignée pour le client renseigné ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                <?php endif; ?>
                                            <?php else: //l'onglet est un mois ?>
                                                <!--vérifie si la ligne existe bien et que le budget est supérieur à 0-->
                                                <?php if (isset(${'contractsCombined' . $tabCounter}[$currentClient]) && (${'contractsCombined' . $tabCounter}[$currentClient]['budget'] !== 0)):?>
                                                    <!--ressort le temps budgetisé pour le client-->
                                                    <?php echo ${'contractsCombined' . $tabCounter}[$currentClient]['time'] ?>
                                                <?php else: // renvoie une erreur si aucun budget renseigné ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <!--temps d'infogérance-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <!--conversion des secondes en heures:minutes:secondes-->
                                            <?php echo floor(${'sum' . $tabCounter}[$currentClient]['temps_infogerance'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}[$currentClient]['temps_infogerance'] % 3600);?>
                                            <!--bouton pour afficher le sous-tableau de détail des temps dans les onglets de mois, si présent-->
                                            <?php if (($tabCounter > 0) && (${'sum' . $tabCounter}[$currentClient]['temps_infogerance'] > 0)): //exclue le tableau annuel ?>
                                                <button id="Tab<?php echo ($tabCounter)?>OpenerA<?php echo ($clientCounter)?>" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                                    <i class="fa-regular fa-window-restore"></i>
                                                </button>
                                                <!--tableau de détail des temps à afficher avec le bouton-->
                                                <div id="Tab<?php echo ($tabCounter)?>WrapperA<?php echo ($clientCounter)?>">
                                                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                        <!--nom des colonnes-->
                                                        <tr>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                        </tr>
                                                        <!--boucle pour récupérer le détail des interventions-->
                                                        <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                            <!--vérifie que le nom du client correspond à celui en cours et qu'il y a bien des interventions pour celui-ci-->
                                                            <?php if (($client_details['clients_nom'] === ${'sum' . $tabCounter}[$currentClient]['clients_nom']) && ($client_details['temps_infogerance'] !== NULL)): ?>
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
                                            <?php echo floor(${'sum' . $tabCounter}[$currentClient]['temps_hm'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}[$currentClient]['temps_hm'] % 3600);?>
                                            <!--bouton pour afficher le sous-tableau de détail des temps-->
                                            <?php if (($tabCounter > 0) && (${'sum' . $tabCounter}[$currentClient]['temps_hm'] > 0)): //exclue le tableau annuel ?>
                                                <button id="Tab<?php echo ($tabCounter)?>OpenerB<?php echo ($clientCounter)?>" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                                    <i class="fa-regular fa-window-restore"></i>
                                                </button>
                                                <!--tableau de détail des temps à afficher avec le bouton-->
                                                <div id="Tab<?php echo ($tabCounter)?>WrapperB<?php echo ($clientCounter)?>">
                                                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                        <!--nom des colonnes-->
                                                        <tr>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                            <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                        </tr>
                                                        <!--boucle pour récupérer le détail des interventions-->
                                                        <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                            <!--vérifie que le nom du client correspond à celui en cours et qu'il y a bien des interventions pour celui-ci-->
                                                            <?php if (($client_details['clients_nom'] === ${'sum' . $tabCounter}[$currentClient]['clients_nom']) && ($client_details['temps_hm'] !== NULL)): ?>
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
                                        <!--Boni/Mali infogérance-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                            <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                                <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                                <?php if ((isset(${'contractsCombined' . $tabCounter}[$currentClient]) && (isset((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']))))): ?>
                                                    <!--calcule la différence entre les deux valeurs -->
                                                    <?php $currentDiff = (((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] 
                                                        + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) /50 *3600)
                                                        - ${'sum' . $tabCounter}[$currentClient]['temps_infogerance']); ?>
                                                    <?php if ($currentDiff >= 0): // si la différence est positive, on affiche directement le résultat en le transformant en h:m:s?>
                                                        <div style="color : #00af00";><?php echo 
                                                            floor ($currentDiff / 3600) . gmdate(":i:s", round($currentDiff) % 3600)
                                                        ; ?></div>
                                                    <?php else: //si la différence est négative, on inverse le calcul et on affiche le résultat en le transformant en h:m:s ?>
                                                        <div style="color : #ff0000;"><?php echo (
                                                            '-' .
                                                            floor (
                                                            ((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']) /3600)
                                                            - ((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] 
                                                            + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) /50)) 
                                                            . gmdate(":i:s", round((${'sum' . $tabCounter}[$currentClient]['temps_infogerance'])
                                                            - ((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] 
                                                            + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) /50 *3600)) % 3600)
                                                        ); ?></div>
                                                    <?php endif; ?>
                                                <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                                <?php endif; ?>
                                            <?php else: //l'onglet est un mois ?>
                                                <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                                <?php if (isset(${'contractsCombined' . $tabCounter}[$currentClient]) && (${'contractsCombined' . $tabCounter}[$currentClient]['budget'] !== 0) && isset((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']))): ?>
                                                    <!--calcule la différence entre les deux valeurs -->
                                                    <?php $currentDiff = ((${'contractsCombined' . $tabCounter}[$currentClient]['budget'] /50 *3600)
                                                        - (${'sum' . $tabCounter}[$currentClient]['temps_infogerance'])); ?>
                                                    <?php if ($currentDiff >= 0): // si la différence est positive, on affiche directement le résultat en le transformant en h:m:s?>
                                                        <div style="color : #00af00";><?php echo 
                                                            floor ($currentDiff / 3600) . gmdate(":i:s", round($currentDiff) % 3600)
                                                        ; ?></div>
                                                    <?php else: //si la différence est négative, on inverse le calcul et on affiche le résultat en le transformant en h:m:s ?>
                                                        <div style="color : #ff0000;"><?php echo (
                                                            '-' .
                                                            floor (
                                                            (${'sum' . $tabCounter}[$currentClient]['temps_infogerance'] /3600)
                                                            - (${'contractsCombined' . $tabCounter}[$currentClient]['budget'] /50)) 
                                                            . gmdate(":i:s", round(${'sum' . $tabCounter}[$currentClient]['temps_infogerance'])
                                                            - round(${'contractsCombined' . $tabCounter}[$currentClient]['budget'] /50 *3600) % 3600)
                                                            ); ?></div>
                                                    <?php endif; ?>
                                                <?php else: // renvoie une erreur si la ligne client n'existe pas ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                                <?php endif; ?>
                                            <?php endif; ?>    
                                        </td>
                                        <!--Taux horaire réel-->
                                        <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                        <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                                <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                                <?php if ((isset(${'contractsCombined' . $tabCounter}[$currentClient]) && (isset((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']))))): ?>
                                                    <!--calcule le taux horaire-->
                                                    <?php $clientRate = 
                                                        ((${'contractsCombined' . $tabCounter}[$currentClient]['contract1Budget'] 
                                                        + ${'contractsCombined' . $tabCounter}[$currentClient]['contract2Budget']) *3600)
                                                        / ${'sum' . $tabCounter}[$currentClient]['temps_infogerance']
                                                    ; ?>
                                                    <?php if ($clientRate < 40): ?>
                                                        <div style="color : #ff0000;"><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php elseif ($clientRate >= 40 && $clientRate <50): ?>
                                                        <div style="color : #af0000;"><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php else: ?>
                                                        <div style="color : #00af00";><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php endif; ?>
                                                <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                                <?php endif; ?>
                                            <?php else: //l'onglet est un mois ?>
                                                <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                                <?php if (isset(${'contractsCombined' . $tabCounter}[$currentClient]) && (${'contractsCombined' . $tabCounter}[$currentClient]['budget'] !== 0) && isset((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']))): ?>
                                                    <!--calcule la différence entre les deux valeurs -->
                                                    <?php $clientRate = 
                                                        (${'contractsCombined' . $tabCounter}[$currentClient]['budget'] *3600)
                                                        / ${'sum' . $tabCounter}[$currentClient]['temps_infogerance']
                                                    ; ?>
                                                    <?php if ($clientRate < 40): ?>
                                                        <div style="color : #ff0000;"><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php elseif ($clientRate >= 40 && $clientRate <50): ?>
                                                        <div style="color : #af0000;"><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php else: ?>
                                                        <div style="color : #00af00";><?php echo number_format($clientRate, 2, ",", " ")?> €</div>
                                                    <?php endif; ?>
                                                <?php else: // renvoie une erreur si la ligne client n'existe pas ?>
                                                    <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                                <?php endif; ?>
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
                                <!--temps budgetisé-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                        <?php if (isset(${'contractsCombined' . $tabCounter}['Prometech'])): //vérifie si une ligne existe pour le client ?>
                                            <!--combine les deux budgets possibles pour l'année et les convertis en temps-->
                                            <?php echo
                                                floor((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) / 50) 
                                                . gmdate(":i:s", round((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) /50 *3600) % 3600)
                                            ; ?>
                                        <?php else: // renvoie une erreur si aucune ligne renseignée pour le client renseigné ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                        <?php endif; ?>
                                    <?php else: //l'onglet est un mois ?>
                                        <?php if (isset(${'contractsCombined' . $tabCounter}['Prometech'])): //vérifie si une ligne existe pour le client ?>
                                            <?php if (isset(${'sum' . $tabCounter}['Prometech']['budget']) && 
                                            ${'sum' . $tabCounter}['Prometech']['budget'] != 0 && 
                                            is_numeric(${'sum' . $tabCounter}['Prometech']['budget'])): //vérifie si un budget existe pour le client ?>
                                                <!--ressort le temps budgetisé pour le client-->
                                                <?php echo ${'contractsCombined' . $tabCounter}['Prometech']['time'] ?>
                                            <?php else: // renvoie une erreur si aucun budget renseigné ?>
                                                <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                            <?php endif; ?>
                                        <?php else: // renvoie une erreur si la ligne client n'existe pas ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun budget renseigné</div> 
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <!--temps infogérance-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <!--conversion des secondes en heures:minutes:secondes ; pas de bouton de détail car doit être 0:00:00-->
                                    <?php echo floor(${'sum' . $tabCounter}['Prometech']['temps_infogerance'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}['Prometech']['temps_infogerance'] % 3600);?>
                                </td>
                                <!--temps hors mission-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php echo floor(${'sum' . $tabCounter}['Prometech']['temps_hm'] / 3600) . gmdate(":i:s", ${'sum' . $tabCounter}['Prometech']['temps_hm'] % 3600);?>
                                    <!--bouton pour afficher le sous-tableau de détail des temps hors mission de Prometech-->
                                    <?php if (($tabCounter > 0) && 
                                        isset(${'sum' . $tabCounter}['Prometech']['temps_hm']) && 
                                        ${'sum' . $tabCounter}['Prometech']['temps_hm'] != 0 && 
                                        is_numeric(${'sum' . $tabCounter}['Prometech']['temps_hm'])): ?>
                                        <button id="Tab<?php echo ($tabCounter)?>OpenerP" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                            <i class="fa-regular fa-window-restore"></i>
                                        </button>
                                        <!--tableau de détail des temps à afficher avec le bouton-->
                                        <div id="Tab<?php echo ($tabCounter)?>WrapperP">
                                            <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                                                <!--nom des colonnes-->
                                                <tr>
                                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Technicien</th>
                                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Début d'intervention</th>
                                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Fin d'intervention</th>
                                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Temps total</th>
                                                    <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Détail d'intervention</th>
                                                </tr>
                                                <!--boucle pour récupérer le détail des interventions-->
                                                <?php foreach (${'extract' . $tabCounter} as $client_details): ?>
                                                    <!--vérifie que le nom du client correspond à celui en cours et qu'il y a bien des interventions pour celui-ci-->
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
                                <!--Boni/Mali infogérance-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                        <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                        <?php if ((isset(${'contractsCombined' . $tabCounter}['Prometech']) && (isset((${'sum' . $tabCounter}['Prometech']['temps_infogerance']))))): ?>
                                            <!--calcule la différence entre les deux valeurs -->
                                            <?php $currentDiff = (((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] 
                                                + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) /50 *3600)
                                                - ${'sum' . $tabCounter}['Prometech']['temps_infogerance']); ?>
                                            <?php if ($currentDiff >= 0): // si la différence est positive, on affiche directement le résultat en le transformant en h:m:s?>
                                                <div style="color : #00af00";><?php echo 
                                                    floor ($currentDiff / 3600) . gmdate(":i:s", round($currentDiff) % 3600)
                                                ; ?></div>
                                            <?php else: //si la différence est négative, on inverse le calcul et on affiche le résultat en le transformant en h:m:s ?>
                                                <div style="color : #ff0000;"><?php echo (
                                                    '-' .
                                                    floor (
                                                    ((${'sum' . $tabCounter}['Prometech']['temps_infogerance']) /3600)
                                                    - ((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] 
                                                    + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) /50)) 
                                                    . gmdate(":i:s", round((${'sum' . $tabCounter}['Prometech']['temps_infogerance'])
                                                    - ((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] 
                                                    + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) /50 *3600)) % 3600)
                                                ); ?></div>
                                            <?php endif; ?>
                                        <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                        <?php endif; ?>
                                    <?php else: //l'onglet est un mois ?>
                                        <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                        <?php if (isset(${'contractsCombined' . $tabCounter}['Prometech']) && (${'contractsCombined' . $tabCounter}['Prometech']['budget'] !== 0) && isset((${'sum' . $tabCounter}[$currentClient]['temps_infogerance']))): ?>
                                            <!--calcule la différence entre les deux valeurs -->
                                            <?php $currentDiff = ((${'contractsCombined' . $tabCounter}[$currentClient]['budget'] /50 *3600)
                                                - (${'sum' . $tabCounter}['Prometech']['temps_infogerance'])); ?>
                                            <?php if ($currentDiff >= 0): // si la différence est positive, on affiche directement le résultat en le transformant en h:m:s ?>
                                                <div style="color : #00af00";><?php echo 
                                                    floor ($currentDiff / 3600) . gmdate(":i:s", round($currentDiff) % 3600)
                                                ; ?></div>
                                            <?php else: //si la différence est négative, on inverse le calcul et on affiche le résultat en le transformant en h:m:s ?>
                                                <div style="color : #ff0000;"><?php echo (
                                                    '-' .
                                                    floor (
                                                    (${'sum' . $tabCounter}['Prometech']['temps_infogerance'] /3600)
                                                    - (${'contractsCombined' . $tabCounter}['Prometech']['budget'] /50)) 
                                                    . gmdate(":i:s", round(${'sum' . $tabCounter}['Prometech']['temps_infogerance'])
                                                    - round(${'contractsCombined' . $tabCounter}['Prometech']['budget'] /50 *3600) % 3600)
                                                ); ?></div>
                                            <?php endif; ?>
                                        <?php else: // renvoie une erreur si la ligne client n'existe pas ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                        <?php endif; ?>
                                    <?php endif; ?>    
                                </td>
                                <!--Taux horaire réel-->
                                <td style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php if ($tabCounter ===0): //l'onglet est l'année ?>
                                        <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                        <?php if (isset(${'contractsCombined' . $tabCounter}['Prometech']) && 
                                        isset(${'sum' . $tabCounter}['Prometech']['temps_infogerance']) && 
                                        ${'sum' . $tabCounter}['Prometech']['temps_infogerance'] != 0 && 
                                        is_numeric(${'sum' . $tabCounter}['Prometech']['temps_infogerance'])): ?>
                                            <!--calcule le taux horaire-->
                                            <?php $prometechRate = 
                                                ((${'contractsCombined' . $tabCounter}['Prometech']['contract1Budget'] 
                                                + ${'contractsCombined' . $tabCounter}['Prometech']['contract2Budget']) *3600)
                                                / ${'sum' . $tabCounter}['Prometech']['temps_infogerance']
                                            ; ?>
                                           <?php if ($prometechRate < 40): ?>
                                                <div style="color : #ff0000;"><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php elseif ($prometechRate >= 40 && $prometechRate <50): ?>
                                                <div style="color : #af0000;"><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php else: ?>
                                                <div style="color : #00af00";><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php endif; ?>
                                        <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                        <?php endif; ?>
                                    <?php else: //l'onglet est un mois ?>
                                        <!--vérifie si une ligne de budget et un temps d'infogérance existe pour le client-->
                                       <?php if (isset(${'contractsCombined' . $tabCounter}['Prometech']) && 
                                        isset(${'sum' . $tabCounter}['Prometech']['temps_infogerance']) && 
                                        ${'sum' . $tabCounter}['Prometech']['temps_infogerance'] != 0 && 
                                        is_numeric(${'sum' . $tabCounter}['Prometech']['temps_infogerance'])): ?>
                                            <!--calcule la différence entre les deux valeurs -->
                                            <?php $prometechRate = 
                                                (${'contractsCombined' . $tabCounter}['Prometech']['budget'] *3600)
                                                / ${'sum' . $tabCounter}['Prometech']['temps_infogerance']
                                            ; ?>
                                            <?php if ($prometechRate < 40): ?>
                                                <div style="color : #ff0000;"><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php elseif ($prometechRate >= 40 && $prometechRate <50): ?>
                                                <div style="color : #af0000;"><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php else: ?>
                                                <div style="color : #00af00";><?php echo number_format($prometechRate, 2, ",", " ")?> €</div>
                                            <?php endif; ?>
                                        <?php else: // renvoie une erreur si la ligne client n'existe pas ?>
                                            <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!--ligne des totaux de l'onglet-->
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">Total</th>
                                <!--affichage du total des temps budgetisés-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <?php if (isset(${'totalTime' . $tabCounter})): //vérifie qu'un total a bien été calculé pour l'onglet ?>
                                        <?php echo ${'totalTime' . $tabCounter}; ?>
                                    <?php else: // renvoie une erreur si aucun total calculé ?>
                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Aucun total disponible</div> 
                                    <?php endif; ?>
                                </th>
                                <!--total des temps d'infogérance-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo floor(${'TotalSumIn' . $tabCounter} / 3600) . gmdate(":i:s", ${'TotalSumIn' . $tabCounter} % 3600);?></th>
                                <!--total des temps hors mission-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;"><?php echo floor(${'TotalSumHM' . $tabCounter} / 3600) . gmdate(":i:s", ${'TotalSumHM' . $tabCounter} % 3600);?></th>
                                <!--Boni/Mali infogérance-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <!--vérifie au'un budget total et un temps d'infogérance total existe bien-->
                                    <?php if ((isset(${'totalBudget' . $tabCounter}) && (isset((${'TotalSumIn' . $tabCounter}))))): ?>
                                        <!--calcule la différence entre les deux valeurs -->
                                        <?php $currentDiff = ((${'totalBudget' . $tabCounter} /50 *3600)
                                            - ${'TotalSumIn' . $tabCounter}); ?>
                                        <?php if ($currentDiff >= 0): // si la différence est positive, on affiche directement le résultat en le transformant en h:m:s?>
                                            <div style="color : #00af00";><?php echo 
                                                floor ($currentDiff / 3600) . gmdate(":i:s", round($currentDiff) % 3600)
                                            ; ?></div>
                                        <?php else: //si la différence est négative, on inverse le calcul et on affiche le résultat en le transformant en h:m:s?>
                                            <div style="color : #ff0000;"><?php echo (
                                                '-' .
                                                floor (
                                                ((${'TotalSumIn' . $tabCounter}) /3600)
                                                - (${'totalBudget' . $tabCounter} /50)) 
                                                . gmdate(":i:s", round((${'TotalSumIn' . $tabCounter})
                                                - (${'totalBudget' . $tabCounter} /50 *3600)) % 3600)
                                            ); ?></div>
                                        <?php endif; ?>
                                    <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                    <?php endif; ?>
                                </th>
                                <!--Taux horaire réel-->
                                <th style="border: 1px solid black; padding: 4px; position: relative; text-align: left;">
                                    <!--vérifie au'un budget total et un temps d'infogérance total existe bien-->
                                    <?php if ((isset(${'totalBudget' . $tabCounter}) && (isset((${'TotalSumIn' . $tabCounter}))))): ?>
                                        <!--calcule le taux horaire-->
                                        <?php $totalRate = 
                                            (${'totalBudget' . $tabCounter} *3600)
                                            / ${'TotalSumIn' . $tabCounter}
                                        ; ?>
                                        <?php if ($totalRate < 40): ?>
                                            <div style="color : #ff0000;"><?php echo number_format($totalRate, 2, ",", " ")?> €</div>
                                        <?php elseif ($totalRate >= 40 && $totalRate <50): ?>
                                            <div style="color : #af0000;"><?php echo number_format($totalRate, 2, ",", " ")?> €</div>
                                        <?php else: ?>
                                            <div style="color : #00af00";><?php echo number_format($totalRate, 2, ",", " ")?> €</div>
                                        <?php endif; ?>
                                    <?php else: // renvoie une erreur si aucun budget ou contrat renseigné pour le client ?>
                                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Calcul impossible</div> 
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </table>
                    <?php else: // retour d'erreur si aucun temps enregistré ?>
                        <div class="alert alert-danger" role="alert">Aucune intervention enregistrée pour la période <strong><?php echo(fillPeriod($tabCounter))?></strong></div>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </article></br>
    </div>

<!-- intégration du footer -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


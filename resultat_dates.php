<!-- inclusion des variables et fonctions -->
<?php

$getData = $_GET;

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');

if (
    !isset($getData['date_debut'])
    || !isset($getData['date_fin'])
) {
    echo('Impossible d\'accéder à la page : dates non renseignées ou partiellement renseignées.');
    return;
}

if (
    $getData['date_debut'] > $getData['date_fin']
    )  {
    echo('Impossible d\'accéder à la page : la date de début est supérieure à la date de fin.');
    return;
}

$SQLselection_temps = $mysqlClient->prepare(
    "SELECT t.debut_intervention, t.fin_intervention, SEC_TO_TIME (t.temps_total) AS 'duree_intervention', c.nom 
    FROM temps t 
    INNER JOIN clients c 
    ON t.id_client = c.id_client 
    WHERE DATE (t.debut_intervention) BETWEEN :date_debut AND :date_fin
    ORDER BY t.debut_intervention DESC"
    );
$SQLselection_temps ->execute([
    'date_debut' => $getData['date_debut'],
    'date_fin' => $getData['date_fin'],
]);
$selection_temps = $SQLselection_temps->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temps d'intervention Prometech - Sélection</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <article>
            <?php require_once(__DIR__ . '/formulaire_dates.php'); ?>
            <?php if (!empty($selection_temps)) : ?>
                <div class="alert alert-success" role="alert">Période du <strong><?php echo($getData['date_debut'])?></strong> au <strong><?php echo($getData['date_fin'])?></strong></div>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 60%;">
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Début d'intervention</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Fin d'intervention</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        </tr>
                        <?php foreach ($selection_temps as $temps_individuels): ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuels['debut_intervention'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuels['fin_intervention'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuels['duree_intervention'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuels['nom'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>                  
            <?php else : ?>
                <div class="alert alert-danger" role="alert">Pas de temps enregistrés pour la période sélectionnée (du <strong><?php echo($getData['date_debut'])?></strong> au <strong><?php echo($getData['date_fin'])?></strong>).</div>
            <?php endif; ?>
        </article></br>
    </div>

<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


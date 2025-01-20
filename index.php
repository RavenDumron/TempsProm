<!-- inclusion des variables et fonctions -->
<?php

$getData = $_GET;

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');

$SQLtemps_du_mois = $mysqlClient->prepare(
    "SELECT t.debut_intervention, t.fin_intervention, SEC_TO_TIME (t.temps_total) AS 'duree_intervention', c.nom 
    FROM temps t 
    INNER JOIN clients c 
    ON t.id_client = c.id_client 
    WHERE DATE (t.debut_intervention) BETWEEN :date_debut AND :date_fun
    ORDER BY t.debut_intervention DESC"
    );
$SQLtemps_du_mois ->execute([
    'date_debut' => $getData['date_debut'],
    'date_fin' => $getData['date_fin'],
]);
$temps_du_mois = $SQLtemps_du_mois->fetchAll();

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
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <article>
            <br><h3>Temps enregistrés pour :</h3></br>

            <?php if (!empty($temps_du_mois)) : ?>
                <table style="border-collapse: collapse; border: 1px solid black; width: 60%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Début d'intervention</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Fin d'intervention</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                    </tr>
                    <?php foreach ($temps_du_mois as $temps_individuel): ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuel['debut_intervention'];?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuel['fin_intervention'];?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuel['duree_intervention'];?></td>
                        <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $temps_individuel['nom'];?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                  
            <?php else : ?>
                <div>Pas (encore !) de temps enregistrés pour ce mois.</div>
            <?php endif; ?>
        </article></br>
    </div>
<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


<!-- inclusion des variables et fonctions -->
<?php

$getData = $_GET;

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');

//Vérification des données envoyées en get, renvoie une erreur si mal renseignées
if (
    !isset($getData['start_date'])
    || !isset($getData['end_date'])
) {
    echo('<html><h3>Impossible d\'accéder à la page : dates non renseignées ou partiellement renseignées. Retour à l\'<a href="index.php">accueil</a>.</hr3></html>');
    return;
}

if (
    $getData['start_date'] > $getData['end_date']
    )  {
    echo('<html><h3>Impossible d\'accéder à la page : la date de début est supérieure à la date de fin. Retour à l\'<a href="index.php">accueil</a>.<h3></html>');
    return;
}

//Si ok, import des données des temps en recoupant les id client avec la table client, et en filtrant par dates sélectionnées

$selectedTimesSQL = $mysqlClient->prepare(
    "SELECT i.total_time, c.name
    FROM interventions i 
    INNER JOIN clients c 
    ON i.client_id = c.client_id 
    WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
    ORDER BY c.name ASC"
    );
$selectedTimesSQL ->execute([
    'date_start' => $getData['start_date'],
    'date_end' => $getData['end_date'],
]);
$selected_times = $selectedTimesSQL->fetchAll();

//cumule les temps de chaque client pour afficher un seul résultat

$time_sum  = array();
foreach($selected_times as $sum){
    if(array_key_exists($sum['name'],$time_sum)){
        $time_sum[$sum['name']]['total_time'] += $sum['total_time'];
        $time_sum[$sum['name']]['name'] = $sum['name'];
    }
    else{
        $time_sum[$sum['name']]  = $sum;
    }
}
//Calcul du total de l'ensemble des temps

$totalSum = array_sum(array_column($time_sum,'total_time'));

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
            <!--inclusion du formulaire de sélection des temps-->
            <?php require_once(__DIR__ . '/date_form.php'); ?>
            <!--affichage d'un message récupitulant la période sélectionnée si celle-ci contient bien des temps-->
            <?php if (!empty($selection_temps)) : ?>
                <div class="alert alert-success" role="alert">Période du <strong><?php echo($getData['start_date'])?></strong> au <strong><?php echo($getData['end_date'])?></strong></div>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                        </tr>
                        <?php foreach ($time_sum as $client_times): ?>
                            <tr>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
                                <td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
                            </tr>
                        <?php endforeach; ?>
                            <tr>
                                <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                                <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                            </tr>
                    </table>   
            <!--affichage d'un message d'erreur s'il n'y a pas de temps enregistrés pour la période'-->               
            <?php else : ?>
                <div class="alert alert-danger" role="alert">Pas de temps enregistrés pour la période sélectionnée (du <strong><?php echo($getData['start_date'])?></strong> au <strong><?php echo($getData['end_date'])?></strong>).</div>
            <?php endif; ?>
        </article></br>
    </div>

<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


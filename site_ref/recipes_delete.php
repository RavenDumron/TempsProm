<?php

session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id']))
{
    echo ('Il faut un identifiant de recette pour la supprimer.');
    return;
}

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement ->execute([
    'id' => $getData['id'],
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Suppression de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Êtes-vous sur de vouloir supprimer votre recette "<?php echo ($recipe['title'])?>" ?</h1>
        <form action="submit_delete.php" method="post">
    <div class = "mb-3 visually-hidden">
        <br><label for="id">Identifiant de la recette</label></br>
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe['recipe_id'])?>">
    </div>
    <div>
        <br><label for="title">Cette action est irreversible.</label></br>
        <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><a class="link-warning" href="index.php">Annuler</a></li>
                        <button class="link-danger" type="submit">Supprimer l'article</button>
                    </ul>
</form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>
<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

/**
* On ne traite pas les super globales provenant de l'utilisateur directement,
* ces données doivent être testées et vérifiées.
*/
$postData = $_POST;

if (
    !isset($postData['id'])
    || !isset($postData['title'])
    || !isset($postData['recipe'])
) {
    echo('Il manque des informations nécessaires à l\'édition de la recette');
    return;
}

$id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];

// Préparation
$insertRecipe = $mysqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id,
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Recette mise à jour</title>
    <link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet"
>
</head>

<body>
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Recette bien mise à jour !</h1>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rappel de votre recette</h5>
            <p class="card-text"><b>Nom</b> : <?php echo($postData['title']); ?></p>
            <p class="card-text"><b>Instructions</b> : <?php echo(strip_tags($postData['recipe'])); ?></p>
        </div>
    </div>
</body>
<?php require_once(__DIR__ . '/footer.php'); ?>
</html>
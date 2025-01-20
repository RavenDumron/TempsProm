<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/variables.php');

/**
* On ne traite pas les super globales provenant de l'utilisateur directement,
* ces données doivent être testées et vérifiées.
*/
$postData = $_POST;

if (
    !isset($postData['comment'])
    || !isset($postData['recipe_id']) 
    || !is_numeric($postData['recipe_id'])
    || !isset ($_SESSION['LOGGED_USER']['email'])
    || !isset($postData['review'])
    || !is_numeric($postData['review'])
) {
    echo('Echec : certaines informations requises sont manquantes.');
    return;
}

$recipe_id = $_POST['recipe_id'];
$comment = $_POST['comment'];
$email = $_SESSION['LOGGED_USER']['email'];
$user_id = getAuthorID ($email, $users);
$review = $_POST['review'];

// Préparation
$insertRecipe = $mysqlClient->prepare('INSERT INTO comments(user_id, recipe_id, comment, review, created_at) VALUES (:user_id, :recipe_id, :comment, :review, CURRENT_TIMESTAMP)');

// Exécution ! Le commentaire est maintenant en base de données
$insertRecipe->execute([
    'user_id' => $user_id,
    'recipe_id' => $recipe_id,
    'comment' => $comment,
    'review' => $review,
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Commentaire reçu</title>
    <link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet"
>
</head>
<!-- Confirmation à l'utilisateur de reception du commentaire -->
<body>
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Commentaire bien reçu !</h1>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rappel de votre commentaire</h5>
            <p class="card-text"><b>Votre email</b> : <?php echo $email; ?></p>
            <p class="card-text"><b>Note</b> : <?php echo $review; ?></p>
            <p class="card-text"><b>Commentaire</b> : <?php echo $comment; ?></p>
        </div>
    </div>
</body>
<?php require_once(__DIR__ . '/footer.php'); ?>
</html>
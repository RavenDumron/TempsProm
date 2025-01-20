<?php
session_start();
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Creation de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Proposez votre recette !</h1>
        <form action="submit_create.php" method="post" enctype="multipart/form-data">
    <div>
        <br><label for="title">Nom de votre recette</label></br>
        <input type="text" name="title">
    </div>
    <div>
        <br><label for="recipe">Instructions</label></br>
       <textarea placeholder="Expliquez-nous comment mijoter ce plat délicieux !" name="recipe"></textarea>
    </div>
    <br><button type="submit">Envoyer</button></br>
</form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>
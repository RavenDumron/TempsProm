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
            <br><h3>Bienvenue ! Quelles dates souhaitez-vous extraire ?</h3></br>
            <?php require_once(__DIR__ . '/formulaire_dates.php'); ?>
        </article></br>
    </div>
<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


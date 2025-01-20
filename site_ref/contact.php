<?php
session_start ();
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Formulaire de contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Contactez nous</h1>
        <form action="submit_contact.php" method="post" enctype="multipart/form-data">
    <div>
        <br><label for="email">Email</label></br>
        <input type="email" placeholder="exemple@email.com" name="email">
    </div>
    <div>
        <br><label for="message">Votre message</label></br>
       <textarea placeholder="Exprimez vous" name="message"></textarea>
    </div>
    <div class="mb-3">
        <label for="screenshot" class="form-label">Votre capture d'écran</label>
        <input type="file" class="form-control" id="screenshot" name="screenshot" />
    </div>
    <br><button type="submit">Envoyer</button></br>
</form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>
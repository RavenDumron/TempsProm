<!-- header.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Site de recettes</a>
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="contact.php">Contact</a>
                    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                        <a class="nav-link" href="recipes_create.php">Ajoutez une recette !</a>
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    <?php endif; ?>
    </div>
</nav>
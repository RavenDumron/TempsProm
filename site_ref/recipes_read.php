<?php

session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id']))
{
    echo ('Identifiant de recette manquant.');
    return;
}

$retrieveRecipeStatement = $mysqlClient->prepare(
    'SELECT * 
    FROM recipes 
    WHERE recipe_id = :id'
    );
$retrieveRecipeStatement ->execute([
    'id' => $getData['id'],
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

$retrieveAverageRating = $mysqlClient->prepare(
    'SELECT ROUND(AVG(c.review),1) as rating 
    FROM recipes r 
    LEFT JOIN comments c 
    on r.recipe_id = c.recipe_id 
    WHERE r.recipe_id = :id'
    );
$retrieveAverageRating ->execute([
    'id' => $getData['id'],
]);

$averageRating = $retrieveAverageRating->fetch();

$commentsStatement = $mysqlClient->prepare(
    'SELECT u.full_name, c.comment, c.review, DATE_FORMAT(c.created_at, "%d/%m/%Y") AS comment_date 
    FROM comments c 
    INNER JOIN users u 
    ON c.user_id = u.user_id 
    WHERE c.recipe_id = :id 
    ORDER BY c.created_at DESC'
    );
$commentsStatement ->execute([
    'id' => $getData['id'],
]);
$comments = $commentsStatement->fetchAll();
?>

<head>
<style>
table {
  border-collapse: collapse;
  width: 35%;
}

th, td {
  padding: 4px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - <?php echo($recipe['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/header.php'); ?>
        <article>
            <h1><?php echo($recipe['title']); ?></h1>
            <br><div>Note utilisateur moyenne : <?php echo $averageRating['rating']; ?> ⭐️</div></br>
            <div><?php echo $recipe['recipe']; ?></div>
            <i><?php echo displayAuthor($recipe['author'], $users); ?></i>
            <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']['email']) : ?>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"><a class="link-warning" href="recipes_update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                    <li class="list-group-item"><a class="link-danger" href="recipes_delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                </ul>
            <?php endif; ?></br>
            <br><h3>Commentaires utilisateurs</h3></br>
            <?php if (!empty($comments)) : ?>
                <table>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Date de publication</th>
                    </tr>
                    <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo $comment['full_name'];?></td>
                        <td><?php echo $comment['review'];?> ⭐️</td>
                        <td><?php echo $comment['comment'];?></td>
                        <td><?php echo $comment['comment_date'];?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>                  
            <?php else : ?>
                <div>Pas (encore !) de commentaires utilisateurs.</div>
            <?php endif; ?>
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <form action="submit_comment.php" method="post" enctype="multipart/form-data">
                    <div class = "mb-3 visually-hidden">
                        <br><label for="id">Identifiant de la recette'</label></br>
                        <input type="hidden" class="form-control" id="id" name="recipe_id" value="<?php echo($recipe['recipe_id'])?>">
                    </div>
                    <div>
                        <br><label for="rating">Notez cette recette</label></br>
                        <input type="number" min="1" max="5" step="1" id="rating" placeholder="Note (1 à 5)" name="review" required 
                        style="width: 110px; height: 40px;"></textarea>
                    </div>
                    <div>
                        <br><label for="comment">Ajoutez un commentaire</label></br>
                        <textarea id="comment" placeholder="Qu'avez-vous pensé de cette recette ?" name="comment"></textarea>
                    </div>
                    <br><button type="submit">Envoyer</button></br>
                </form>
            <?php endif; ?>
        </article></br>
    </div>
<!-- inclusion du bas de page du site -->
<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>


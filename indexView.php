
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Blog</title>
</head>
<body>
    <h1>Le blog sur le PHP</h1>
    <br>
    <h4>Derniers billets de blog</h4>

    <?php
    while($data = $posts->fetch()) {
    ?>
        <div class="news">
            <h3>
            <?= htmlspecialchars(ucfirst($data['title'])) ?>
               le <?= $data['date'] ?>
            </h3>
            <p>
                <?= htmlspecialchars(ucfirst($data['content'])) ?>
                <br>
                <a href="post.php?id=<?=$data['id'] ?>">Commentaires</a>
            </p>
        </div>;
<?php
    }
    $posts->closeCursor();
?>



</body>
</html>
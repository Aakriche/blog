<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h4>Derniers billets du blog :</h4>

    <?php
    while($data = $posts->fetch()) {
    ?>
        <div class="news">
            <h3>
            <?= htmlspecialchars(ucfirst($data['title'])) ?>
               le <?= $data['creation_date_fr'] ?>
            </h3>
            <p>
                <?= htmlspecialchars(ucfirst($data['content'])) ?>
                <br>
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
            </p>
        </div>;
<?php
    }
    $posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
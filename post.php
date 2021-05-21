<?php
require('model.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);
    require('postView.php');
}
else {
    echo 'Erreur : aucun identifiant de billet envoyé';
}
if (empty($post)){
    echo "<h1>Billet inconnu</h1>";
}else{
?>

   <div class="news">
        <h3>'
            <?=htmlspecialchars(ucfirst($post['title'])) ?>
            <?= $post['date'] ?>
        </h3>
        <p>
            <?= htmlspecialchars(ucfirst($post['content'])) ?>
        </p>
    </div>


    
   
    <form class="formulaire" action="commentaires.ext.php?id=<?= $post ?> "method="POST">
    <label>Pseudo</label>
    <input type="text" name="pseudo">
    <label>Commentaire</label>
    <textarea type="text" name="commentaire"></textarea>
    <button type="submit" name="submit">Envoyer</button>
    </form>
    <div class="commentaires">

    

    <h2>Commentaires</h2>
    <?php
}

    
    while($comment = $comments->fetch()) {
        echo '<p><span class="auteur">'
                .htmlspecialchars(ucfirst($comment['author']))
                .'</span> le '
                .$comment['date']
                .'</p><br><p>'
                .htmlspecialchars(ucfirst($comment['comment']))
                .'</p><br>';
    }


?>
</div>





</body>
</html>
<?php $title = htmlspecialchars($comment['title']); ?>

<?php ob_start(); ?>
    <h1>Le blog sur le PHP</h1>

    <br>
    <h4><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Retour au Billet</a></h4>

    
 <form class="formulaire" action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>"method="POST">
 <label>Pseudo</label>
 <input type="text" name="author" placeholder="<?= $comment['author'] ?>">
 <label>Commentaire</label>
 <textarea type="text" name="comment" placeholder="<?= $comment['content'] ?>"></textarea>
 <button type="submit" name="submit">Envoyer</button>
 </form>
 <div class="commentaires">

 <?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
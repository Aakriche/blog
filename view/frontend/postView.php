<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <h1>Le blog sur le PHP</h1>

    <br>
    <h4><a href="index.php">Retour à la liste des billets</a></h4>

<div class="news">
     <h3>
         <?=htmlspecialchars(ucfirst($post['title'])) ?>
         <?= $post['creation_date_fr'] ?>
         (<a href="index.php?action=editComment&amp;id=<?= $post['id'] ?>">modifier</a>)
     </h3>
     <p>
         <?= htmlspecialchars(ucfirst($post['content'])) ?>
     </p>
 </div>




 <form class="formulaire" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>"method="POST">
 <label>Pseudo</label>
 <input type="text" name="author">
 <label>Commentaire</label>
 <textarea type="text" name="comment"></textarea>
 <button type="submit" name="submit">Envoyer</button>
 </form>
 <div class="commentaires">

 

 <h2>Commentaires</h2>
 <?php


 
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
<?php $content = ob_get_clean(); ?>
<?php var_dump($post); ?>
<?php require('template.php'); ?>
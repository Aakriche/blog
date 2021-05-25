<?php $title = 'ERROR'; ?>

<?php ob_start(); ?>
<h1>Erreur SQL</h1>

<h2><a href="index.php">Retour à l'accueil</a></h2>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
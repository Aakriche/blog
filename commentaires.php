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
    <h4><a href="index.php">Retour à la liste des billets</a></h4>
<?php
    $idBillet = $_GET['id'];
    try
    {
    $searchSend = new PDO('mysql: host=localhost;dbname=forum', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


$searchResp = $searchSend->prepare("SELECT DISTINCT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date
FROM billets
WHERE ( id LIKE '%{$idBillet}%' ) ");
$searchResp->execute(array($idBillet));
$donnees = $searchResp->fetch();


echo '<div class="news">
            <h3>'
                .htmlspecialchars(ucfirst($donnees['titre']))
                .' '
                .$donnees['date']
                .'</h3><p>'
                .htmlspecialchars(ucfirst($donnees['contenu']))
                .'</p></div>';


                ?>
<div class="commentaires">
    
<?php


    echo '<h2>Commentaires</h2>';

    $searchResp = $searchSend->prepare("SELECT DISTINCT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') AS date 
    FROM commentaires 
    WHERE ( id_billet LIKE '%{$idBillet}%' )  
    ORDER BY id DESC LIMIT 0, 10");
    $searchResp->execute(array($idBillet));
    
    while($donnees = $searchResp->fetch()) {
        echo '<p><span class="auteur">'
                .htmlspecialchars(ucfirst($donnees['auteur']))
                .'</span> le '
                .$donnees['date']
                .'</p><br><p>'
                .htmlspecialchars(ucfirst($donnees['commentaire']))
                .'</p><br>';
    }

    $searchResp->closeCursor();
?>
</div>


</body>
</html>
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

// Le billet + formulaire
$searchResp = $searchSend->prepare("SELECT DISTINCT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date
FROM billets
WHERE ( id LIKE '%{$idBillet}%' ) ");
$searchResp->execute(array($idBillet));
$donnees = $searchResp->fetch();
if (empty($donnees)){
    echo "<h1>Billet inconnu</h1>";
}else{


    echo '<div class="news">
                <h3>'
                    .htmlspecialchars(ucfirst($donnees['titre']))
                    .' '
                    .$donnees['date']
                    .'</h3><p>'
                    .htmlspecialchars(ucfirst($donnees['contenu']))
                    .'</p></div>';


    // Le formulaire
    echo'
    <form class="formulaire" action="commentaires.ext.php?id=<?php echo $idBillet ?>" method="POST">
    <label>Pseudo</label>
    <input type="text" name="pseudo">
    <label>Commentaire</label>
    <textarea type="text" name="commentaire"></textarea>
    <button type="submit" name="submit">Envoyer</button>

    </form>

    <div class="commentaires">';

    // Les commentaires

    echo '<h2>Commentaires</h2>';
}

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
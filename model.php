<?php
function getPosts() {

$db = dbConnect();
$posts = $db->query("SELECT DISTINCT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date 
FROM billets 
ORDER BY id 
DESC LIMIT 0, 5");

return $posts;
}

function getPost($postId) {

    $db = dbConnect();
    $req = $db->prepare("SELECT DISTINCT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date 
    FROM billets 
    ORDER BY id 
    DESC LIMIT 0, 5");
    $req->execute(array($postId));
    $post = $req->fetch();
    
    return $post;
    }

function getComments($postId) {

    $db = dbConnect();
    $comments = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS date 
    FROM commentaires 
    WHERE ( post_id LIKE '%{$postId}%' )  
    ORDER BY comment_date DESC");
    $comments->execute(array($postId));
    
    return $comments;

}

function dbConnect() {

    try
    {
    $db = new PDO('mysql: host=localhost;dbname=forum', 'root', '');
    return $db;
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}


?>
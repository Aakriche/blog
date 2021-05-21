<?php
if(isset($_POST["submit"])){
    
    // PDO request
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "forum";
    $conn = new PDO("mysql: host={$servername}; dbname={$dBName}",$dBUsername, $dBPassword);

    try
    {
    $conn;
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $pseudo = $_POST["pseudo"];
    $commentaire = $_POST["commentaire"];
    $idBillet = $_GET['id'];

        // Fields Checking
    if(empty($pseudo) || !preg_match("/^[a-zA-ZÀ-ú0-9_ ]*$/", $pseudo)){
        header("Location: ./commentaires.php?id={$idBillet}&error=invalidnom");
        exit();
    } else if ( empty($commentaire) || !preg_match("/^^[a-zA-ZÀ-ú0-9_ ?!.,\/()+\'-=\*€\}\{#]*$/", $commentaire)){
        header("Location: ./commentaires.php?id={$idBillet}&error=invalidqualit");
        exit();
    }else{
        // Adding
        $sql = "INSERT INTO commentaires(auteur,commentaire, id_billet) VALUES (?, ?, ?);";
        $res = $conn->prepare($sql);
        $res->execute(array($pseudo, $commentaire, $idBillet));

        if(!$res){
            header("Location: ./commentaires.php?id=".$idBillet."&error=sqlerror");
            exit(); 
        }else{
            header("Location: ./commentaires.php?id=".$idBillet."&comment=success");
            exit();
        }


        
        


        

    }
    $conn ->close();



}else{
    header("Location: ./Index.php");
    exit();
}

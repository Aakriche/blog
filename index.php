<?php
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'listPosts'){
            listPosts();
        }

        else if ($_GET['action'] == 'post') {

            if (isset($_GET['id']) && $_GET['id'] > 0){
                post();
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
                }
                else {
                    throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }
    } else {
        listPosts();
    }
}
catch(Exception $e){
    echo 'Erreur : '. $e->getMessage();
}



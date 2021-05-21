<?php
function getBillets() {

try
{
$searchSend = new PDO('mysql: host=localhost;dbname=forum', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$req = $searchSend->query("SELECT DISTINCT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date 
FROM billets 
ORDER BY id 
DESC LIMIT 0, 5");

return $req;
}

?>
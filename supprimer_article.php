<?php

$engine = "mysql";

// IP
$host = "localhost";

$port = 8889;

$dbName = "shiba_db";

$username = "root";

$passeword = "root";

$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);


if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
    
    $suppr = $bdd->prepare('DELETE FROM article WHERE id = ?');
    $suppr->execute(array($suppr_id));

    header('Location: http://localhost:8888/commentaire.php?id=8 ');
}    
?>
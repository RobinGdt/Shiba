<?php

$engine = "mysql";

// IP
$host = "localhost";

$port = 8889;

$dbName = "shiba_db";

$username = "root";

$passeword = "root";

$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);

$getid = htmlspecialchars($_GET['id']);

$id = $bdd->prepare('SELECT * FROM article WHERE id = ?');
$id->execute(array($getid));
$id = $id->fetch();


$id_article = $bdd->prepare('SELECT * FROM commentaire WHERE id_article = ?');
$id_article->execute(array($getid));
$id_article = $id_article->fetch();

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
    
    $suppr = $bdd->prepare('DELETE FROM commentaire WHERE id = ?');
    $suppr->execute(array($suppr_id));


    header('Location: http://localhost:8888/homepage.php?id=42');
}    
?>
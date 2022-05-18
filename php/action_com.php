<?php
$bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');

if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) {
    $getid = (int) $_GET['id'];
    $gett = (int) $_GET['t'];

    $checkcom = $bdd->prepare('SELECT * FROM commentaire WHERE id = ?');
    $checkcom->execute(array($getid));

    if($checkcom->rowCount() == 1) {
        if($gett == 1) {
            $ins = $bdd->prepare('INSERT INTO likes_com (id_com) VALUES (?)');
            $ins->execute((array($getid)));
        }elseif($gett == 2) {
            $ins = $bdd->prepare('INSERT INTO dislikes_com (id_com) VALUES (?)');
            $ins->execute((array($getid)));
        }
        header('Location: http://localhost:8888/commentaire.php?id='.$getid);
    }else{
        exit('Erreur fatale');
    }

}else{
    exit('Erreur fatale...');
}
<?php

$bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');

$getid = htmlspecialchars($_GET['id']);

if (isset($_POST['repondre'])) {
    if (isset($_POST['reponse']) and !empty($_POST['reponse'])) {
        $commentaire_bis = htmlspecialchars($_POST['reponse']);

            $ins = $bdd->prepare('INSERT INTO commentaire (reponse, id_article) VALUES (?,?)');
            $ins->execute(array($commentaire_bis, $getid));
            $c_msg = "<span style='color:green'>Votre réponse a bien été postée</span><br />";
            // header('Location: http://localhost:8888/commentaire.php?id='.$getid);
    } else {
        $c_msg = "Erreur: Tous les champs doivent être complétés ";
    }
}
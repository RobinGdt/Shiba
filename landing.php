<?php
    session_start();
    require_once 'config.php';          // ajout connexion bdd 


    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
    

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bonjour !</title>
    </head>
    <body>
        <h1>Bonjour <?php echo $data['pseudo']; ?> !</h1>
        <a href="deconnexion.php" class="btn">Déconnexion</a>
        <a href="profil.php" class="btn">Mon Profil</a>
        <a href="membres.php" class="btn">membres</a>
        <a href="amis.php" class="btn">amis</a>
        <a href="groupe.php" class="btn">Crée un groupe</a>
        <a href="dashboard.php" class="btn">Ajouter une page</a>


    </body>
</html>
<?php


session_start();
require_once 'config.php';          

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
    <title>Document</title>
</head>
<body>
    <h1>DASHBOARD PAGES</h1>    
    

    <h1>Bienvenue <?php echo $data['pseudo']; ?>, ici vous pouvez gerer vos pages !</h1>
        <a href="landing.php" class="btn">Accueil</a>
        <a href="preview-user.php" class="btn">Voir les utilisateurs</a>
        <a href="preview-pages.php" class="btn">Voir les pages</a>
        <a href="add-pages.php" class="btn">Ajouter une page</a>
        

</body>
</html>
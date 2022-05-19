<?php

require_once 'config.php'; 
$liens = [
    
    "Dashboard" => "dashboard.php",
    "Liste des utilisateur" => "preview-user.php",
    "Ajouter utilisateur" => "add-user.php",
    "Voir les pages" => "preview-pages.php",
    "Ajouter une pages" => "add-pages.php",
    "logout"=>"logout.php"

];


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = filter_input(INPUT_POST, "identifiant");
    $password = filter_input(INPUT_POST, "password");
    
    

    

    $maRequete = $pdo->prepare("INSERT INTO user (identifiant,password,date_creation) VALUES(:identifiant,:password,NOW())");
    // Etape 2 : Exécuter la requête
    $maRequete->execute([
        ":identifiant" => $identifiant,
        ":password" => $password,
        
    ]);
    
    
    http_response_code(302); 
    header('Location: preview-user.php');
    echo 'The publisher has been updated successfully!';

    exit();
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
</head>
<body>
<nav>
        <ul>
            <?php foreach($liens as $libelle =>$lien ): ?>
                
                <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <h1>Ajouter un utilisateur </h1>
    <form method="POST">
        <label for="user">Nom de l'utilisateur à ajouter :</label>
        <input type="text" id="identifiant" name="identifiant" placeholder="identifiant" />
        <input type="password" id="password" name="password" placeholder="mot de passe" />
      

        <input type="submit" value="ajouter l'utilisateur" />
    </form>
    
</body>
</html>
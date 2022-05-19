<?php
$liens = [
    
    "Dashboard" => "dashboard.php",
    "Voir utilisateur" => "preview-user.php",
    "Voir les pages" => "preview-pages.php",
    "Ajouter une pages" => "add-pages.php",

];
require_once 'config.php'; 


//afficher les utilisateurs
$statement = $bdd->prepare("SELECT * FROM users");

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);


$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);




$maRequete = $bdd->prepare("SELECT * FROM pages WHERE pages_id = :id");

$maRequete->execute([
    ":id" => $id
]);
$maRequete->setFetchMode(PDO::FETCH_ASSOC);
$idpages = $maRequete->fetch();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Detail de la pages</title>
</head>
<body>
     <nav>
                <ul>
                    <?php foreach($liens as $libelle =>$lien ): ?>
                
                    <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
                <?php endforeach; ?>
                </ul>
                </nav>
        


    <h1>Nom de la pages : "<?= $idpages["pages_name"] ?>"</h1>
    <h3>Id page : <?= $idpages["pages_id"] ?></h3>
    <br>
    <h3>Contenu <?= $idpages["pages_contain"] ?></h3>
    

    
</body>
</html>
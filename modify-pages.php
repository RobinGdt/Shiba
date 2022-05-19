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


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nomPage = filter_input(INPUT_POST, "nomPage");
    $userid = filter_input(INPUT_POST, "userid");
    $pagecont = filter_input(INPUT_POST, "pagecont");
     

    $maRequete2 = $bdd->prepare("UPDATE pages SET pages_name = :nomPage, pages_contain = :pagecont,user_id = :userid WHERE pages.pages_id = :id");

    $maRequete2->execute([
        ":nomPage" => $nomPage,
        ":pagecont" => $pagecont,
        ":userid" => $userid,
        ":id" => $id
    ]);
    $maRequete2->setFetchMode(PDO::FETCH_ASSOC);
    $idpages = $maRequete2->fetch();
    http_response_code(302); 
    header('Location: preview-pages.php');
    echo 'The party has been updated successfully!';

    exit();
}
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
    <h1>Modifier la pages</h1>
    <form method="POST">
        <label for="user">Modifier nom de la page</label>
        <input type="text" id="nomPage" name="nomPage" placeholder="nouveau nom" />
        <label for="user">Utilisateur present</label>

        <input type="text" id="userid" name="userid" placeholder="user id" />
              <label for="user">contenu à ajouter</label>
        <input type="text" id="pagecont" name="pagecont" placeholder="ecrivez le contenu" />



        <input type="submit" value="Modifier pages" />
    </form>
    <h4>Liste Utilisateur que vous pouvez ajouter</h4>
    <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Identifiant</th>
                    
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user["id"] ?>   </td>
                        <td><?= $user["pseudo"] ?></td>
                    </tr>
                <?php endforeach; ?>
               
            </tbody>
        </table>

    
    
</body>
</html>
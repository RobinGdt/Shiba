<?php
require_once 'config.php'; 

$statement = $bdd->prepare("SELECT * FROM users");

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);
$liens = [
    
    "Dashboard" => "dashboard.php",
    "Voir utilisateur" => "preview-user.php",
    "Voir les pages" => "preview-pages.php",
    "Ajouter une pages" => "add-pages.php",

];
?>

<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Utilisateur</title>
    </head>



    <body>

        <h1>Liste Utilisateur</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Date de creation</th>
                    <th>Supprimer</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user["id"] ?>   </td>
                        <td><?= $user["pseudo"] ?></td>
                        <td><?= $user["date_inscription"] ?></td>
                        <td> <a href="delete-user.php?id=<?= $user["id"] ?>">supprimer</a></td>
                        

                    </tr>
                <?php endforeach; ?>
                <nav>
                <ul>
                    <?php foreach($liens as $libelle =>$lien ): ?>
                
                    <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
                <?php endforeach; ?>
                </ul>
                </nav>
            </tbody>
        </table>

    </body>



    </html>

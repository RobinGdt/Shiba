<?php
require_once 'config.php'; 
$statement = $bdd->prepare("SELECT pages.pages_id,pages.pages_name,pages.pages_contain,users.id,users.pseudo FROM `users`,`pages` WHERE pages.user_id = users.id ORDER BY users.pseudo");
//SELECT * FROM groupes
//SELECT group_id,group_name,user_id,identifiant FROM groupes INNER JOIN user ON groupes.group_id = user.id
$statement->execute();

$pages = $statement->fetchAll(PDO::FETCH_ASSOC);
$liens = [
    
    "Dashboard" => "dashboard.php",
    "Ajouter utilisateur" => "add-user.php",
    "Voir les pages" => "preview-pages.php",
    "Ajouter une page" => "add-pages.php",
];
?>

<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Utilisateur</title>
    </head>



    <body>
<nav>
                <ul>
                    <?php foreach($liens as $libelle =>$lien ): ?>
                
                    <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
                <?php endforeach; ?>
                </ul>
                </nav>
        <h1>Liste des pages</h1>
        <table>
            <thead>
                <tr>
                    <th>Id des pages</th>
                    <th>Nom pages</th>
                    <th>Contenu</th>
                    <th>id user</th>
                    <th>Pseudo</th>
                    <th>Afficher la page entiere</th>
                    <th>Modifier</th>
                   
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach($pages as $page): ?>
                    <tr>
                        <td><?= $page["pages_id"] ?>   </td>
                        <td><?= $page["pages_name"] ?></td>
                        <td><?= $page["pages_contain"] ?></td>
                        <td><?= $page["id"] ?></td>
                        <td><?= $page["pseudo"] ?></td>                        
                        <td> <a href="pages-entiere.php?id=<?= $page["pages_id"] ?>">afficher la page entiere</a></td>
                        <td> <a href="delete-pages.php?id=<?= $page["pages_id"] ?>">Supprimer</a></td>
                        <td> <a href="modify-pages.php?id=<?= $page["pages_id"] ?>">Modifier</a></td>
                       
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>

    </body>



    </html>

<?php

require_once 'config.php'; 
$liens = [
    
    "Dashboard" => "dashboard.php",
    "Voir utilisateur" => "preview-user.php",
    "Voir les pages" => "preview-pages.php",
    "Ajouter une pages" => "add-pages.php",

];

//afficher les utilisateurs

$statement = $bdd->prepare("SELECT pages.pages_id,pages.pages_name,pages.pages_contain,users.id,users.pseudo FROM `pages`,`users` WHERE pages.user_id = users.id ORDER BY users.pseudo");

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);
//////////////////////////////////////////////////////////////////////
//afficher les pages
$statement = $bdd->prepare("SELECT * FROM pages");
$statement->execute();

$pages = $statement->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $newpages = filter_input(INPUT_POST, "newpages");
    $idinside = filter_input(INPUT_POST, "idinside");
    $pagesCont = filter_input(INPUT_POST, "pagesCont");
    
    

    

    $maRequete = $bdd->prepare("INSERT INTO pages (pages_name,pages_contain,user_id) VALUES(:newpages,:pagesCont,:idinside)");
    $maRequete->execute([
        ":newpages" => $newpages,
        ":idinside" => $idinside,
        ":pagesCont" => $pagesCont,

        
    ]);


    
    http_response_code(302); 
    echo 'operation reussite';
    header('Location: add-pages.php');
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une pages</title>
</head>
<body>
    <nav>
        <ul>
            <?php foreach($liens as $libelle =>$lien ): ?>
                
                <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

   
        





    <h1>Ajouter une nouvelle pages</h1>
<br>


    <form method="POST">
        <label for="user">Nom de la pages à ajouter :</label>
        <input type="text" id="newpages" name="newpages" placeholder="nom de la pages" />
        <label for="user">Contenue à ajouter :</label>
        <input type="text" id="pagesCont" name="pagesCont" placeholder="contenu" required
       minlength="4" maxlength="800" size="100" />
        <label for="user">id de l'utilisateur à ajouter :</label>
        <input type="text" id="idinside" name="idinside" placeholder="id" />
        
        
        
       
         <input type="submit" value="ajouter une page" />
           
    </form>
    <center> <h2> Liste des pages</h2></center>
    <table> 
            <thead>
                <tr>
                    <th>Id</th>
                    <th>pseudo</th>
                    <th>Id pages</th>
                    <th>Titre Page</th>
                    <th>contenu</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user["id"] ?>   </td>
                        <td><?= $user["pseudo"] ?></td>
                        <td><?= $user["pages_id"] ?></td>
                        <td><?= $user["pages_name"] ?></td>
                        <td><?= $user["pages_contain"] ?></td>
                        

                    </tr>
                <?php endforeach; ?>

</body>
</html>
 

</select>
<?php
    session_start();
    require_once 'PDO.php'; 

    $msg = "";

    if(isset($_POST['create_group'])) {

        $tokenGroup = bin2hex(openssl_random_pseudo_bytes(64));
        $name = $_POST['name_group'];



        if($_POST['state'] == "on") {
            $state = 1;
        } else {
            $state = 0;
        }

        if (!empty($name)) {
            $CheckName = $bdd->prepare('SELECT nameGroup from Groups WHERE nameGroup = ?');
            $CheckName->execute(array($name));

            if($CheckName->rowCount() == 0) {
                // création du groupe
                $create = $bdd->prepare('INSERT INTO groups(tokenGroup, nameGroup, description, state, date) VALUES (:token, :name, :description_group, :state, NOW())');
                $create->execute(array(
                    "token" => $tokenGroup,
                    "name" => $name,
                    "description_group" => $_POST['description_group'],
                    "state" => $state 
                ));
                // création de l'administrateur
                $create_member = $bdd->prepare('INSERT INTO members_group(tokenGroup, tokenID, admin, date) VALUES (:tokenG, :token, :admin, NOW())');
                $create_member->execute(array(
                    "tokenG" => $tokenGroup,
                    "token" => $_SESSION['user'],
                    "admin" => 1
                ));
                header('Location: pageGroupe.php?token='. $tokenGroup);
            } else {
                $msg = "Le nom du groupe existe déjà !";
            };
        } else {
            $msg = "Veuillez remplir tous les champs !";
        };
        

    }

    $afficher_groups = $bdd->prepare("SELECT * FROM groups ORDER BY nameGroup");
    $afficher_groups->execute();


    function CheckMembers($bdd, $tokenGroup) {
        $members_num = $bdd->prepare("SELECT * FROM members_group WHERE tokenGroup = ?");
        $members_num->execute(array($tokenGroup));

        return $members_num->rowCount();

    };

    

 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shiba - Groupes </title>
    </head>
    <body> 
        <h3>Créer un groupe</h3>
        <div>
            <form action="" method="post">
                <input type="text" name="name_group" placeholder="saisir le nom du groupe...">
                <input type="text" name="description_group" placeholder="saisir une description... (facultatif)" maxlength="60">
                <p>groupe privé : <input type="checkbox" name="state"></p>
                <input type="submit" name="create_group" value="Créer le groupe !">
            </form>
        </div>
        <p> <?= $msg ?> </p>
        <h3>Liste des groupes (<?= $afficher_groups->rowCount() ?>)</h3>
        <?php foreach($afficher_groups as $group){ ?>
        <div>
            <p> Nom du groupe : <?php echo $group['nameGroup']; ?> </p>
            <p>membres : <?= CheckMembers($bdd, $group['tokenGroup']) ?></p>
            <p><?php if($group['state'] == 0): echo "Groupe public" ?> <?php else: echo "Groupe privé" ?> <?php endif ?></p>
            <p> date de création : <?php echo $group['date']; ?> </p>
            <a href="pageGroupe.php?token=<?= $group['tokenGroup'] ?>"><p>Voir le groupe</p></a>
        </div>
        <?php } ?>
        <p><a href="landing.php">Retour</a></p>
    </body>
</html>
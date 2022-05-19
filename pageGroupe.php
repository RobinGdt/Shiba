<?php
    session_start();
    require_once 'PDO.php';      // On inclu la connexion à la bdd

    $tokenGroup = trim($_GET['token']);

    $msg = "";
    $candidat = "";

    // connaître les membres du groupe
    $members_num = $bdd->prepare("SELECT * FROM members_group WHERE tokenGroup = ? AND tokenID != ?");
    $members_num->execute(array($tokenGroup, $_SESSION['user']));


    //récupérer ses amis
    $RecupFriends = $bdd->prepare('SELECT tokenFriend FROM friends WHERE tokenID = ?');
    $RecupFriends->execute(array($_SESSION['user']));

    function RecupInfoFriend($bdd, $tokenFriend){
        $NameFriend = $bdd->prepare("SELECT pseudo FROM users WHERE token = ?");
        $NameFriend->execute(array($tokenFriend));
        $Name = $NameFriend->fetch();
        return $Name['pseudo'];
    };

    // récupérer les informations du groupe (token, nom du groupe, état (public, privé))
    $RecupInfoG = $bdd->prepare('SELECT * FROM groups WHERE tokenGroup = ?');
    $RecupInfoG->execute(array($tokenGroup));
    $InfoGroup = $RecupInfoG->fetch();

    // Savoir si l'utilisateur est dans le groupe et son état (membre, admin)
    $RecupInTable = $bdd->prepare('SELECT * from members_group WHERE tokenGroup = ? AND tokenID = ?');
    $RecupInTable->execute(array($tokenGroup, $_SESSION['user']));
    $Intable = $RecupInTable->rowCount();
    $InfoIntable = $RecupInTable->fetch();

    // vérifier les candidatures dans un groupe privé
    $Check_candid = $bdd->prepare('SELECT * FROM candid_group WHERE tokenGroup = ?');
    $Check_candid->execute(array($tokenGroup));


    // Rejoindre le groupe (public) ou candidater pour le groupe (privé)
    if(isset($_POST['candid'])) {
        if($InfoGroup['state'] == 0) { // groupe public
            $add_InGroup = $bdd->prepare('INSERT INTO members_group(tokenGroup, tokenID, admin, date) VALUES (:tokenGroup, :tokenID, :admin, NOW())');
            $add_InGroup->execute(array(
                "tokenGroup" => $tokenGroup,
                "tokenID" => $_SESSION['user'],
                "admin" => 0
            ));
            header('Location: landing.php');
        } else { // groupe privé
            $Check_candidUser = $bdd->prepare('SELECT * FROM candid_group WHERE tokenGroup = ? AND tokenID = ?');
            $Check_candidUser->execute(array($tokenGroup, $_SESSION['user']));
            if($Check_candidUser->rowCount() == 0) {
                $candid_InGroup = $bdd->prepare('INSERT INTO candid_group(tokenGroup, tokenID, state, date) VALUES (:tokenGroup, :tokenID, :state, NOW())');
                $candid_InGroup->execute(array(
                    "tokenGroup" => $tokenGroup,
                    "tokenID" => $_SESSION['user'],
                    "state" => $InfoGroup['state']
                ));
                $msg = "Votre candidature a été envoyé au groupe !";
            } else {
                $msg = "Votre candidature a déjà été envoyé !";
            }


            
        };
    } else if (isset($_POST['leave_group'])) {
        if($InfoIntable['admin'] == 0) {
            $leaveG = $bdd->prepare('DELETE FROM members_group WHERE tokenGroup = ? AND tokenID = ?');
            $leaveG->execute(array($tokenGroup, $_SESSION['user']));
            header('Location: landing.php');
        } else {
            $msg = "Impossible, vous êtes l'administrateur de ce serveur !";
        }

    };

    //supprimer un groupe en étant admin
    if(isset($_POST['supp_group'])) {
        $del_group = $bdd->prepare('DELETE FROM groups WHERE tokenGroup = ?');
        $del_group->execute(array($tokenGroup));
        header('Location: groupes.php');
    };

    // ajouter ou décliner une candidature ou ajouter un ami au groupe
    if(isset($_POST)) {
        
        $accept = "/accept"; // string pour le formulaire
        $decline = "/decline"; // string pour le formulaire
        $addFriend = "/addGroup";
        $choice = key($_POST);

        $choiceCandid ="";

        if (strpos($choice, $accept)) { // ajouter candid
            echo "La candidature est acceptée";
            $choiceCandid = substr($choice, 0, -7); // supprimer le /accept de la chaine de caractère pour avoir le token du membre

            $add = $bdd->prepare('INSERT INTO members_group(tokenGroup, tokenID, admin, date) VALUES(:tokenGroup, :tokenID, :admin, NOW())'); // acceptation de la candidature
            $add->execute(array(
                "tokenGroup" => $tokenGroup,
                "tokenID" => $choiceCandid,
                "admin" => 0
            ));
        } else if (strpos($choice, $decline)) { // décliner candid
            echo "La candidature est refusée";
            $choiceCandid = substr($choice, 0, -8); // supprimer le /decline de la chaine de caractère pour avoir le token du membre
        } else if (strpos($choice, $addFriend)) {
            $choiceCandid = substr($choice, 0, -9);
            $RecupInTable = $bdd->prepare('SELECT * from members_group WHERE tokenGroup = ? AND tokenID = ?');
            $RecupInTable->execute(array($tokenGroup, $choiceCandid));
            $Intable = $RecupInTable->rowCount();


            if ($Intable == 0) {
                $add = $bdd->prepare('INSERT INTO members_group(tokenGroup, tokenID, admin, date) VALUES(:tokenGroup, :tokenID, :admin, NOW())'); // acceptation de la candidature
                $add->execute(array(
                    "tokenGroup" => $tokenGroup,
                    "tokenID" => $choiceCandid,
                    "admin" => 0
                ));
                $msg = "Votre ami a été invité au groupe !";
            } else {
                $msg = "Votre ami est déjà dans le groupe !";
            }

        };

        $deleteCandid = $bdd->prepare('DELETE FROM candid_group WHERE tokenGroup = ? AND tokenID = ?');
        $deleteCandid->execute(array($tokenGroup, $choiceCandid));
    };

    // fonction pour récupérer les informations du candidat
    function RecupInfoCandi($bdd, $tokenCandi) { 
        $Info = $bdd->prepare('SELECT pseudo from users WHERE token = ?');
        $Info->execute(array($tokenCandi));
        $data = $Info->fetch();

        return $data;
    };

    // ajouter un post
    if(isset($_POST['post_public'])) {
        $CheckUser = $bdd->prepare('SELECT pseudo from users WHERE token = ?');
        $CheckUser->execute(array($_SESSION['user']));
        $dataUser = $CheckUser->fetch();

        $add_public = $bdd->prepare('INSERT INTO publication_group(tokenGroup, auteur, titre, contenu, date) VALUES (:tokenGroup, :auteur, :titre, :contenu, NOW())');
        $add_public->execute(array(
            "tokenGroup" => $tokenGroup,
            "auteur" => $dataUser['pseudo'],
            "titre" => $_POST['title_public'],
            "contenu" => $_POST['contenu_public'],
        ));
    };

    $RecupPublic = $bdd->prepare('SELECT * FROM publication_group WHERE tokenGroup = ? ORDER BY date');
    $RecupPublic->execute(array($tokenGroup));
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shiba - <?= $InfoGroup['nameGroup'] ?> </title>
    </head>
    <body>
        <h1><?= $InfoGroup['nameGroup'] ?></h1>
        <h2><?= $InfoGroup['description'] ?></h2>

        <?php if($Intable == 1)  { // si le user est dans le groupe ?>

            <form action="" method="post">
                <input type="submit" name="leave_group" value="Partir du groupe">
            </form>

            <p>Vous êtes dans le groupe en tant que <b><?php if($InfoIntable['admin'] == 0): echo "membre" ?> <?php else: echo "administrateur" ?> <?php endif ?></b></p>
            <?php if($InfoIntable['admin'] == 1) { // menu admin?>
            <div>
                <h2>Menu Admin</h2>
                <h3>Gérer les membres (en cours de développement)</h3>
                <?php foreach($members_num as $member) { ?>
                    <p><?= RecupInfoFriend($bdd, $member['tokenID']) ?> (<?php if($member['admin'] == 0): echo " Membre" ?> <?php else: echo " Administrateur" ?> <?php endif ?> )</p>
                    <form action="" method="post">
                        <input type="submit" value="<?php if($member['admin'] == 0): echo "Passer administrateur ?" ?> <?php else: echo "Passer membre ?" ?> <?php endif ?>">                 
                        <input type="submit" value="Supprimer du groupe">
                    </form>

                <?php } ?>
                <h3>Candidature</h3>
                <?php if($Check_candid->rowCount() > 0) { // si il y a au moins une candidature ?>
                        <?php foreach($Check_candid as $candid) { ?>
                            <p>token du candidat : <?php echo $candid['tokenID'] ?></p>
                            <p>nom du candidat : <a href="voir_profil.php?token=<?= $candid['tokenID'] ?>"><?php $user = RecupInfoCandi($bdd, $candid['tokenID']); echo $user['pseudo'] ?></p></a>
                            <form action="" method="post">
                                <input type="submit" name="<?= $candid['tokenID'] ?>/accept" value="accepter la demande">
                                <input type="submit" name="<?= $candid['tokenID'] ?>/decline" value="refuser la demande">
                            </form>
                        <?php } ?>   
                    <?php } else {?>
                        <p>Il n'y a aucune candidature...</p>
                    <?php }?>
                <?php } ?>
                <form action="" method="post">
                    <input type="submit" name="supp_group" value="Supprimer le groupe">
                </form>
            </div>

            <h3>Quelque chose à publier ?</h3>
            <form action="" method="post">
                <input type="text" name="title_public" placeholder="titre de la publication">
                <input type="text" name="contenu_public" placeholder="Contenu de la publication">
                <p>Rajouter une image :<input type="file" name="imgPubliGroup"></p>
                <input type="submit" name="post_public" value="poster dans le groupe">
            </form>
            
            <h3>Publications</h3> 
            <?php foreach($RecupPublic as $Public) { ?>
                <div>
                    <h4><?= $Public['titre'] ?></h4>
                    <p>Date de publication : <?= $Public['date'] ?> par <?= $Public['auteur'] ?></p>
                    <p><?= $Public['contenu'] ?></p>
                </div>
            <?php } ?>

            <h3>Inviter vos amis</h3>
            <?php foreach($RecupFriends as $Friend) { ?>
                <form action="" method="post">
                    <input type="submit" name="<?= $Friend['tokenFriend'] ?>/addGroup" value="inviter <?= RecupInfoFriend($bdd, $Friend['tokenFriend']) ?>">
                </form>
            <?php } ?>
        <?php } else if ($Intable == 0 AND $InfoGroup['state'] == 0) { ?>

            <form action="" method="post">
                <input type="submit" name="candid" value="<?php if($InfoGroup['state'] == 0): echo "Rejoindre le groupe" ?> <?php else: echo "Envoyer ma candidature" ?> <?php endif ?>">
            </form>

            <h3>Publications</h3> 
            <?php foreach($RecupPublic as $Public) { ?>
                <div>
                    <h3><?= $Public['titre'] ?></h3>
                    <p>Date de publication : <?= $Public['date'] ?> par <?= $Public['auteur'] ?></p>
                    <p><?= $Public['contenu'] ?></p>
                </div>
            <?php } ?>
            <?php if($InfoIntable['admin'] == 1) { ?>

            <?php } ?>
            <?php if($InfoGroup['state'] == 1) { // groupe privé ?>

             <?php } ?> 

        <?php } else if ($Intable == 0) { ?>
            <form action="" method="post">
                <input type="submit" name="candid" value="<?php if($InfoGroup['state'] == 0): echo "Rejoindre le groupe" ?> <?php else: echo "Envoyer ma candidature" ?> <?php endif ?>">
            </form>
        <?php  } ?>
        <p><a href="groupes.php">Retour</a></p>
        <p><?= $msg ?></p>
    </body>
</html>
<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');


    $users_token = trim($_GET['token']);

    if(empty($users_token)){
        header('Location: membres.php');
    }

    $req = $bdd->prepare("SELECT lastname, age, name, pseudo, token, tokenID, gender, birthday, phone, ImgProfile, ImgBanner, email, date_inscription FROM users INNER JOIN profiles WHERE token = ? AND tokenID = ? ");
    $req->execute(array($users_token, $users_token));
    $show_users = $req->fetch();

    if (!empty($_POST)) {
        $friend = key($_POST);

        $search_friend = ValueInput($bdd, $friend);

        if ($search_friend < 1) {
            $add_friend = $bdd->prepare('INSERT INTO friends(tokenID, tokenFriend, date) VALUES(:tokenID, :tokenFriend, NOW())');
            $add_friend->execute(array(
                "tokenID" => $_SESSION['user'],
                "tokenFriend" => $friend
            ));
        } else {
            $delete_friend = $bdd->prepare('DELETE FROM friends WHERE tokenID = ? AND tokenFriend = ?');
            $delete_friend->execute(array($_SESSION['user'], $friend));
        };
    };

    function ValueInput($bdd, $token) {
        $InTable = $bdd->prepare("SELECT * FROM users WHERE token != ?");
        $InTable->execute(array($_SESSION['user']));
    
        $search = $bdd->prepare('SELECT tokenID, tokenFriend FROM friends WHERE tokenID = ? AND tokenFriend = ?');
        $search->execute(array($_SESSION['user'], $token));
        $search_friend = $search->rowCount();
        return $search_friend;
    };

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= $show_users['pseudo'] ?></title>
</head>
<body>
    <h1>Profil de <strong><?= $show_users['pseudo'] ?> </strong></h1>
    <ul>
        <img src="<?php $token = $_GET['token']; $img = $show_users['ImgProfile']; if(isset($img)): echo "users/$token/$img"  ?> <?php else: echo "users/photo-avatar-profil.png" ?> <?php endif; ?>" height="200">
        <img src="<?php $token = $_GET['token']; $img = $show_users['ImgBanner']; if(isset($img)): echo "users/$token/$img"  ?> <?php else: echo "users/BanniÃ¨re-blanche.jpg" ?> <?php endif; ?>" width="800", height="200">
        <li>Nom : <?php if(!empty($show_users['name'])): echo $show_users['name'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>lastname : <?php if(!empty($show_users['lastname'])): echo $show_users['lastname'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>pseudo : <?php if(!empty($show_users['pseudo'])): echo $show_users['pseudo'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>age : <?php if(!empty($show_users['age'])): echo $show_users['age'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>genre : <?php if(!empty($show_users['gender'])): echo $show_users['gender'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>anniversaire : <?php if(!empty($show_users['birthday'])): echo $show_users['birthday'] ?> <?php else: echo "Aucune information..." ?> <?php endif; ?></li>
        <li>date d'inscription : <?= $show_users['date_inscription'] ?></li>
        
    </ul>
    <form method="POST">
        <a href="message.php?token=<?= $show_users['token'] ?>">Message</a>
        <input type="submit" name="<?= $show_users['token'] ?>" value="<?php $Friend_InTable = ValueInput($bdd, $show_users['token']); if($Friend_InTable < 1): echo "Ajouter" ?> <?php else: echo "supprimer" ?> <?php endif ?>">
    </form> 
    <form action="membres.php" method="post">
    <button type="submit" class="btn">Retour</button>


    
</body>
</html>
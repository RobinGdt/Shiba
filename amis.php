<?php
    session_start();
    require_once 'config.php'; 

    $req1 = $bdd->prepare("SELECT tokenID, tokenFriend  FROM friends WHERE tokenID = ?");
    $req1->execute(array($_SESSION['user']));
    $friends = $req1->rowCount();
    
    
    function ValueInput($bdd, $token) {
        $InTable = $bdd->prepare("SELECT * FROM users WHERE token != ?");
        $InTable->execute(array($_SESSION['user']));
    
        $search = $bdd->prepare('SELECT tokenID, tokenFriend FROM friends WHERE tokenID = ? AND tokenFriend = ?');
        $search->execute(array($_SESSION['user'], $token));
        $search_friend = $search->rowCount();
        return $search_friend;
    };
    function RecupInfo($bdd, $tokenFriend){
        $NameFriend = $bdd->prepare("SELECT pseudo FROM users WHERE token = ?");
        $NameFriend->execute(array($tokenFriend));
        $Name = $NameFriend->fetch();
        return $Name['pseudo'];
    };
    
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
            header("Refresh:0");
        };
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Amis</title>
</head>
<body>
    <h1>Vous avez <?= $friends; ?> AMIS</h1>
    <section>
        <?php
            if($req1->rowCount() > 0){
                foreach($req1 as $friend){
                    ?>
                    <div>
                        <div>
                            <?= $NameF = RecupInfo($bdd, $friend['tokenFriend']) ?>
                        </div>
                        <a href="voir_profil.php?token=<?= $friend['tokenFriend'] ?>">Voir</a>
                        <a href="message.php?token=<?= $friend['tokenFriend'] ?>">Message</a>
                        <form method="POST">
                            <input type="submit" name="<?= $friend['tokenFriend'] ?>" value="<?php $Friend_InTable = ValueInput($bdd, $friend['tokenFriend']); if($Friend_InTable < 0): echo "Ajouter" ?> <?php else: echo "supprimer"; ?> <?php endif ?>">
                        </form>
                    </div>
                    <?php } ?>
                    <?php
                }?>
    </section>
    <p><a href="landing.php">Retour</a></p>


</body>
</html>
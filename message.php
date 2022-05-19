<?php
    session_start();
    require_once "config.php";

    $users_id = trim($_GET['token']);
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    if(isset($_POST['envoyer'])){
        $message = htmlspecialchars($_POST['message']);
        $insertMessage = $bdd->prepare("INSERT INTO message(message,  token_receveur, token_envoyeur)VALUES(?, ?, ?)");
        $insertMessage->execute(array($message,$users_id,$data['token']));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direct Messages</title>
</head>
<body>
    <form method="POST" action="">
        <textarea name="message"></textarea>
        <input type="submit" name="envoyer">
    </form>
    <div class="messages">

        <?php
        
            $reqMess = $bdd->prepare('SELECT * FROM message WHERE token_envoyeur = ? AND token_receveur = ? OR token_envoyeur = ? AND token_receveur =?');
            $reqMess ->execute(array($data['token'], $users_id, $users_id, $data['token']));
            while($message = $reqMess->fetch()){
                //message recu
                if($message['token_receveur']==$data['token']){
                    ?>
                    <p style ="color:blue"><?=$message['message']?></p>
                    <?php
                //message envoyee
                }else{
                    ?>
                    <p style ="color:green"><?=$message['message']?></p>
                    <?php
                }
                
            }
        ?>

    </div>
</body>
</html>
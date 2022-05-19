<?php
    session_start();
    require_once 'config.php'; 


    $afficher_membres = $bdd->prepare("SELECT * FROM users WHERE token != ? ORDER BY pseudo");
    $afficher_membres->execute(array($_SESSION['user']));

    if(isset($_GET['s']) AND !empty($_GET['s'])){
        $recherche = htmlspecialchars($_GET['s']);
        $afficher_membres = $bdd->prepare('SELECT * FROM users WHERE token != ? AND pseudo LIKE "%'.$recherche.'%" ORDER BY pseudo');
        $afficher_membres->execute(array($_SESSION['user']));
    }

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
    <title>Espace membre</title>
</head>
<body>

    <form method="GET">
        <input type="search" name="s" placeholder="rechercher un utilisateur" autocomplete="off">
        <input type="submit" name="envoyer">
    </form>

    <section>
        <?php
            if($afficher_membres->rowCount() > 0){
                foreach($afficher_membres as $am){
                    ?>
                    <div>
                        <div>
                            <?= $am['pseudo'] ?>
                        </div>
                        <a href="voir_profil.php?token=<?= $am['token'] ?>">Voir</a>
                        <form method="POST">
                            <input type="submit" name="<?= $am['token'] ?>" value="<?php $Friend_InTable = ValueInput($bdd, $am['token']); if($Friend_InTable < 1): echo "Ajouter" ?> <?php else: echo "supprimer" ?> <?php endif ?>">
                        </form> 
                        
                    </div>
                    <?php
                }?>
        <?php
                
            }else{
                ?>
                <p>Aucun utilisateur trouvé</p>
                <?php
            }  
        ?>
    </section>
    <p><a href="homepage.php?id=42">Retour</a></p>


</body>
</html>
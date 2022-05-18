<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Encode+Sans:wght@100&family=Jost:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
<?php
$bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');

session_start();

if (isset($_GET['id']) and !empty($_GET['id'])) {

    $mode_edition = 0;

    $getid = htmlspecialchars($_GET['id']);

    $user = $bdd->prepare(('SELECT * FROM users WHERE token = ?'));
    $user->execute(array($_SESSION['user']));
    $user = $user->fetch();

    $profile = $bdd->prepare(('SELECT * FROM profiles WHERE tokenID = ?'));
    $profile->execute(array($_SESSION['user']));
    $profile = $profile->fetch();

    $article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $article->execute(array($getid));
    $article = $article->fetch();

    $likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
    $likes->execute(array($getid));
    $likes = $likes->rowCount();

    $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
    $dislikes->execute(array($getid));
    $dislikes = $dislikes->rowCount();

    if (isset($_POST['submit_commentaire'])) {
        if (isset($_POST['pseudo'], $_POST['comment']) and !empty($_POST['pseudo']) and !empty($_POST['comment'])) {
            $pseudo = htmlspecialchars(($_POST['pseudo']));
            $commentaire = htmlspecialchars($_POST['comment']);
            if (strlen($pseudo) < 25) {

                $ins = $bdd->prepare('INSERT INTO commentaire (pseudo, commentaires, id_article) VALUES (?,?,?)');
                $ins->execute(array($pseudo, $commentaire, $getid));
                $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span><br />";
            } else {
                $c_msg = "Erreur: Le pseudo doit faire maximum 25 caractères";
            }
        } else {
            $c_msg = "Erreur: Tous les champs doivent être complétés ";
        }
    }

    // if (isset($_POST['repondre'])) {
    //     if (isset($_POST['reponse']) and !empty($_POST['reponse'])) {
    //         $commentaire_bis = htmlspecialchars($_POST['reponse']);

    //             $ins = $bdd->prepare('INSERT INTO commentaire (reponse, id_article) VALUES (?,?)');
    //             $ins->execute(array($commentaire_bis, $getid));
    //             $c_msg = "<span style='color:green'>Votre réponse a bien été postée</span><br />";
    //     } else {
    //         $c_msg = "Erreur: Tous les champs doivent être complétés ";
    //     }
    // }

    $commentaires = $bdd->prepare('SELECT * FROM commentaire WHERE id_article = ? ORDER BY id DESC');
    $commentaires->execute(array($getid));

    $com = $bdd->prepare('SELECT * FROM commentaire WHERE id = ?');
    $com->execute(array($getid));
    $com = $com->fetch();

    $likescom = $bdd->prepare('SELECT id FROM likes_com WHERE id_com = ?');
    $likescom->execute(array($getid));
    $likescom = $likescom->rowCount();

    $dislikescom = $bdd->prepare('SELECT id FROM dislikes_com WHERE id_com = ?');
    $dislikescom->execute(array($getid));
    $dislikescom = $dislikescom->rowCount();

    // PROFIL 

    // $req = $bdd->prepare('SELECT name, lastname, age, pseudo, tokenID, gender, birthday, phone, ImgProfile, ImgBanner, email, date_inscription, token FROM profiles INNER JOIN users WHERE tokenID = ? AND token = ?');
    // $req->execute(array($_SESSION['user'], $_SESSION['user']));

    // $path = "miniatures/" . $_SESSION['user'];

    // $data = $req->fetch();

    $users_id = (int) trim($_GET['id']);
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();


    if(isset($_POST['envoyer'])){
        $message = htmlspecialchars($_POST['message']);
        $insertMessage = $bdd->prepare("INSERT INTO message(message,  id_receveur, id_envoyeur)VALUES(?, ?, ?)");
        $insertMessage->execute(array($message,$users_id,$data['id']));
    }
?>

    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/homepages.css">

    <div class="colonne1">

        <div class="profil">
            <div class="photo"><image src="assets/shiba_network.png"></image></div>
            <h1>Shiba</h1>
        </div>

        <div class="notifs">
            <div class="accueil"><a href="landing.php">accueil</a><image src="assets/shiba_network.png"></image></div>
            <div class="notifications"><a href="landing.php">notifications </a><image src="assets/cloche.png"></image></div>
            <div class="profil_a"><a href="profil.php">profil </a> <image src="assets/profil.png"></image></div>
        </div>

        <div class="tools">
            <div class="autre"><image src="assets/autre.png"></div>
            <div class="help"><image src="assets/help.png"></div>
            <div class="setting"><image src="assets/setting.png"></div>
        </div>

    </div>

    <div class="bigContent">
        <div class="content">


        <div class="article">


            <form method="POST">
                <div class="imagePP">
                    <img src="miniatures/<?= $user['token'] ?>/<?= $profile['ImgProfile'] ?>">
                </div>    
                <textarea class="post_article" name="article_contenu" placeholder="Votre post..."><?php if( $mode_edition == 1) { ?><?= $edit_article['contenu'] ?><?php }?></textarea></br>
                <?php if($mode_edition == 0) { ?>
                <input type="file" class="inpImg" style="background-image: url(assets/icon_img.png); " value="ok" name="miniature"></br>
                <?php } ?>
             <a href="redaction.php"><input type="submit" value="Poster"><a/>
            </form>



            <!--<form method="POST">
                <div class="imagePP">
                    <img src="miniatures//">
                </div>    
                <textarea class="post_article" name="comment" placeholder="Votre post..."></textarea></br>
                <input type="file" class="inpImg" style="background-image: url(assets/icon_img.png); " value="ok" name="miniature">
                <a href="redaction.php"><input type="submit" value="Poster" name="submit_commentaire"><a/>
            </form>-->
        </div>

            <div class="post">
                <div class="card">
                    <h3>
                        <img class="imgPost" src="miniatures/<?= $user['token'] ?>/<?= $profile['ImgProfile'] ?>"><?= $user['pseudo']?>
                    </h3>
                    <div class="contentArticle">
                        <div class="image">
                            <img src="miniatures/<?= $getid ?>.jpg">
                        </div>
                        <div class="contenu">
                           <p> <?= $article['contenu'] ?> </p>
                        </div>
                        <div class="actions">
                            <ul>
                                <li><a href="">
                                        <p>&#128077;</p>
                                    </a>(<?= $likes ?>)</li>
                                <li><a href="">
                                        <p>&#128078;</p>
                                    </a>(<?= $dislikes ?>)</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <?php while ($c = $commentaires->fetch()) { ?>
                <div class="comment">
                    <?= $c['date_time_comment'] ?><br />
                    <b><?= $c['pseudo'] ?> :</b> <?= $c['commentaires'] ?>
                    <div class="react">
                        <a href="supprimer.php?id=<?= $c['id'] ?>"> Supprimer <?= $c['id'] ?></a><br />
                        <a href="php/action_com.php?t=1like&id=<?= $article['id'] ?>">&#128077;</a>(<?= $likescom ?>)
                        <a href="php/action_com.php?t=2dislike&id=<?= $article['id'] ?>">&#128078;</a>(<?= $dislikescom ?>)<br />
                    </div>
                    Réponse de: <b><?= $c['pseudo'] ?> :</b> <?= $c['reponse'] ?>

                    <form method="POST" class="comment_bis">
                        <textarea class="comment_bis" name="reponse" placeholder="Répondre"></textarea>
                        <a href="php/reponse.php?id=<?= $com['id'] ?>"><input type="submit" value="Poster" name="repondre"></a>
                    </form><br />

                <?php } ?>
                </div>
        </div>

    </div>
    </div>

    <div class="colonne3">

        <div class="search">
            <div class="loupe"><image src="assets/loupe.png"></div>
            <div class="barre"><input type="search" placeholder="Rechercher..."></div>
        </div>

        <div class="groupe">
            <div class="entete">
                <div class="groupelogo"><image src="assets/profil.png"></div>
                <div class="titre">GROUPE<a href="">+</a></div>
            </div>
        </div>

        <div class="messagerie">
            <div class="entetemsg">
                <div class="messagerielogo"><image src="assets/Group.png"></div>
                <div class="messagerietitre">MESSAGERIE<a href="">+</a></div>
            </div>
 
            <div class="newmessage">
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
            <div class="send">
                <textarea name="message" placeholder="Envoyer un message..."></textarea>
                <input type="submit" name="envoyer" value=">">
            </div>
        </div>

    </div>

<?php
}
?>
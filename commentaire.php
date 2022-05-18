<meta charset="utf-8" />
<link rel="stylesheet" href="style/commentaire.css">

<?php
$bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');

if (isset($_GET['id']) and !empty($_GET['id'])) {

    $getid = htmlspecialchars($_GET['id']);

    $article = $bdd->prepare('SELECT * FROM article WHERE id = ? ');
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
?>

<?php var_dump($likescom) ?>

<div class="post">
    <div class="card">
        <div class="titre">
            <h2>Post de: <?= $article['titre']?></h2>
        </div>
        <div class="image">
            <img src="miniatures/<?= $getid ?>.jpg">
        </div>
        <div class="contenu">
            <p> <?= $article['contenu'] ?> </p>
        </div>
        <div class="tools">
            <ul>

                <li><a href="php/action.php?t=1like&id=<?= $article['id'] ?>"><p>&#128153;</p></a><?= $likes ?></li>
                <li><a href="php/action.php?t=2dislike&id=<?= $article['id'] ?>"><p>&#128148;</p></a><?= $dislikes ?></li>
            </ul>
        </div>
        <a href="redaction.php?edit=<?= $article['id'] ?>">Modifier ton status pourrave =></a>
    </div>


    <?php while ($c = $commentaires->fetch()) { ?>
    <div class="comment_card">
        <?= $c['date_time_comment'] ?><br />
        <b><?= $c['pseudo'] ?> :</b> <?= $c['commentaires'] ?>
        <a href="supprimer.php?id=<?= $c['id'] ?>"> Supprimer <?= $c['id'] ?></a><br />
        <a href="php/action_com.php?t=1like&id=<?= $article['id'] ?>">&#128077;</a>(<?= $likescom ?>)
        <a href="php/action_com.php?t=2dislike&id=<?= $article['id'] ?>">&#128078;</a>(<?= $dislikescom ?>)<br />
        Réponse de: <b><?= $c['pseudo'] ?> :</b> <?= $c['reponse'] ?>

        <form method="POST" class="comment_bis">
            <textarea class="comment_bis" name="reponse" placeholder="Répondre"></textarea>
            <a href="php/reponse.php?id=<?= $com['id'] ?>"><input type="submit" value="Poster" name="repondre"></a>
        </form>

        <br />
     </div>


    </div>

            <?php } ?>

    <form method="POST">
        <input type="text" name="pseudo" placeholder="pseudo"></br>
        <textarea name="comment" placeholder="Votre commentaire..."></textarea></br>
        <input type="submit" value="Poster mon commentaire" name="submit_commentaire">
    </form>

    <?php if (isset($c_msg)) {
        echo $c_msg;
    } ?>


<?php
}
?> 
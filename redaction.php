<?php
$engine = "mysql";

// IP
$host = "localhost";
$port = 8889;
$dbName = "shiba_db";
$username = "root";
$passeword = "root";
$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);

$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $edit_article->execute(array($edit_id));

    if($edit_article->rowCount() == 1) {
        $edit_article = $edit_article->fetch();
    } else {
        die('Erreur : l\'article concerné n\'existe pas...');
    }
}

if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
    if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {

        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);

        if($mode_edition == 0) {
            $ins = $bdd->prepare('INSERT INTO article (titre, contenu,
                date_time_publication)VALUES (?, ?, NOW())');
            $ins->execute(array($article_titre, $article_contenu));
            header('Location: http://localhost:8888/index.php ');
        } else {
            $update = $bdd->prepare('UPDATE article SET titre = ?, contenu = ?,
                date_time_edition = NOW() WHERE id = ?');
            $update->execute(array($article_titre,$article_contenu,$edit_id));
            header('Location: http://localhost:8888/article.php?id='.$edit_id);
            $message = 'Votre article a bien été mis à jour !';
        }

    }else{
        $message = 'Veuillez remplir tous les champs';
    }
}    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Publication / Edition</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="article_titre" placeholder="titre" <?php if( 
            $mode_edition) { ?> value="
            <?= $edit_article['titre'] ?>"<?php } ?>></br>
        <textarea name="article_contenu" placeholder="contenu de l'article"><?php if( 
            $mode_edition) { ?><?= 
            $edit_article['contenu'] ?><?php }?></textarea></br>
        <input type="submit" value="Envoyer l'article">
    </form>
    </br>
    <?php if(isset($message)) { echo($message); } ?>
</body>
</html>

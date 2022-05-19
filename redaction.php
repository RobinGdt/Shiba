<?php
$engine = "mysql";

// IP
$host = "localhost";
$port = 8889;
$dbName = "shiba_db";
$username = "root";
$passeword = "root";
$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);

session_start();

$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;
    $edit_id = htmlspecialchars($_GET['edit']);
    // $token = $bdd->prepare('INSERT INTO article (token) SELECT token FROM users');
    $edit_article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $edit_article->execute(array($edit_id));

    if($edit_article->rowCount() == 1) {
        $edit_article = $edit_article->fetch();
    } else {
        die('Erreur : l\'article concerné n\'existe pas...');
    }
}

if(isset($_POST['article_contenu'])) {
    if(!empty($_POST['article_contenu'])) {

        $article_contenu = htmlspecialchars($_POST['article_contenu']);

        if($mode_edition == 0) {

            $ins = $bdd->prepare('INSERT INTO article (token, contenu,
                date_time_publication)VALUES (?, ?, NOW())');
            $ins->execute(array($_SESSION['user'], $article_contenu));
            $lastid = $bdd->lastInsertId();
            header('Location: http://localhost:8888/homepage.php?id='.$lastid);
            


            if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                    $chemin = 'miniatures_articles/'.$lastid.'.jpg';
                    move_uploaded_file($_FILES['miniature']['tmp_name'],$chemin);
                } else {
                    $message = 'votre image doit être au format jpg.';
                }
            }    

        } else {
            $update = $bdd->prepare('UPDATE article SET token = ?, titre = ?, contenu = ?,
                date_time_edition = NOW() WHERE id = ?');
            $update->execute(array($_SESSION['user'],$article_contenu,$edit_id));
            header('Location: http://localhost:8888/homepage.php?id='.$edit_id);
            $message = 'Votre article a bien été mis à jour !';
        }

    }else{
        $message = 'Veuillez remplir tous les champs';
    }
}    
var_dump($_POST);
var_dump($_FILES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Publication / Edition</title>
</head>
<body>


            <form action="" method="post" enctype="multipart/form-data">
                <div class="imagePP">
                    <img src="miniatures/<?= $user['token'] ?>/<?= $profile['ImgProfile'] ?>">
                </div>    
                <textarea class="post_article" name="article_contenu" placeholder="Votre post..."><?php if( 
                $mode_edition == 1) { ?><?= 
                $edit_article['contenu'] ?><?php }?></textarea></br>
                <?php if($mode_edition == 0) { ?>
                <input type="file" class="inpImg" style="background-image: url(assets/icon_img.png); " value="ok" name="miniature"></br>
                <?php } ?>
             <input type="submit" value="Poster" name="submit_commentaire">
            </form>

            

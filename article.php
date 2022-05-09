<?php
$engine = "mysql";

// IP
$host = "localhost";

$port = 8889;

$dbName = "shiba_db";

$username = "root";

$passeword = "root";

$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);


if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    $article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $article->execute(array($get_id));
    // Verifie si l'article existe bien bien
    if($article->rowCount() == 1 ) {
        $article = $article->fetch();
        $titre = $article['titre'];
        $contenu = $article['contenu'];
    } else {
        die('Cet article n\existe pas');
    }

}else {
    die('Erreur');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="article.css">
    <title>Accueil</title>
</head>
<body>
    <div class="box">
        <h1><?= $titre ?> </h1>
        <p><?= $contenu ?></p>
    </div>
    <a href="index.php">Accueil -></a>

</body>
</html>
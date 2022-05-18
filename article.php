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
        $id = $article['id'];
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
    <link rel="stylesheet" href="articles.css">
    <title>Accueil</title>
</head>
<body>
    <div class="box">
        <img class="mini" src="miniatures/<?= $id ?>.jpg">
        <h1><?= $titre ?> </h1>
        <p><?= $contenu ?></p>
    </div>
    <a href="redaction.php?edit=<?= $a['id'] ?>"> | Modifier</a>
    <a href="supprimer.php?id=<?= $a['id'] ?>"> | Supprimer</a>
    <a href="index.php"> | Accueil -></a>

</body>
</html>
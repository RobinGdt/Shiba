<?php

$engine = "mysql";

// IP
$host = "localhost";

$port = 8889;

$dbName = "shiba_db";

$username = "root";

$passeword = "root";

$bdd = new PDO("$engine:host=$host:$port;dbname=$dbName",$username, $passeword);


$article = $bdd->query('SELECT * FROM article ORDER BY date_time_publication DESC');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Test1/Social_Network_HETIC/Shiba/article.css">
    <link rel="stylesheet" href="Test1/Social_Network_HETIC/Shiba/article.css">
    <title>Accueil</title>
</head>
<body>
    
    <ul>
        <?php while( $a = $article->fetch()) { ?>
        <li>
            <a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a>
            <a href="redaction.php?edit=<?= $a['id'] ?>"> | Modifier</a>
            <a href="supprimer.php?id=<?= $a['id'] ?>"> | Supprimer</a>
        </li>
        <?php } ?>
    </ul>

</body>
</html>

<?php
    // session_start();
    // $bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');          // ajout connexion bdd 


    // // On récupere les données de l'utilisateur
    // $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    // $req->execute(array($_SESSION['user']));
    // $data = $req->fetch();
    

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Encode+Sans:wght@100&family=Jost:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/landings.css">
        <title>Bonjour !</title>
    </head>
    <body>
        <div class="c1">
            <div class="contentShiba">
                <img src="assets/Shiba_Landing.png" alt="">
            </div>
        </div>
        
        <div class="c2">
            <div class="contentCo">
                <div class="photo">
                    <image src="assets/shiba_network.png"><h1>Shiba</h1></image>
                </div>
                <p>Rejoignez la meute !</p>

                <div class="connexion">
                    <a href="connexion.php">Connexion</a>
                </div>
                        - ou -
                <div class="inscription">
                    <a href="inscription.php">s'inscrire</a>
                </div>

            </div>
        
        </div>

    </body>
</html>
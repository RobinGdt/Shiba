<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Encode+Sans:wght@100&family=Jost:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
    <title>Connexion</title>
</head>

<body>

    <div class="c1">
        <div class="contentShiba">
            <img src="assets/Shiba_Landing.png" alt="">
        </div>
    </div>

    <div class="c2">
        <div class="contentCo">
            <h2>Shiba - connexion</h2>
            <div class="login-form">
                <?php                               //Messages d'erreur
                if (isset($_GET['login_err'])) {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch ($err) {
                        case 'password':
                ?>
                            <div class="alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                            break;

                        case 'email':
                        ?>
                            <div class="alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                            break;

                        case 'already':
                        ?>
                            <div class="alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                <?php
                            break;
                    }
                }
                ?>
                <form action="connexion.php" method="post">
                    <input type="text" name="email" placeholder="Email" required="required" autocomplete="off">
                    <input type="password" name="password" placeholder="Mot de passe" required="required" autocomplete="off">
                    <button type="submit">Connexion</button>
                </form>
            </div>
        </div>
        <div class="endpage">
            <p>Pas de compte ? </p><a href="inscription.php" class="inscp">inscrivez-vous</a>
        </div>
    </div>
    <script src="main.js"></script>

</html>
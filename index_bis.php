
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
<div class="login-form">
    <?php                               //Messages d'erreur
        if(isset($_GET['login_err']))
        {
            $err = htmlspecialchars($_GET['login_err']);

            switch($err)
            {
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
        <h2>Connexion</h2>   
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Connexion</button>
        </div>
    </form>
    <p><a href="inscription.php">Inscription</a></p>
</div>
<script src="main.js"></script>   
</html>
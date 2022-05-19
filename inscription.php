
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/inscription.css">
    <title>Inscription</title>
</head>
<body>
<div class="login-form">
    <?php
        if(isset($_GET['reg_err']))
        {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err)
            {
                case 'success':
                ?>
                    <div class="alert-success">
                        <strong>Succès</strong> Inscription réussie !
                        <p><a href="index.php">Retour à la connexion</a></p>
                    </div>
                <?php
                break;

                case 'password':
                ?>
                    <div class="alert-danger">
                        <strong>Erreur</strong> mot de passe différent !
                    </div>
                <?php
                break;

                case 'email':
                ?>
                        <div class="alert-danger">
                            <strong>Erreur</strong> email non valide
                        </div>
                <?php
                break;

                 case 'email_length':
                ?>
                        <div class="alert-danger">
                            <strong>Erreur</strong> email trop long
                        </div>
                <?php
                break;

                 case 'pseudo_length':
                ?>
                        <div class="alert-danger">
                            <strong>Erreur</strong> pseudo trop long
                        </div>
                <?php
                break;

                 case 'already':
                ?>
                        <div class="alert-danger">
                            <strong>Erreur</strong> compte déjà existant
                        </div>
                <?php
                break;
            }
        }
    ?>
    <form action="inscription_traitement.php" method="post">
        <h2>Inscription</h2>
        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Inscription</button>
        </div>
    </form>
</div>

</body>
<script src="main.js"></script>   
</html>
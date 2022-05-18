
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Encode+Sans:wght@100&family=Jost:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/inscription.css">
    <title>Inscription</title>
</head>
<body>

    <div class="c1">
        <div class="contentShiba">
            <img src="assets/Shiba_Landing.png" alt="">
        </div>
    </div>


    <div class="c2">
        <div class="contentCo">
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
    <h2>Pour créer son compte, c'est ici :</h2>
    <form action="inscription_traitement.php" method="post">

            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">


            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">


            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">


            <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">

            <div class="btn">
                <button type="submit" class="btn">Inscription</button>
            </div>

    </form>
    </div>
    </div>
</body>
<script src="main.js"></script>   
</html>
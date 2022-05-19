
<?php
    session_start();                        // Démarrage de la session
    require_once 'config.php';              // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['password']))     //On verifie si les données des inputs email et password existent
    {
        $email = htmlspecialchars($_POST['email']);            //Stocker les Posts dans des htmlspecialcards pour éviter la faille xss
        $password = htmlspecialchars($_POST['password']); 
        
        $email = strtolower($email); // email transformé en minuscule

        $check = $bdd->prepare('SELECT pseudo, email, password, token FROM users WHERE email = ?');      //On vérifie que la personne est bien inscrite sur notre base
        $check->execute(array($email));
        $data = $check->fetch();            //On stock les données dans data
        $row = $check->rowCount();         //On vérifie si il existe dans la table ou pas avec row

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['token'];
                    header('Location: landing.php');
                    die();
                }else{ header('Location: index_bis.php?login_err=password'); die(); }

            }else{ header('Location: index_bis.php?login_err=email'); die(); }

        }else{ header('Location: index_bis.php?login_err=already'); die(); }
        
    }else{ header('Location: index_bis.php'); die();} // si le formulaire est envoyé sans aucune données

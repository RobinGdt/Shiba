
<?php
    
    $bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');;      // On inclu la connexion à la bdd
    

    //On vérifie que toutes les variables POST existent
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))  
    {
        
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        //On vérifie que la personne est bien inscrite sur notre base
        $check = $bdd->prepare('SELECT pseudo, email, password FROM users WHERE email = ?');      
        $check->execute(array($email));
        $data = $check->fetch();            //On stock les données dans data
        $row = $check->rowCount();         //On vérifie si il existe dans la table ou pas avec row

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents 

        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0)       //4 Verification que :       1/Pseudo à -200 caractères   2/Email est bien un email     3/Les 2 passwords sont égaux entre eux
        {   
            
            if(strlen($pseudo) <= 100)
            {
                if(strlen($email) <= 100)
                {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        if($password === $password_retype)
                        {   
                            
                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                            $ip = $_SERVER['REMOTE_ADDR']; 
                            $token = bin2hex(openssl_random_pseudo_bytes(64));
                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO users(pseudo, email, password, token) VALUES(:pseudo, :email, :password, :token)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'token' => $token
                            ));

                            $insertProfile = $bdd->prepare('INSERT INTO profiles(tokenID) VALUES (:token)');
                            $insertProfile->execute(array(
                                'token' => $token
                            ));

                            // On redirige avec le message de succès
                            header('Location:inscription.php?reg_err=success');
                            die();

                        }else{ header('Location: inscription.php?reg_err=password'); die();}

                    }else{ header('Location: inscription.php?reg_err=email'); die();}

                }else{ header('Location: inscription.php?reg_err=email_length'); die();}

            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}

        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
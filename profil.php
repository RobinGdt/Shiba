<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');


    $req = $bdd->prepare('SELECT name, lastname, age, pseudo, tokenID, gender, birthday, phone, ImgProfile, ImgBanner, email, date_inscription, token FROM profiles INNER JOIN users WHERE tokenID = ? AND token = ?');
    $req->execute(array($_SESSION['user'], $_SESSION['user']));

    $data = $req->fetch();

    // variables téléchargement image profil & bannière
    $Maxsize = 6291456;
    $ExtensionImg = array('image/png', 'image/jpeg', 'image/gif', 'image/png');
    $path = "miniatures/" . $_SESSION['user'];

    if (isset($_FILES['image_user']) AND !empty($_FILES['image_user']['name'])) {

        if($_FILES['image_user']['size'] < $Maxsize) {

            if(in_array($_FILES['image_user']['type'], $ExtensionImg)) {
                
                

                if(!is_dir($path)) {
                    mkdir($path);
                };

                $name = $_FILES['image_user']['name'];

                $DLimg = move_uploaded_file($_FILES['image_user']['tmp_name'], "$path/$name");

                if($DLimg) {
                    $sqlImg = $bdd->prepare('UPDATE profiles set ImgProfile = :img WHERE tokenID = :token');
                    $sqlImg->execute(array(
                       "img" => $name,
                        "token" => $_SESSION['user']
                    ));
                }

            } else {
                $msg = "Votre photo doit être en format : PNG, JPG, JPEG ou GIF.";
            };

        } else {
            $msg = "Votre image de profil doit être inférieur à 6Mo.";
        };
    };

    if (isset($_FILES['image_banner']) AND !empty($_FILES['image_banner']['name'])) {
        if($_FILES['image_banner']['size'] < $Maxsize) {

            if(in_array($_FILES['image_banner']['type'], $ExtensionImg)) {

                if(!is_dir($path)) {
                    mkdir($path);
                };

                $name = $_FILES['image_banner']['name'];

                $DLimg = move_uploaded_file($_FILES['image_banner']['tmp_name'], "$path/$name");

                if($DLimg) {
                    $sqlImg = $bdd->prepare('UPDATE profiles set ImgBanner = :img WHERE tokenID = :token');
                    $sqlImg->execute(array(
                       "img" => $name,
                        "token" => $_SESSION['user']
                    ));
                }

            } else {
                $msg = "Votre image de bannière doit être en format : PNG, JPG, JPEG, ou GIF.";
            }

        } else {
            $msg = "Votre image de bannière doit être inférieur à 6Mo.";
        }
    }
    

    if (isset($_POST["ChangeProfile"])) {

        $name = $_POST['name_user'];
        $lastname = $_POST['lastname_user'];
        $age = $_POST['age_user'];
        $gender = $_POST['gender_user'];
        $birthday = $_POST['birthday_user'];
        $phone = $_POST['tel_user'];

    
        $sqlUpdate = $bdd->prepare('UPDATE profiles SET name = :name, lastname = :lastname, age = :age, gender = :gender, birthday = :birthday, phone = :phone WHERE tokenID = :token');
        $sqlUpdate->execute((array(
            "name" => $name,
            "lastname" => $lastname,
            "age" => $age,
            "token" => $_SESSION['user'],
            "gender" => $gender,
            "birthday" => $birthday,
            "phone" => $phone
        )));
        header('Location: homepage.php?id=8');
    };

    if (isset($_POST['DeleteAccount'])) {
        $sqlDelete = $bdd->prepare('DELETE FROM users WHERE token = ?');
        $sqlDelete->execute(array(
            $_SESSION['user']
        ));
        header('Location: index_bis.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?php echo $data['pseudo'] ?></title>
</head>
<body>
<h1>Profil de <?php echo $data['pseudo'] ?> :</h1>
<img src="<?php $token = $_SESSION['user']; $img = $data['ImgProfile']; if(isset($img)): echo "users/$token/$img"  ?> <?php else: echo "miniatures/photo-avatar-profil.png" ?> <?php endif; ?>" height="200">
<img src="<?php $token = $_SESSION['user']; $img = $data['ImgBanner']; if(isset($img)): echo "users/$token/$img"  ?> <?php else: echo "miniatures/Bannière-blanche.jpg" ?> <?php endif; ?>" width="800", height="200">
    <form action="" method="post" enctype="multipart/form-data">
        <p>Image de profil : <input type="file" name="image_user"></p>        
        <p>Image de la bannière : <input type="file" name="image_banner"></p>        
        <p>Mail : <input type="email" name="email_user" value="<?php echo $data['email'] ?>"></p>
        <p>Prénom : <input type="text" name="name_user" value="<?php echo $data['name'] ?>"></p>
        <p>Nom : <input type="text" name="lastname_user" value="<?php echo $data['lastname'] ?>"></p>
        <div>
        <p>Genre : </p>
        <input type="radio" name="gender_user" id="homme" value="homme">
        <label for="homme">Homme</label>
        <input type="radio" name="gender_user" id ="femme" value="femme">
        <label for="femme">Femme</label>
        <input type="radio" name="gender_user" id="autre" value="autre">
        <label for="autre">Autre</label>
        </div>
        <p>Age : <input type="number" name="age_user" value="<?php echo $data['age'] ?>"></p>
        <p>Numéro de téléphone : <input type="tel" name="tel_user" value="<?php echo $data['phone'] ?>"></p>
        <p>Anniversaire : <input type="date" name="birthday_user" value="<?php echo $data['birthday'] ?>"></p>
        <p>tokenID : <?php echo $data['tokenID'] ?></p>
        <input type="submit" name="ChangeProfile" value="Mettre à jour mon profil !">
    </form>
    <p>Date de création : <?php echo $data['date_inscription'] ?></p>
    <form action="" method="post">
        <input type="submit" value="Supprimer son compte", name="DeleteAccount">
    </form>
    
    <p><a href="landing.php">Retour</a></p>
    <?php var_dump($_SESSION['user']) ?>
</body>
</html>
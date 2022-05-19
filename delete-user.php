<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


if($id) {

    require_once 'config.php'; 
    $maRequete = $bdd->prepare("DELETE FROM users WHERE id = :id");

    $maRequete->execute([
        ":id" => $id

    ]);
    
    http_response_code(302); 
    header('Location: preview-user.php');
    echo "l'utilisateur à été supprimé";
    exit();

}

?>
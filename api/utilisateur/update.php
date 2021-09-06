<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../modal/utilisateur.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Utilisateur($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_utilisateur = $data->id_utilisateur;
    
    // employee values
    $item->role = $data->role;
    $item->username = $data->username;
    $item->password = $data->password;
    
    
    if($item->updateUtilisateur()){
        echo json_encode("data data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
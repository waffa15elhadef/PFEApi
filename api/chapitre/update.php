<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../modal/chapitre.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Chapitre($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_chapitre = $data->id_chapitre;
    
    // employee values
    $item->nom = $data->nom;
    $item->id_module = $data->id_module;
    
    
    
    if($item->updateChapitre()){
        echo json_encode("Employee data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
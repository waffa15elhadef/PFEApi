<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../modal/specialite.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Affectation($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_module = $data->id_module;
    $item->id_enseignant = $data->id_enseignant;
    
    // employee values
   
    
    if($item->updateAffectation()){
        echo json_encode("Employee data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
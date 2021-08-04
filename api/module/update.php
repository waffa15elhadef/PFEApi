<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../modal/module.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Module($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_module = $data->id_module;
    
    // employee values
    $item->id_specialite = $data->id_specialite;
    $item->nom = $data->nom;
    $item->semestre = $data->semestre;
    $item->coefficient = $data->coefficient;
    $item->credit= $data->credit;
    
    
    if($item->updatemodule()){
        echo json_encode("Employee data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
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
    
    $item = new Specialite($db);
    $item->id_specialite = isset($_GET['id']) ? $_GET['id'] : die();

      
    if($item->deleteSpecialite()){
        echo json_encode("Employee deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>
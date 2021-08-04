<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../modal/module.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Module($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nom= $data->nom;
    $item->id_specialite = $data->id_specialite;
    
    $item->semestre= $data->semestre;
    $item->coefficient = $data->coefficient;
    $item->credit = $data->credit;
    
    

    // echo $data->nom;
    // echo $data->id_specialite;
    // echo $data->semestre;
    // echo $data->coefficient;
    // echo $data->credit;
    
    if($item->createModule()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>
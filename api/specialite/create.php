<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../modal/specialite.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Specialite($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nom = $data->nom;
    $item->filiere = $data->filiere;
    $item->code = $data->code;
    
   
    
    
    if($item->createEnseignant()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>
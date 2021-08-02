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

    $item->id_specialite = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getById();

    if($item->nom != null){
        // create array
        $e = array(
            "id_specialite" => $item->id_specialite,
            "nom" => $item->nom,
            "filiere" => $item->filiere,
            "code" => $item->code
           
        );
        http_response_code(200);
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>
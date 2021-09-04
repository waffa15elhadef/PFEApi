<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../modal/chapitre.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Chapitre($db);

    $item->id_chapitre = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getById();

    if($item->nom != null){
        // create array
        $e = array(
            "id_chapitre" => $item->id_chapitre,
            "nom" => $item->nom,
            "id_module" => $item->id_module
           
        );
        http_response_code(200);
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>
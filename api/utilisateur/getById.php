<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
     include_once '../../modal/utilisateur.php';

    
    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $item->id_utilisateur = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getById();

    if($item->id_utilisateur != null){
        // create array
        $emp_arr = array(
            "nom_d_utilisateur" =>  $item->nom_d_utilisateur,
            "mot_de_passe" => $item->mot_de_passe,
        "id_utilisateur"=>$item->id_utilisateur
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("data not found.");
    }
?>
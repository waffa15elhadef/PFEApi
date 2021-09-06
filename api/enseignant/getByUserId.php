<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../modal/enseignant.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Enseignant($db);

    $item->id_utilisateur = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getByUserId();

    if($item->nom != null){
        // create array
        $emp_arr = array(
            "id_enseignant" =>  $item->id_enseignant,
            "nom" => $item->nom,
            "email" => $item->email,
            "prenom" => $item->prenom,
            "date_naissance" => $item->date_naissance,
            "lieu_naissance" => $item->lieu_naissance,
           "id_utilisateur"=>$item->id_utilisateur,
            "telephone" => $item->telephone,
            "matricule" => $item->matricule
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("data not found.");
    }
?>
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../modal/affectation.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Affectation($db);

    $item->id_enseignant = isset($_GET['id']) ? $_GET['id'] : die();

    $stmt = $item->getByIdEnseignant();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $affectation = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_enseignant" => $id_enseignant,
               "id_module" => $id_module
            );

            array_push($affectation, $e);
        }
        echo json_encode($affectation);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
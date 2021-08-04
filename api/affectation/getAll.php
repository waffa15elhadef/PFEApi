<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/affectation.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Affectation($db);


    $stmt = $item->getAffectation();
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
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/specialite.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new specialite($db);


    $stmt = $item->getSpecialites();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $specialites = array();
        $specialites = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_specialite" => $id_specialite,
                "nom" => $nom,
                "filiere" => $filiere,
                "code" => $code
               
            );

            array_push($specialites, $e);
        }
        echo json_encode($specialites);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
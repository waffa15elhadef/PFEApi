<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/chapitre.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new chapitre($db);


    $stmt = $item->getChapitres();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $chapitres = array();
        $chapitres = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_chapitre" => $id_chapitre,
                "id_module" => $id_module,
                "nom" => $nom
            );

            array_push($chapitres, $e);
        }
        echo json_encode($chapitres);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
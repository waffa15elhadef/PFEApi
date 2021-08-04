<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/module.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Module($db);


    $stmt = $item->getModules();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $modules = array();
        $modules = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_module" => $id_module,
                "id_specialite" => $id_specialite,
                "nom" => $nom,
                "semestre" => $semestre,
                "coefficient" => $coefficient,
                "credit" => $credit
                
            );

            array_push($modules, $e);
        }
        echo json_encode($modules);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
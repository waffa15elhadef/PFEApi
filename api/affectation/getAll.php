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
        $affectations=array();
        $affectation["module"]=array();
        $affectation["enseignant"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $affectation=array();
            $enseignant = array(
                "id_enseignant" => $id_enseignant,
                "nom" => $id_enseignant,
                "prenom" => $id_enseignant
              
            );
            $module=array(
                "id_module" => $id_module,
                "intitule"=>$intitule,
                "credit"=>$credit,
                "semestre"=>$semestre,
                "coefficient"=>$coefficient,                
            );
    
            array_push($affectation, $module);
            array_push($affectation, $enseignant);
            array_push($affectations, $affectation);

        }
        echo json_encode($affectations);

    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
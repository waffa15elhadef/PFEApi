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
        $modules=array();
        $affectation["modules"]=array();
        $affectation["enseignant"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $enseignant = array(
                "id_enseignant" => $id_enseignant,
                "nom"=>$nom,
               "prenom"=>$prenom
            );
            $affectation["enseignant"]=$enseignant;
            
            $module=array(
                "id_module" => $id_module,
                "intitule"=>$intitule,
                "credit"=>$credit,
                "semestre"=>$semestre,
                "coefficient"=>$coefficient,
            );
            array_push($affectation["modules"],$module);
           
            // array_push($affectation["enseignant"], $modules);
        }

        array_push($affectation["enseignant"], $enseignant);
        echo json_encode($affectation);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
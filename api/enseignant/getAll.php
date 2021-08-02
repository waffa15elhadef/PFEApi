<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/enseignant.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Enseignant($db);


    $stmt = $item->getEnseignants();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $enseignants = array();
        $enseignants = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_enseignant" => $id_enseignant,
                "nom" => $nom,
                "email" => $email,
                "prenom" => $prenom,
                "date_naissance" => $date_naissance,
                "lieu_naissance" => $lieu_naissance,
                "telephone" => $telephone,
                "matricule" => $matricule,
                "username" => $username,
                "mot_de_passe" => $mot_de_passe
            );

            array_push($enseignants, $e);
        }
        echo json_encode($enseignants);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
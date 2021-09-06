<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../modal/utilisateur.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new utilisateur($db);


    $stmt = $item->getUtilisateurs();
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $utilisateurs = array();
        $utilisateurs = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_utilisateur" => $id_utilisateur,
                "nom_d_utilisateur" => $nom_d_utilisateur,
                "mot_de_passe" => $mot_de_passe,
                "role" => $role
            );

            array_push($utilisateurs, $e);
        }
        echo json_encode($utilisateurs);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
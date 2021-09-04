<?php
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 8400");
 header("Access-Control-Allow-Headers: Origin, Content-Type,Accept, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../modal/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->username= $data->username;
    $item->password= $data->password;
$item->login();
    if($item->username != null){ 
        // create array 
        $e = array(
        
            "id_utilisateur" => $item->id_utilisateur,
            "username" => $item->username,
            "password" => $item->password,
            "role" => $item->role
        );
        http_response_code(200);
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
    
?>
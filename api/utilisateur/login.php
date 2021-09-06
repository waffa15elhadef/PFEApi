<?php

header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");    
header("Access-Control-Allow-Methods: POST");    
header("Access-Control-Max-Age: 3600");    
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");  include_once '../../config/database.php';
   

if ($_SERVER['REQUEST_METHOD'] != 'POST') {    
    return 0;    
 }  
else {
  header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");    
header("Access-Control-Allow-Methods: POST");    
header("Access-Control-Max-Age: 3600");    
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");  include_once '../../config/database.php';
      
include_once '../../modal/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nom_d_utilisateur= $data->nom_d_utilisateur;
    $item->mot_de_passe= $data->mot_de_passe;
$item->login();
    if($item->nom_d_utilisateur != null){ 
        // create array 
        $e = array(
        
            "id_utilisateur" => $item->id_utilisateur,
            "nom_d_utilisateur" => $item->nom_d_utilisateur,
            "mot_de_passe" => $item->mot_de_passe,
            "role" => $item->role
        );
        http_response_code(200);
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("data not found.");
    }
  
}  
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] != 'POST') {    
    return 0;    
 }  
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    
    include_once '../../config/database.php';
    include_once '../../modal/enseignant.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Enseignant($db);

    $data = json_decode(file_get_contents("php://input"));
    $item->nom = $data->nom;
    $item->prenom = $data->prenom;
    $item->matricule = $data->matricule;
    
    $item->email = $data->email;
    $item->date_naissance = $data->date_naissance;
    $item->lieu_naissance = $data->lieu_naissance;
    $item->id_utilisateur = $data->id_utilisateur;
    
    $item->telephone = $data->telephone;
    
    
    if($item->createEnseignant()){
        echo json_encode("data Created.");
    } else{
        echo json_encode("data not Created.");
    }
?>
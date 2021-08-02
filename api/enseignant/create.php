<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

    $item->telephone = $data->telephone;
    $item->username = $data->username;
    $item->mot_de_passe = $data->mot_de_passe;
    
    
    if($item->createEnseignant()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>
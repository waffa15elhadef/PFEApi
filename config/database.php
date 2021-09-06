<?php 
    class Database {
        private $host = "127.0.0.1";
        private $database_name = "bd_departement";
        private $nom_d_utilisateur = "root";
        private $mot_de_passe = "";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->nom_d_utilisateur, $this->mot_de_passe);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
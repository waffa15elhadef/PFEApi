<?php
    class Specialite{

        // Connection
        private $conn;

        // Table
        private $db_table = "Specialite";

        // Columns
        public $id_specialite;
        public $nom;
        public $code;
        public $filiere;

      

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getSpecialites(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createSpecialite(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            nom = :nom,
            filiere = :filiere,
           
            code = :code
            ";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->code=htmlspecialchars(strip_tags($this->code));
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":code", $this->code);
            $stmt->bindParam(":filiere", $this->filiere);
         
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getById(){
            $sqlQuery = "SELECT * FROM
                        ". $this->db_table ."
                    WHERE 
                    id_specialite = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_specialite);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nom = $dataRow['nom'];
            $this->code = $dataRow['code'];
            $this->filiere = $dataRow['filiere'];
          
            
        }        

        // UPDATE
        public function updateSpecialite(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    nom = :nom,
                    code = :code,
                    filiere = :filiere
                      
                    WHERE 
                    id_specialite = :id_specialite";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->code=htmlspecialchars(strip_tags($this->code));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":filiere", $this->filiere);
            $stmt->bindParam(":code", $this->code);
            $stmt->bindParam(":id_specialite", $this->id_specialite);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteSpecialite(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_specialite = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
        
            $stmt->bindParam(1, $this->id_specialite);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        

    }
?>
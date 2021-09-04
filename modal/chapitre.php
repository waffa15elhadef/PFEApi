<?php
    class Chapitre{

        // Connection
        private $conn;

        // Table
        private $db_table = "Chapitre";

        // Columns
        public $id_chapitre;
        public $id_module;
        public $nom;
       

      

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getChapitres(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createChapitre(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            id_module = :id_module,
            nom = :nom
       
            ";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
            $this->nom=htmlspecialchars(strip_tags($this->nom));
         
            // bind data
            $stmt->bindParam(":id_module", $this->id_module);
            $stmt->bindParam(":nom", $this->nom);
      
         
            
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
                    id_chapitre = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_chapitre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_module = $dataRow[ 'id_module'];
            $this->nom = $dataRow['nom'];
            
          
            
        }        

        // UPDATE
        public function updateChapitre(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    id_module = :id_module,
                    nom = :nom
                    
                      
                    WHERE 
                    id_chapitre = :id_chapitre";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
         
            $this->id_chapitre=htmlspecialchars(strip_tags($this->id_chapitre));
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
            $this->nom=htmlspecialchars(strip_tags($this->nom));
           
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":id_module", $this->id_module);         
            $stmt->bindParam(":id_chapitre", $this->id_chapitre);         
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteChapitre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_chapitre = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_chapitre=htmlspecialchars(strip_tags($this->id_chapitre));
        
            $stmt->bindParam(1, $this->id_chapitre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        

    }
?>
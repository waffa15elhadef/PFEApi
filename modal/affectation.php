<?php
    class Affectation{

        // Connection
        private $conn;

        // Table
        private $db_table = "Affectation";

        // Columns
       
        public $id_enseignant;
        public $id_module;
       

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAffectation(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " affectation, enseignant enseignant, module module where affectation.id_enseignant=enseignant.id_enseignant and affectation.id_module=module.id_module order by affectation.id_enseignant";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createAffectation(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            id_enseignant = :id_enseignant,
            id_module = :id_module
            ";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
            $this->id_enseignant=htmlspecialchars(strip_tags($this->id_enseignant));
           
         
            // bind data
            $stmt->bindParam(":id_enseignant", $this->id_enseignant);
            $stmt->bindParam(":id_module", $this->id_module);
           
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getByIdEnseignant(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ." affectation, module module, enseignant enseignant "
            ."WHERE affectation.id_enseignant=enseignant.id_enseignant and module.id_module = affectation.id_module and ".
                    "affectation.id_enseignant = :id_enseignant
                    ";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam("id_enseignant", $this->id_enseignant);
            $stmt->execute();

           return $stmt;
   
        }        

        public function getByIdModule(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ." affectation, module module, enseignant enseignant "
            ."WHERE affectation.id_enseignant=enseignant.id_enseignant and module.id_module = affectation.id_module and ".
                    "affectation.id_module = :id_module
                    ";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":id_module", $this->id_module);
            $stmt->execute();
            return $stmt;    
        }  
        // UPDATE
        public function updateAffectation(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                      id_enseignant = :id_enseignant,
                    id_module = :id_module 
                    WHERE 
                    id_enseignant = :id_enseignant,
                    id_module = :id_module";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
            $this->id_enseignant=htmlspecialchars(strip_tags($this->id_enseignant));
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
           
         
            // bind data
            $stmt->bindParam(":id_module", $this->id_module);
             $stmt->bindParam(":id_enseignant", $this->id_enseignant);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteAffectation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_enseignant = :id_enseignant and id_module= :id_module";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_enseignant=htmlspecialchars(strip_tags($this->id_enseignant));
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
            $stmt->bindParam(":id_enseignant", $this->id_enseignant);
            $stmt->bindParam(":id_module", $this->id_module);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
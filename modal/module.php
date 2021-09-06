<?php
    include_once '../../modal/specialite.php';

    class module{

        // Connection
        private $conn;

        // Table
        private $db_table = "module";

        // Columns
        public $id_module;
        public $id_specialite;
        public $intitule;
        public $semestre;
        public $coefficient;
        public $credit;
       public $specialite;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
            $this->specialite=new Specialite($db);
        }

        // GET ALL
        public function getModules(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createModule(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            intitule = :intitule,
            semestre = :semestre,
            id_specialite = :id_specialite,
            coefficient = :coefficient ,
            credit = :credit
            ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->intitule=htmlspecialchars(strip_tags($this->intitule));
            $this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
            
            $this->semestre=htmlspecialchars(strip_tags($this->semestre));
            $this->coefficient=htmlspecialchars(strip_tags($this->coefficient));
            $this->credit=htmlspecialchars(strip_tags($this->credit));
            
            // bind data
            $stmt->bindParam(":intitule", $this->intitule);
            $stmt->bindParam(":id_specialite", $this->id_specialite);
            $stmt->bindParam(":semestre", $this->semestre);
            $stmt->bindParam(":coefficient", $this->coefficient);
            $stmt->bindParam(":credit", $this->credit);
 
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getById(){
            $sqlQuery = "SELECT * FROM 
                        ". $this->db_table ." as module, specialite as specialite

                    WHERE 
                    id_module = ?
                    and module.id_specialite=specialite.id_specialite
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_module);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->credit = $dataRow['credit'];
            $this->semestre = $dataRow['semestre'];
            $this->coefficient = $dataRow['coefficient'];
            $this->intitule = $dataRow['intitule'];
            $this-> id_module= $dataRow['id_module']; 
            $this->specialite-> id_specialite= $dataRow['id_specialite']; 
            $this-> id_specialite= $dataRow['id_specialite']; 
         
                $this-> specialite->filiere= $dataRow['filiere']; 
                $this-> specialite->code= $dataRow['code']; 
                $this-> specialite->intitule= $dataRow['intitule'];
           
                       
        }        

        // UPDATE
        public function updateModule(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    id_specialite = :id_specialite,
                    intitule = :intitule,
                    semestre = :semestre,
                    coefficient= :coefficient,
                    credit = :credit 
                    WHERE 
                    id_module = :id_module";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
            $this->semestre=htmlspecialchars(strip_tags($this->semestre));
            $this->coefficient=htmlspecialchars(strip_tags($this->coefficient));
            $this->credit=htmlspecialchars(strip_tags($this->credit));
            $this->intitule=htmlspecialchars(strip_tags($this->intitule));
            $this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
        
           
         
            // bind data
            $stmt->bindParam(":semestre", $this->semestre);
            $stmt->bindParam(":coefficient", $this->coefficient);
            $stmt->bindParam(":credit", $this->credit);
            $stmt->bindParam(":intitule", $this->intitule);
            $stmt->bindParam(":id_module", $this->id_module);
            $stmt->bindParam(":id_specialite", $this->id_specialite);


            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteModule(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_module = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_module=htmlspecialchars(strip_tags($this->id_module));
        
            $stmt->bindParam(1, $this->id_module);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

      // GET ALL
      public function getModulesParSpecialite(){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " where id_specialite = :id_specialite";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
        $stmt->bindParam(":id_specialite", $this->id_specialite);

    
        $stmt->execute();
        return $stmt;
    }
    }
?>
<?php
    class Utilisateur{

        // Connection
        private $conn;

        // Table
        private $db_table = "Utilisateur";

        // Columns
        public $id_utilisateur;
        public $nom_d_utilisateur;
        public $mot_de_passe;
        public $role;      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateurs(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }


        // CREATE
        public function createUtilisateur(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            nom_d_utilisateur= :nom_d_utilisateur,
            mot_de_passe = :mot_de_passe,
            role= :role
       
            ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom_d_utilisateur=htmlspecialchars(strip_tags($this->nom_d_utilisateur));
            $this->mot_de_passe=htmlspecialchars(strip_tags($this->mot_de_passe));
            $this->role=htmlspecialchars(strip_tags($this->role));
            // bind data
            $stmt->bindParam(":nom_d_utilisateur", $this->nom_d_utilisateur);
            $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
            $stmt->bindParam(":role", $this->role);
            if( $stmt->execute()){
                return $this->conn->lastInsertId();
            };

        }

        // READ single
        public function login(){
            $sqlQuery = "SELECT * FROM
                        ". $this->db_table ."
                    WHERE 
                    nom_d_utilisateur = :nom_d_utilisateur 
                    and mot_de_passe= :mot_de_passe
                    ";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":nom_d_utilisateur", $this->nom_d_utilisateur);
            $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
         
            if(!empty($dataRow)&&$count == 1 ){
                $this->nom_d_utilisateur= $dataRow['nom_d_utilisateur'];
                $this->mot_de_passe= $dataRow['mot_de_passe'];
                $this->role= $dataRow['role'];
                $this->id_utilisateur= $dataRow['id_utilisateur'];
            }else{
                $this->nom_d_utilisateur=null;
                $this->mot_de_passe=null;
                $this->role=null;
            }            
        }        

        // UPDATE
        public function updateUtilisateur(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    nom_d_utilisateur = :nom_d_utilisateur,
                    mot_de_passe= :mot_de_passe,
                    role = :role
                    
                      
                    WHERE 
                    id_utilisateur = :id_utilisateur";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
         
            $this->id_utilisateur=htmlspecialchars(strip_tags($this->id_utilisateur));
            $this->nom_d_utilisateur=htmlspecialchars(strip_tags($this->nom_d_utilisateur));
            $this->mot_de_passe=htmlspecialchars(strip_tags($this->mot_de_passe));
            $this->role=htmlspecialchars(strip_tags($this->role));
        
            // bind data
            $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
            $stmt->bindParam(":nom_d_utilisateur", $this->nom_d_utilisateur);         
            $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);         
            $stmt->bindParam(":role", $this->role);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteUtilisateur(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_utilisateur = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_utilisateur=htmlspecialchars(strip_tags($this->id_utilisateur));
        
            $stmt->bindParam(1, $this->id_utilisateur);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        

        //GEt bu ID

         // READ single
         public function getById(){
            $sqlQuery = "SELECT * FROM
                        ". $this->db_table ."
                    WHERE 
                    id_utilisateur = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_utilisateur);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id_utilisateur = $dataRow['id_utilisateur'];
            $this->nom_d_utilisateur = $dataRow['nom_d_utilisateur'];
            $this->mot_de_passe = $dataRow['mot_de_passe'];
          
            
        } 

    }
?>
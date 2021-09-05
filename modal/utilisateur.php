<?php
    class Utilisateur{

        // Connection
        private $conn;

        // Table
        private $db_table = "Utilisateur";

        // Columns
        public $id_utilisateur;
        public $username;
        public $password;
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
            username= :username,
            password = :password,
            role= :role
       
            ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->role=htmlspecialchars(strip_tags($this->role));
            // bind data
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
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
                    username = :username 
                    and password= :password
                    ";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
         
            if(!empty($dataRow)&&$count == 1 ){
                $this->username= $dataRow['username'];
                $this->password= $dataRow['password'];
                $this->role= $dataRow['role'];
                $this->id_utilisateur= $dataRow['id_utilisateur'];
            }else{
                $this->username=null;
                $this->password=null;
                $this->role=null;
            }            
        }        

        // UPDATE
        public function updateUtilisateur(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    username = :username,
                    password= :password,
                    role = :role
                    
                      
                    WHERE 
                    id_utilisateur = :id_utilisateur";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
         
            $this->id_utilisateur=htmlspecialchars(strip_tags($this->id_utilisateur));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->role=htmlspecialchars(strip_tags($this->role));
        
            // bind data
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":username", $this->username);         
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
        


    }
?>
<?php
    class Enseignant{

        // Connection
        private $conn;

        // Table
        private $db_table = "Enseignant";

        // Columns
        public $id_enseignant;
        public $nom;
        public $prenom;
        public $matricule;
        public $date_naissance;
        public $lieu_naissance;
        public $email;
        public $telephoe;
        public $username;
        public $mot_de_passe;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEnseignants(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEnseignant(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ." 
            SET
            nom = :nom,
            prenom = :prenom,
            matricule= :matricule, 
            date_naissance = :date_naissance, 
            lieu_naissance = :lieu_naissance, 
            email = :email, 
            telephone = :telephone, 
            username = :username,
            mot_de_passe = :mot_de_passe
            ";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->matricule=htmlspecialchars(strip_tags($this->matricule));
            $this->date_naissance=htmlspecialchars(strip_tags($this->date_naissance));
            $this->lieu_naissance=htmlspecialchars(strip_tags($this->lieu_naissance));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->mot_de_passe=htmlspecialchars(strip_tags($this->mot_de_passe));
         
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":matricule", $this->matricule);
            $stmt->bindParam(":date_naissance", $this->date_naissance);
            $stmt->bindParam(":lieu_naissance", $this->lieu_naissance);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
    
            
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
                    id_enseignant = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_enseignant);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->email = $dataRow['email'];
            $this->telephone = $dataRow['telephone'];
            $this->matricule = $dataRow['matricule'];
            $this->username = $dataRow['username'];
            $this->mot_de_passe = $dataRow['mot_de_passe'];
            $this->lieu_naissance = $dataRow['lieu_naissance'];
            $this->date_naissance = $dataRow['date_naissance'];
       
        }        

        // UPDATE
        public function updateEnseignant(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    nom = :nom,
                    prenom = :prenom,
                    matricule= :matricule, 
                    date_naissance = :date_naissance, 
                    lieu_naissance = :lieu_naissance, 
                    email = :email, 
                    telephone = :telephone, 
                    username = :username,
                    mot_de_passe = :mot_de_passe      
                    WHERE 
                    id_enseignant = :id_enseignant";
        
            $stmt = $this->conn->prepare($sqlQuery);
            //serialize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->matricule=htmlspecialchars(strip_tags($this->matricule));
            $this->date_naissance=htmlspecialchars(strip_tags($this->date_naissance));
            $this->lieu_naissance=htmlspecialchars(strip_tags($this->lieu_naissance));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->mot_de_passe=htmlspecialchars(strip_tags($this->mot_de_passe));
         
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":matricule", $this->matricule);
            $stmt->bindParam(":date_naissance", $this->date_naissance);
            $stmt->bindParam(":lieu_naissance", $this->lieu_naissance);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
             $stmt->bindParam(":id_enseignant", $this->id_enseignant);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // // DELETE
        function deleteEnseignant(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_enseignant = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_enseignant=htmlspecialchars(strip_tags($this->id_enseignant));
        
            $stmt->bindParam(1, $this->id_enseignant);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
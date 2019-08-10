<?php 
    require_once("Db.php");
    require_once("Security.php");
    
    class User { 
        
        private $email;
        private $password;
        private $passwordConfirmation;
        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }
        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;
                return $this;
        }
        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }
        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;
                return $this;
        }
        /**
         * Get the value of passwordConfirmation
         */ 
        public function getPasswordConfirmation()
        {
                return $this->passwordConfirmation;
        }
        /**
         * Set the value of passwordConfirmation
         *
         * @return  self
         */ 
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;
                return $this;
        }
        
        public function register() {
            $hash = Security::hash($this->password);
            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into user (email, password) values (:email,:password)");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $hash);
                $result = $statement->execute();
                return $result;
            } 
            
            catch (Throwable $t) {
                $error = $t->getMessage();
            }
        }

        public static function canLogin($email, $password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from user where email = :email");
            $statement->bindParam(":email", $email); 
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $user['password'])) {
                return true;
            } else {
                return false;
            }
        }
        
        public function doLogin($email) {
            $_SESSION['email'] = $email;
            header("Location: index.php");   
        }

        
        public static function getUserById($id){
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from user where id = :id');
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
    }


    }
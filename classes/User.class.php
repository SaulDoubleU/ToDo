<?php 
    require_once("Db.class.php");
    require_once("classes/Security.class.php");
    
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

          /**
         * @return boolean - true if registration, false if unsuccessful.
         */
        
        public function register() {
            $hash = Security::hash($this->password);
            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into user (email, password) values (:email,:password)");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $hash);
                $result = $statement->execute();
                return $result;
            
                $getData = $conn->prepare('select * from user where email = :email');
                $getData->bindParam(':email', $this->email);
                $getData->execute();
                $data = $getData->fetchAll();
            
                if(!empty($data)){
                    return array($data[0]['id'], $data[0]['email']);
                }else{
                    return false;
                }

    
            } catch ( Throwable $t ) {
                return false;
    
            }
        }

        public function canLogin(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from user where email = :email");
            $statement->bindParam(":email", $this->email); 
            $statement->execute();
            $result = $statement->fetchAll();
            
            if(!empty($result)){
                if(password_verify($this->password, $result[0]['password'])){
                    return array($result[0]['id'], $result[0]['email']);
                }
                return false;
            }
        }

        public static function checkLogin(){
            if(!isset($_SESSION)) { 
            }
            if(!isset($_SESSION['email'])){
                header('Location: login.php');
            }
        }

        public static function getLoginId($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select id from user where email = :email ");
            $statement->bindParam(":email", $email);
            $statement->execute();
            $userId = $statement->fetch(PDO::FETCH_ASSOC);
            $userId = $userId['id'];
            return $userId;
            
        }

        public static function isAccountAvailable($email){
            $e = self::findByEmail($email);
            
            if($e == false){
                return true;
            } else {
                return false;
            }
        }
    
        public static function getUserId(){
                $userSession = $_SESSION['username'][1];
                $conn = Db::getConnection();
                $statement = $conn->prepare('select id from user where email = :userSession');
                $statement->bindParam(':userSession', $userSession);
                $statement->execute();
                $userId = $statement->fetch(PDO::FETCH_ASSOC);
                $userId = $userId['id'];
                return $userId;
        }

        
    }

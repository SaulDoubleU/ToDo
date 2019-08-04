<?php

    class User {
        private $email;
        private $password; 
        private $passwordConfirmation;

        /*MANUEEL GEGENEREERDE GETTERS & SETTERS
        public function setEmail($p_sEmail) { //setter is public omdat je anders niet kan gebruiken
            $this->email = $p_sEmail;
        }

        public function getEmail(){
            return $this->email; //je kan hier aan private email omdat je in dezelfde klasse zit 
        }*/

        

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
         * @return  self //geeft zichzelf terug
         */ 
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;

                return $this;
        }
        public function register() {
            // @todo: form validation
            $options = [
                'cost' => 12 //2^12 --> aantal keer dat gehasht wordt, is exponentieel vergroot --> hier 4096 hash maken
            ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);//password_hash geeft telkens een random salt mee
    
            try{
                $conn = new PDO("mysql:host=localhost;dbname=todoapp","root","root", null); //root nooit online zetten
                $statement = $conn->prepare("INSERT into users (email,password) VALUES (:email,:password)"); //prepare omdat er input van de user komt
                $statement->bindParam(":email",$this->email); //bindParam plakt niks in query totdat je hem runt
                $statement->bindParam(":password",$password);//bindParam gaat de quotes escapen, veiliger, zelfde als escape_string + hier mag het niet $this->password worden want anders wordt dat ongehashed
                $result = $statement->execute(); //execute gaat de statement runnen, returnt false of true
                return $result;
    
            } catch(Throwable $t){
                return false;
            };
        }
    }



    
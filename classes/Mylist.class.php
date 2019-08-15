<?php 
    require_once("Db.class.php");
    
    class Mylist { 
        
        private $listName;

        


        /**
         * Get the value of listName
         */ 
        public function getListName()
        {
                return $this->listName;
        }
        /**
         * Set the value of listName
         *
         * @return  self
         */ 
        public function setListName($listName)
        {
                $this->listName = $listName;
                return $this;
        }

        
        public static function addList($listName, $userId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into list (list_name, user_id) values (:listName, :userId)");
                $statement->bindParam(":listName", $listName);
                $statement->bindParam(":userId", $userId);
                $statement->execute();
                return $statement;
        
        }
    

                public static function getListInfo($userId) {

                            $conn = Db::getConnection();
                            $statement = $conn->prepare("select * from list where user_id = :userId");
                            $statement->bindParam(":userId", $userId);
                            $statement->execute();
                            $userlist = $statement->fetchAll();
            
                            return $userlist;
                        } 
                        
        }
        

        
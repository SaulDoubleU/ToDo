<?php 
    require_once("Db.class.php");
    
    class Mylist { 
        
        private $listName;
        private $listId;

         /**
         * Get the value of listId
         */ 
        public function getlistId()
        {
                return $this->listId;
        }

        /**
         * Set the value of listId
         *
         * @return  self
         */ 
        public function setlistId($listId)
        {
                $this->listId = $listId;

                return $this;
        }

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

        
        public function addList() {
                try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into list (list_name) values (:listName)");
                $statement->bindParam(":listName", $this->listName);
                $statement->execute();
                return $statement;
        } catch ( Throwable $t ) {
                return false;
    
            }
        }

        public static function getListById($listId) {
                try {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare('select * from list where id = :list_id');
                    $statement->bindParam('list_id', $listId);
                    $statement->execute();
                    
                    return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }
    
            public static function deleteList($listId) {
                    try {
                        $conn = Db::getConnection();
                        $statement = $conn->prepare('delete from list where id = :list_id');
                        $statement->bindParam('list_id', $listId);
                        $statement->execute();       
                } catch ( Throwable $t ) {
                        return false;
            
                    }
                }
        }
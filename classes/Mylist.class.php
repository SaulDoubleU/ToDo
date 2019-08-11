<?php 
    require_once("Db.class.php");
    
    class Mylist { 
        
        private $list;
        private $listInfo;
        private $listId;


         /**
         * Get the value of listId
         */ 
        public function getListId()
        {
                return $this->listId;
        }

        /**
         * Set the value of listId
         *
         * @return  self
         */ 
        public function setListId($listId)
        {
                $this->listId = $listId;

                return $this;
        }
        /**
         * Get the value of listInfo
         */ 
        public function getListInfo()
        {
                return $this->listInfo;
        }
        /**
         * Set the value of listInfo
         *
         * @return  self
         */ 
        public function setListInfo($listInfo)
        {
                $this->listInfo = $listInfo;
                return $this;
        }

        /**
         * Get the value of list
         */ 
        public function getList()
        {
                return $this->list;
        }
        /**
         * Set the value of list
         *
         * @return  self
         */ 
        public function setList($list)
        {
                $this->list = $list;
                return $this;
        }
    
        
        public function addList($list) {

            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into list (list_name) values (:list)");
                $statement->bindParam(":list", $list);
                $statement->execute();
                
            } 
            
            catch (Throwable $t ) {
                return false;
            }
        }

        public static function getListInformation() {

            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from list");
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } 
            
            catch (Throwable $t ) {
                echo $t;
            }
        }
        
        
    }
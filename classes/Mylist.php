<?php 
    require_once("Db.php");
    
    class Mylist { 
        
        private $list;
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
        
    }
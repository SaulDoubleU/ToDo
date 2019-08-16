<?php 
    require_once("Db.class.php");
    
    class Task { 
        
        private $taskDesc;

        /**
         * Get the value of taskDesc
         */ 
        public function gettaskDesc()
        {
                return $this->taskDesc;
        }
        /**
         * Set the value of taskDesc
         *
         * @return  self
         */ 
        public function settaskDesc($taskDesc)
        {
                $this->taskDesc = $taskDesc;
                return $this;
        }

                public static function getTaskInfo($listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where list_id = :listId");
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                $usertask = $statement->fetchAll();
            
                return $usertask;
        } 

        
        public static function addTask($taskDesc, $tasklist) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into task (task_name, list_id) values (:taskDesc, :tasklist)");
                $statement->bindParam(":taskDesc", $taskDesc);
                $statement->bindParam(":tasklist", $tasklist);
                $statement->execute();
                return $statement;
        
        }

        
                        

            
}
        

        
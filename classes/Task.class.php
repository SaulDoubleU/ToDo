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

        
        public static function addTask($taskDesc, $listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into task (task_name, list_id) values (:taskDesc, :listId)");
                $statement->bindParam(":taskDesc", $taskDesc);
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                return $statement;
        
        }

                public static function getTaskInfo($listId) {

                            $conn = Db::getConnection();
                            $statement = $conn->prepare("select * from task where list_id = :listId");
                            $statement->bindParam(":listId", $listId);
                            $statement->execute();
                            $usertask = $statement->fetchAll();
            
                            return $usertask;
                        } 
                        

            
        }
        

        
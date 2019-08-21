<?php 
    require_once("Db.class.php");
    
    class Task { 
        
        private $taskDesc;
        private $taskDeadline;
        private $taskPressure;
        private $taskFile;


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

        /**
         * Get the value of taskFile
         */ 
        public function gettaskFile()
        {
                return $this->taskFile;
        }
        /**
         * Set the value of taskFile
         *
         * @return  self
         */ 
        public function settaskFile($taskFile)
        {
                $this->taskFile = $taskFile;
                return $this;
        }

        
        /**
         * Get the value of taskPressure
         */ 
        public function gettaskPressure()
        {
                return $this->taskPressure;
        }
        /**
         * Set the value of taskPressure
         *
         * @return  self
         */ 
        public function settaskPressure($taskPressure)
        {
                $this->taskPressure = $taskPressure;
                return $this;
        }


        /**
         * Get the value of taskDeadline
         */ 
        public function gettaskDeadline()
        {
                return $this->taskDeadline;
        }
        /**
         * Set the value of taskDeadline
         *
         * @return  self
         */ 
        public function settaskDeadline($taskDeadline)
        {
                $this->taskDeadline = $taskDeadline;
                return $this;
        }

        public static function getTaskInfo($listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where list_id = :listId and task_done= 0 ORDER BY task_deadline ASC");
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                $usertask = $statement->fetchAll();
            
                return $usertask;
        } 


        public static function getTaskInfoHours($listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where list_id = :listId and task_done= 0 ORDER BY task_pressure ASC");
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                $usertask = $statement->fetchAll();
            
                return $usertask;
        }
        
        public static function addTask($taskDesc, $taskDeadline, $taskPressure, $taskFile, $tasklist) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into task (task_name, task_deadline, task_pressure, task_file_name, list_id) values (:taskDesc, :taskDeadline, :taskPressure, :taskFile, :tasklist)");
                $statement->bindParam(":taskDesc", $taskDesc);
                $statement->bindParam(":taskDeadline", $taskDeadline);
                $statement->bindParam(":taskPressure", $taskPressure);
                $statement->bindParam(":taskFile", $taskFile);
                $statement->bindParam(":tasklist", $tasklist);
                $statement->execute();
                return $statement;
        
        }

        
        public static function deleteListTasks($id) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("delete from task where list_id = :id");
                $statement->bindParam(":id", $id);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC);
            }

        public static function findTask($taskid) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where id = :id");
                $statement->bindParam(":id", $taskid);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC);
            }

        public static function findDeadline($taskid) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select task_deadline from task where id = :id");
                $statement->bindParam(":id", $taskid);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC);
            }
                        
        public static function doneTask($taskid) {
                try {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update task set task_done= 1 where id = :id");
                    $statement->bindParam('id', $taskid);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

            public static function updateDeadline($taskid, $taskDeadline) {
                try {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update task set task_deadline = :taskDeadline where id = :id");
                    $statement->bindParam(":id", $taskid);
                    $statement->bindParam(":taskDeadline", $taskDeadline);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

            public static function deleteDeadline($taskid, $taskDeadline) {
                try {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update task set task_deadline = null where id = :id");
                    $statement->bindParam(":id", $taskid);
                    $statement->bindParam(":taskDeadline", $taskDeadline);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

            public static function deleteFile($taskid) {
                try {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update task set task_file_name = null where id = :id");
                    $statement->bindParam(":id", $taskid);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

            public static function getDoneTask($listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where list_id = :listId and task_done= 1 ORDER BY task_deadline DESC");
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                $usertask = $statement->fetchAll();
            
                return $usertask;
        } 

        public static function getDoneTaskHours($listId) {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task where list_id = :listId and task_done= 1 ORDER BY task_pressure DESC");
                $statement->bindParam(":listId", $listId);
                $statement->execute();
                $usertask = $statement->fetchAll();
            
                return $usertask;
        } 
            
}
        

        
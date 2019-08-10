<?php 
    require_once("Db.php");
    
    class Task { 
        
        private $task;
        private $taskInfo;

        /**
         * Get the value of taskInfo
         */ 
        public function getTaskInfo()
        {
                return $this->taskInfo;
        }
        /**
         * Set the value of taskInfo
         *
         * @return  self
         */ 
        public function setTaskInfo($taskInfo)
        {
                $this->taskInfo = $taskInfo;
                return $this;
        }

        /**
         * Get the value of task
         */ 
        public function getTask()
        {
                return $this->task;
        }
        /**
         * Set the value of task
         *
         * @return  self
         */ 
        public function setTask($task)
        {
                $this->task = $task;
                return $this;
        }
    
        
        public function addTask($task) {

            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("insert into task (task_name) values (:task)");
                $statement->bindParam(":task", $task);
                $statement->execute();
                
            } 
            
            catch (Throwable $t ) {
                return false;
            }
        }

        public static function getTaskInformation() {

            try {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from task");
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } 
            
            catch (Throwable $t ) {
                return false;
            }
        }
        
        
    }
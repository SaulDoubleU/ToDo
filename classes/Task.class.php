<?php 
    require_once("Db.class.php");
    
    class Task { 
        
        private $task;
        private $taskInfo;
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
                $statement = $conn->prepare("insert into task (task_name, list_id) values (:task, :list_id)");
                $statement->bindParam(":task", $task);
                $statement->bindParam(":list_id", $this->listId);
                $statement->execute();
                
            } 
            
            catch (Throwable $t ) {
                return false;
            }
        }

        public static function getTaskByListId($listId) {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from task where list_id = :list_id');
                $statement->bindParam('list_id', $listId);
                $statement->execute();

                return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch ( Throwable $t ) {
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
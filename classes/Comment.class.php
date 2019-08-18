<?php

class Comment
{
    private $comment;

	

    public static function getTaskComments($taskId) {

        $conn = Db::getConnection();
        $result = $conn->prepare("select * from comments where task_id = :taskId");
        $result->bindParam(":taskId", $taskId);
        $result->execute(); 
        return $result->fetchAll(PDO::FETCH_ASSOC);
    
        
} 

    public function Save($taskId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into comments (task_id, comment) values (:taskId, :comment)");
        $statement->bindParam(":taskId", $taskId);
        $statement->bindValue(":comment", $this->getComment());
        return $statement->execute();        
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
?>
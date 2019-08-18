<?php
    require_once("../bootstrap.php");
  

    if(!empty($_POST)) {
        $comment = $_POST['comment'];
        $taskId = $_POST['taskId'];

        try {
            $c = new Comment();
            $c->setComment($comment);
            $c->save($taskId); 
            
            $result = [
                "status" => "success",
                "message" => "Comment was saved.",
                "comment" => $comment
            ];
        } catch(Throwable $t) {
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }
       
        echo json_encode($result);
    }

?>
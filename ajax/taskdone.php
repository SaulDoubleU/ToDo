<?php
    require_once("../bootstrap.php");
  

    if(!empty($_POST)) {
        $task = $_POST['taskId'];

        try {
            $c->getDoneTask($task);
            $c->save($taskId); 
            
            $result = [
                "status" => "success",
                "message" => "Task marked as Done",
                "task" => $task
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
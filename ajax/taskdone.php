<?php
    require_once("../bootstrap.php");
  

    if(!empty($_POST)) {
        $taskId = $_POST['taskId'];

        try {
            
            Task::doneTask($taskId);
            
            $result = [
                "status" => "success",
                "message" => "Task marked as Done",
                "taskId" => $taskId
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

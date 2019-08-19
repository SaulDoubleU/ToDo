<?php
    require_once("bootstrap.php");
    $tasklist = $_GET['tasklist_id'];
    $taskid = $_GET['task_id'];

    Task::doneTask($taskid);
    
    header("Location: mytasks.php?tasklist_id=" .$tasklist);
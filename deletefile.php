<?php
    require_once("bootstrap.php");
   
    $tasklist = $_GET['tasklist_id'];
    $task = $_GET['task_id'];

    $findtask = Task::findTask($task);
    $tlist = Mylist::findList($tasklist);
    
    $delfile = Task::deleteFile($task);

    header("Location: mytasks.php?tasklist_id=" .$tlist['id']);

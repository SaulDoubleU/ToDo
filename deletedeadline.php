<?php
    require_once("bootstrap.php");
    
    $tasklist = $_GET['tasklist_id'];
    $task = $_GET['task_id'];

    $findtask = Task::findTask($task);
    $tlist = Mylist::findList($tasklist);
    
    $taskDeadline =$_POST['deadline'];
    Task::updateDeadline($task, $taskDeadline);
    header("Location: mytasks.php?tasklist_id=" .$tlist['id']);

        
    
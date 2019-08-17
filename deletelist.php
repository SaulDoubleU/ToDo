<?php
    require_once("bootstrap.php");
    $tasklist = $_GET['tasklist_id'];

    Mylist::deleteList($tasklist);
    Task::deleteListTasks($tasklist);
    
    header("Location: index.php");

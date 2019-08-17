<?php
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        
    
    
    $tasklist = $_GET['tasklist_id'];
    $task = $_GET['task_id'];
    $findtask = Task::findTask($task);
    $tlist = Mylist::findList($tasklist);
    
    if (!empty($_POST['task'])) {

        $task = new Task();


        $taskDesc = $task->gettaskDesc();
        $taskDeadline = $task->gettaskDeadline();
    }
    

    
    //show data from list
    $task = Task::getTaskInfo($tasklist);
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Add List</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

<br><br><br>

         <h2 class="taskTitle"><?php echo $findtask['task_name']; ?></h2>


        <div>

            <ul id="taskupdates">

               <li> <?php echo  $findtask['task_deadline']; ?></li>
                
            </ul>

        </div>


    <a href="mytasks.php?tasklist_id=<?php echo $tlist['id']; ?>">back to tasks!</a>

</body>

</html>
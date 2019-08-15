<?php 
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        

    if (!empty($_POST['task'])) {

        
        $usertask = new Task();
        $usertask->settaskDesc($_POST['task']);
        $listId = Task::getListId();


        $taskDesc = $userlist->gettaskDesc();
        $usertask->addTask($taskDesc, $listId);

        //show data from task
        $usertask = Task::getTaskInfo($listId);

    }
    
    else {
        $error = "All fields must be filled in.";
    }


        
    

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

    <form action="" method="post">
        <h2 class="formTitle">Add New Task</h2>

        <div class="formInput">
            <div class="formField">
                <label for="task">Task Title</label>
                <input type="text" id="task" name="task" placeholder="task title">
            </div>

            <input type="submit" value="add task" class="btn">

        </div>

         <h2 class="taskTitle">My Tasks</h2>
        <div>

            <ul id="taskupdates">

            <?php foreach ($usertask as $t): ?>
               <?php echo "<li>". $t['task_name'] ."</li>"; ?></a>
                <?php endforeach; ?>
                
            </ul>

        </div>
    </form>


</body>

</html>
<?php
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        
    
    $tasklist = $_GET['tasklist_id'];
    $t = Mylist::findList($tasklist);

    if(isset($_POST['addbtn'])) {
    if (!empty($_POST['task'])) {

        $task = new Task();
        $task->settaskDesc($_POST['task']);
        


        $taskDesc = $task->gettaskDesc();
        $task->addTask($taskDesc, $tasklist);

    }
    
    else {
        $error = "You have to add a list title first";
    }

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

    <form action="" method="post">
        <h2 class="formTitle">Add New Task</h2>

        <?php if(isset($error)): ?>
            <div class="form__error">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
            <div class="formField">
                <label for="task">Task Title</label>
                <input type="text" id="task" name="task" placeholder="task title">
            </div>

            <input type="submit" value="add task" name="addbtn" class="btn">

        </div>

         <h2 class="taskTitle">My Tasks</h2>
        <div>

            <ul id="taskupdates">

            <?php foreach ($task as $t): ?>
               <?php echo "<li>". $t['task_name'] ."</li>"; ?></a>
                <?php endforeach; ?>
                
            </ul>

        </div>
    </form>
    <a href="index.php">back to lists!</a>

</body>

</html>
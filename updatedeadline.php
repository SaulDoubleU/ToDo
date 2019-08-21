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
    

    if(isset($_POST['addbtn'])) {
    if (!empty($_POST['deadline'])) {

        $taskDeadline = new Task();
        $taskDeadline->settaskDeadline($_POST['deadline']);

        
        $taskDeadline->updateDeadline($taskDeadline, $findtask);

    }
    
    else {
        $error = "You have to change the deadline first!";
    }
    Task::updateDeadline($taskDeadline, $findtask);
    /*header("Location: task.php?tasklist_id=" .$tlist['id'] . "&task_id=" .$findtask['id']);*/
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Update Deadline</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>
<div class="container">
    <form action="" method="post">
        <h2 class="formTitle">Update Deadline</h2>

        <?php if(isset($error)): ?>
            <div class="form__error">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
            <div class="formField">
                
                <input type="date" id="task" name="deadline">
            </div>

        </div>
        <br>
        <div class="updatedeadlinebtn">
        <input type="submit" value="update deadline" name="addbtn" class="btn" >
        </div>
    </form>

        <div class="backlink">
        <a href="mytasks.php?tasklist_id=<?php echo $tlist['id']; ?>"><img src="images/back.svg" width="30px;" alt=""></a>
        </div>
    </div>
</body>

</html>
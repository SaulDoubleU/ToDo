<?php
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }

$_POST = array_filter($_POST);
$tasklist = $_GET['tasklist_id'];
$tl = Mylist::findList($tasklist);
        
if(isset($_POST['addbtn'])) {
if (!empty($_POST['tasktitle']) && !empty($_POST['work'])) {

    $task = new Task();
    $task->settaskDesc($_POST['tasktitle']);
    $task->settaskDeadline($_POST['deadline']);
    $task->settaskPressure($_POST['work']);

    $taskDesc = $task->gettaskDesc();
    $taskDeadline = $task->gettaskDeadline();
    $taskPressure = $task->gettaskPressure();
    $task->addTask($taskDesc, $taskDeadline, $taskPressure, $tasklist);
    

    header("Location: mytasks.php?tasklist_id=" .$tasklist);

}

else {
    $error = "Task Title or Work Hours are empty!";
}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Add Task</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

<div class="container"> 
    <form method="post" >
        <h2 class="formTitle">Add New Task</h2>

        <?php if(isset($error)): ?>
            <div class="form__error">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
        <label for="task">Task Title</label>
            <div class="formField">
                <input type="text" id="task" name="tasktitle" placeholder="task title">
            </div>
            
            <div class="deadlineandtime" ></div>
            <label for="task">Deadline</label>
            <label class="workh" for="task">Work Hours</label>
            <div class="formField">
                <input type="date" id="task" name="deadline">
                <input type="time" id="task" name="work">
            </div>
            <br>

            <label for="task">Add an extra file</label>
            <div class="formField">
                <input type="file" id="task" name="file" placeholder="file">
                
            </div>
       

        </div>
        <br><br>
       <div class="addtaskbtn">
        <input type="submit" value="Add task" name="addbtn" class="btn" >
        </div>
    </form>

        <div class="backlink">
        <a href="javascript:history.go(-1)"><img src="images/back.svg" width="30px;" alt=""></a>
        </div>
    </div>

    
</body>

</html>
<?php
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        
    
    $tasklist = $_GET['tasklist_id'];
    $tl = Mylist::findList($tasklist);

    if(isset($_POST['addbtn'])) {
    if (!empty($_POST['tasktitle'])) {

        $task = new Task();
        $task->settaskDesc($_POST['tasktitle']);
        $task->settaskDeadline($_POST['deadline']);
        $task->settaskPressure($_POST['work']);

        $taskDesc = $task->gettaskDesc();
        $taskDeadline = $task->gettaskDeadline();
        $taskPressure = $task->gettaskPressure();
        $task->addTask($taskDesc, $taskDeadline, $taskPressure, $tasklist);

    }
    
    else {
        $error = "You have to add a task title first";
    }

    header("Location: mytasks.php?tasklist_id=" .$tasklist);
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
                <input type="text" id="task" name="tasktitle" placeholder="task title">
            </div>
            
            <div class="formField">
                <label for="task">Deadline</label>
                <input type="date" id="task" name="deadline">
            </div>

            <div class="formField">
                <label for="task">Work Hours</label>
                <input type="time" id="task" name="work">
            </div>

            <div class="formField">
                <label for="task">extra file</label>
                <input type="text" id="task" name="file" placeholder="file">
            </div>

        </div>
        <br><br><br>
        <input type="submit" value="add task" name="addbtn" class="btn" >
    </form>

    
    <a href="mytasks.php?tasklist_id=<?php echo $tl['id']; ?>">exit</a>
    

</body>

</html>
<?php 
    require_once("bootstrap/bootstrap.php");

    if( !empty($_POST) ){

            $mytask = new Task();
            $mytask->setTask($_POST['task']);
            
            // naam van de taak
            $task = $mytask->getTask();
        
            // functie oproepen om in db te plaatsen
            $mytask->addTask($task);

            $mytask = Task::getTaskInformation($task);
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
    
</head>

<body>

    <form action="" method="post">
        <h2 class="formTitle">Add New Task</h2>

        <div class="formInput">
            <div class="formField">
                <label for="task">Task</label>
                <input type="text" id="task" name="task" placeholder="task">
            </div>

            <input type="submit" value="add task" class="btn">

        </div>

         <h2 class="formTitle">Tasks</h2>
        <div>

            <ul id="listupdates">

            <?php foreach ($mytask as $t): ?>
              <?php echo "<li>". $t['task_name'] ."</li>";?>
                <?php endforeach; ?>
                
            </ul>

        </div>
    </form>

    <a href="index.php">back to lists!</a>
</body>

</html>
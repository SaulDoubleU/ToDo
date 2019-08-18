<?php
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        
    
    $tasklist = $_GET['tasklist_id'];
    $tlist = Mylist::findList($tasklist);

    
    

    
    //show data from list
    $task = Task::getTaskInfo($tasklist);
    $taskdone = Task::getDoneTask($tasklist);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Add List</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

<br><br><br>

            <a href="newtask.php?tasklist_id=<?php echo $tlist['id']; ?>">Add new task!</a>
            
            
         <h2 class="taskTitle">My Tasks</h2>

         <h3 class="taskTitle">Todo</h3>

        <div>

            <ul id="taskupdates">

            <?php foreach ($task as $t): ?>
                <li><a href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $t['id']; ?>"><?php echo $t['task_name']; ?></a> &nbsp &nbsp &nbsp<?php echo  $t['task_deadline']; ?>
                &nbsp &nbsp &nbsp
                    <input type="checkbox" class="donetask" value="done" id="check">
                    <label>Task Done</label>
            
                </li>
          
                
            <?php endforeach; ?>
                
            </ul>

        </div>

        <h3 class="taskTitle">Done</h3>

        <div>

            <ul id="taskupdates">

            <?php foreach ($taskdone as $td): ?>
               <li><a href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $td['id']; ?>"><?php echo $td['task_name']; ?> &nbsp <?php echo  $td['task_deadline']; ?></a></li>
          
            <?php endforeach; ?>
                
            </ul>

        </div>
        <h4 id="result"></h4>
    <a href="index.php">back to lists!</a>


    <script>
        $(document).ready(function() {
            $('#check').click(function() {
                var update = [];
                $('.donetask').each(function() {
                    if ($(this).is(":checked")) {
                        update.push($(this).val());
                    }
                });
                update = update.toString();
                $.ajax({
                    url: "taskdone.php",
                    method: "POST",
                    data: {
                        update: update
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>
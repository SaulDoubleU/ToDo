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
                <li ><a data-id="<?php echo $t ?>" id="todotask" href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $t['id']; ?>">
                <?php echo $t['task_name']; ?></a> &nbsp &nbsp
                
                <?php $deadline = new DateTime($t['task_deadline']);
                    $today = new DateTime(date('y-m-d'));
                    $diff = $today->diff($deadline)->format("%r%a"); 

                    if ($diff <0) {
                         echo 'Deadline passed!';
                        }
                    else {
                        echo $diff . 'days left'; 
                    }
                    
                ?>

                &nbsp &nbsp &nbsp

                <a href="taskdone.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $t['id']; ?>" >Task Done</a>
            
                </li>
          
                
            <?php endforeach; ?>
                
            </ul>

        </div>

        <h3 class="taskTitle">Done</h3>

        <div id="donetasks">

            <ul id="taskupdates">

            <?php foreach ($taskdone as $td): ?>
               <li><a href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $td['id']; ?>"><?php echo $td['task_name']; ?></a> &nbsp 
               <?php $deadline = new DateTime($td['task_deadline']);
                    $today = new DateTime(date('y-m-d'));
                    $diff = $today->diff($deadline)->format("%r%a"); 

                    if ($diff <0) {
                         echo 'Deadline passed!';
                        }
                    else {
                        echo $diff . 'days left'; 
                    }
                    
                ?></li>
          
            <?php endforeach; ?>
                
            </ul>

        </div>
        <h4 id="result"></h4>
    <a href="index.php">back to lists!</a>


   <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script>
	$("#btnDone").on("click", function(e){
        
        var t = $("#todotask").attr("data-id");
        

        console.log(t);
		$.ajax({
  			method: "POST",
  			url: "ajax/taskdone.php",
  			data: { t: t },
			dataType: 'json'
		})

  		.done(function( res ) {
              console.log(res);
    		if( res.status == 'success' ) {
				var li = "<li style='display:none;'>" + task + "</li>";
				$("#listupdates").append(li);
				$("#comment").val("").focus();
				$("#listupdates li").last().slideDown();
			}
  		});

		e.preventDefault();
	});
  </script>
</body>

</html>
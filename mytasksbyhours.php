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
    $task = Task::getTaskInfoHours($tasklist);
    $taskdone = Task::getDoneTaskHours($tasklist);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Tasks</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

<div class="container-tasks" >
<h2 class="taskheadTitle">Tasklist</h2>
        <div class="sortbtn">
            <a href="mytasks.php?tasklist_id=<?php echo $tlist['id']; ?>">Sort by Deadline</a>
         </div>
        <div class="addtaskbtn">
            <a class="addtask" href="newtask.php?tasklist_id=<?php echo $tlist['id']; ?>">Add New Task!</a>
        </div>
            
         

         <h3 class="taskTitle">Todo</h3>

        <div>

            <ul id="taskupdates">
            
            <?php foreach ($task as $t): ?>
            <li>
            <div class="tasklist">
            
                <div class="taskinfo">
                    <a data-id="<?php echo $t ?>" id="todotask" href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $t['id']; ?>">
                        <?php echo $t['task_name']; ?></a>
                    
                        <div class="deadline">
                            <?php $deadline = new DateTime($t['task_deadline']);
                                $today = new DateTime(date('y-m-d'));
                                $diff = $today->diff($deadline)->format("%r%a"); 

                                if ($diff <0) {
                                    echo 'Deadline passed!';
                                    }
                                else {
                                    echo $diff . ' days left'; 
                                }
                                
                            ?>
                        </div>
                        <div class="worktime" >
                        <?php echo  date('G:i',strtotime($t['task_pressure'])); ?>    
                        </div>
                        <div class="taskdonebtn">
                            <a id="btnDone" data-id="<?php echo $t['id']; ?>" href="#" >Task Done</a>
                        </div>
                </div>

                
            
            </div> 
            </li>
            <?php endforeach; ?>
            
            </ul>

        </div>

        <h3 class="taskTitle">Done</h3>

        <div id="donetasks">

            <ul id="taskdoneupdates">

            <?php foreach ($taskdone as $td): ?>
            <li>
            <div class="tasklist">
            
            <div class="taskinfo">
               <a href="task.php?tasklist_id=<?php echo $tlist['id']; ?>&task_id=<?php echo $td['id']; ?>"><?php echo $td['task_name']; ?></a>
               
               <div class="deadline">
               <?php $deadline = new DateTime($td['task_deadline']);
                    $today = new DateTime(date('y-m-d'));
                    $diff = $today->diff($deadline)->format("%r%a"); 

                    if ($diff <0) {
                         echo 'Deadline passed!';
                        }
                    else {
                        echo $diff . ' days left'; 
                    }
                    
                ?>
                </div>
                <div class="worktime" >
                <?php echo  date('G:i',strtotime($td['task_pressure'])); ?>
                </div>
                </div>
            </div> 
            </li>
            <?php endforeach; ?>
                
            </ul>

        </div>
        <h4 id="result"></h4>

    <div class="backlink">
        <a href="index.php"><img src="images/back.svg" width="30px;" alt=""></a>
    </div>

    </div>
   <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script>
	$("#taskupdates").on("click", function(e){
        if(e.target.matches("#btnDone")){
            var btndone = e.target;
            var taskId = btndone.getAttribute("data-id");
            var task = e.target.parentElement.firstChild.innerHTML;

            $.ajax({
  			method: "POST",
  			url: "ajax/taskdone.php",
  			data: { taskId: taskId },
			dataType: 'json'
		})

  		.done(function( res ) {
              
    		if( res.status == 'success' ) {
                var li = e.target.parentElement;
                var li = li.lastChild.remove();
                e.target.parentElement.remove();
				$("#taskdoneupdates").append(li);
				$("#taskdoneupdates li").last().slideDown();
                
			}

  		});
          e.preventDefault();
        }
        
	});
  </script>
</body>

</html>
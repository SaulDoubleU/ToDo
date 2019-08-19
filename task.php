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
    $deadline = Task::findDeadline($task);

    

    $task = Task::getTaskInfo($tasklist);

    $taskId = $_GET['task_id'];

    if(!empty($_POST))
	{
		try {
			$comment = new Comment();
			$comment->setComment($_POST['comment']);
			$comment->Save($taskId);
		} catch (\Throwable $th) {
			//throw $th;
		}
    }
    
    $comments = Comment::getTaskComments($taskId);
  
    
    
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

         <h2 data-id="<?php echo $taskId ?>" class="taskTitle"><?php echo $findtask['task_name']; ?></h2>

         <div>

            <ul id="taskupdates">

            <li> Work Hours <?php echo  date('G:i',strtotime($findtask['task_pressure'])); ?></li>
            
            </ul>

        </div>


        <div>

            <ul id="taskupdates">

            <li>
               <?php
                    $deadline = new DateTime($findtask['task_deadline']);
                    $today = new DateTime(date('y-m-d'));
                     
                    $diff = $today->diff($deadline)->format("%r%a");
                     

                    if ($diff <0) {
                        echo 'Deadline passed!';
                       }
                   else {
                       echo $diff . 'days left'; 
                   }
                ?>

                 </li>

                <li> Deadline: <?php echo  $findtask['task_deadline'] ?></li>
            </ul>

        </div>

        <div>

            <ul id="taskupdates">

               <li> file</li>
                
            </ul>

        </div>

        <div>
        <h3>Comments</h3>

            <div class="errors"></div>
	
	<form method="post" action="">
		<div class="statusupdates">
		
        <input type="text" placeholder="Add comment" id="comment" name="comment" />
		<input id="btnComment" type="submit" value="Add comment" />
		
		<ul id="listupdates">
        <?php 
			foreach($comments as $c) {
					echo "<li>". $c['comment'] ."</li>";
			}
		?>
        
        
		    </ul>
		
		</div>
	</form>
                

        </div>


    <a href="mytasks.php?tasklist_id=<?php echo $tlist['id']; ?>">back to tasks!</a>


    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script>
	$("#btnComment").on("click", function(e){
        
        var comment = $("#comment").val();
        var taskId = $(".taskTitle").attr("data-id");
        console.log(taskId);
		$.ajax({
  			method: "POST",
  			url: "ajax/comment.php",
  			data: { comment: comment, taskId: taskId },
			dataType: 'json'
		})

  		.done(function( res ) {
              console.log(res);
    		if( res.status == 'success' ) {
				var li = "<li style='display:none;'>" + comment + "</li>";
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
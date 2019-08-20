<?php 
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        
        
    $userId = User::getUserId();
        
    if(isset($_POST['addbtn'])) {

    if (!empty($_POST['list'])) {

        $tasklist = new Mylist();
        $tasklist->setListName($_POST['list']);
        


        $listName = $tasklist->getListName();
        $tasklist->addList($listName, $userId);
    }
    
    else {
        $error = "*You have to add a list title first";
    }
    }

    //show data from list
    $tasklist = Mylist::getListInfo($userId);
    
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Lists</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

    <div class="container">
    <form action="" method="post">
        <h2 class="formTitle">My Lists</h2>


        <?php if(isset($error)): ?>
            <div class="form__errorindex">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
            <div class="formField">
                <input type="text" id="list" name="list" placeholder="List title">
            </div>
            <div class="formbtn">
            <input type="submit" value="add New List" name="addbtn" class="btn">
            </div>
        </div>
        </div>
        
        <div class="list">

            <ul id="listupdates">
            
            <?php foreach ($tasklist as $tl): ?>
            <div class="listitems" >
               <a class="listitem" href="mytasks.php?tasklist_id=<?php echo $tl['id']; ?>"><?php echo "<li>". $tl['list_name'] ."</li>"; ?></a>
               <a class="deletelist" href="deletelist.php?tasklist_id=<?php echo $tl['id']; ?>" ><img src="images/cross.svg" width="15px" alt=""></a>
            </div>
            <?php endforeach; ?>
            
            </ul>

        </div>
    </form>
    

</body>

</html>
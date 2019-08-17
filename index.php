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
        $error = "You have to add a list title first";
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
    <title>TodoApp - Add List</title>

    <link rel="stylesheet" href="css/style.css">
    <?php include_once("includes/nav.inc.php"); ?>
</head>

<body>

    
    <form action="" method="post">
        <h2 class="formTitle">Add New List</h2>


        <?php if(isset($error)): ?>
            <div class="form__error">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
            <div class="formField">
                <label for="list">List Title</label>
                <input type="text" id="list" name="list" placeholder="list title">
            </div>

            <input type="submit" value="add List" name="addbtn" class="btn">

        </div>

         <h2 class="listsTitle">My Lists</h2>
        <div>

            <ul id="listupdates">

            <?php foreach ($tasklist as $tl): ?>
               <a href="mytasks.php?tasklist_id=<?php echo $tl['id']; ?>"><?php echo "<li>". $tl['list_name'] ."</li>"; ?></a>
               <a href="deletelist.php?tasklist_id=<?php echo $tl['id']; ?>" >Delete List</a>
            <?php endforeach; ?>
                
            </ul>

        </div>
    </form>


</body>

</html>
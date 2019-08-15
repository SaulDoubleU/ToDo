<?php 
    require_once("bootstrap.php");
    if (isset($_SESSION['username'])) {
        //logged in user
    } else {
        //no logged in user
        header('Location: login.php');
    }
        

    if (!empty($_POST['list'])) {

        $userlist = new Mylist();
        $userlist->setListName($_POST['list']);
        $userId = User::getUserId();


        $listName = $userlist->getListName();
        $userlist->addList($listName, $userId);

        //show data from list
        $userlist = Mylist::getListInfo($userId);
    }
    
    else {
        $error = "All fields must be filled in.";
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
        <h2 class="formTitle">Add New List</h2>

        <div class="formInput">
            <div class="formField">
                <label for="list">List Title</label>
                <input type="text" id="list" name="list" placeholder="list title">
            </div>

            <input type="submit" value="add List" class="btn">

        </div>

         <h2 class="listsTitle">My List</h2>
        <div>

            <ul id="listupdates">

            <?php foreach ($userlist as $u): ?>
               <a href="mytasks.php"><?php echo "<li>". $u['list_name'] ."</li>"; ?></a>
                <?php endforeach; ?>
                
            </ul>

        </div>
    </form>


</body>

</html>
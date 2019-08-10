<?php 
    require_once("bootstrap/bootstrap.php");

    if( !empty($_POST) ){

            $mylist = new Mylist();
            $mylist->setList($_POST['list']);
            
            // naam van de lijst
            $list = $mylist->getList();
        
            // functie oproepen om in db te plaatsen
            $mylist->addList($list);
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

        <div class="redirectLink">
            <a href="index.php"> Go back!</a>
        </div>
    </form>


</body>

</html>
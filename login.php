<?php 
    include_once("bootstrap.php");
    // get user and password from POST
    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        //check if can login 
        $data = $user->CanLogin();
        if($data != false){
            $_SESSION['username'] = $data;
            header('Location: index.php');
        }
        else {
            $error = "Login failed";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>TodoApp - login</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>



<div class="container">

    <div class="logo"><img src="images/logo.svg" alt=""></div>

    <form action="" method="post">

        <?php if( isset($error) ): ?>
            <div class="form__error">
                <p>
                    Sorry, we can't log you in with that email and password. Can you try again?
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
        <label for="email">Email</label>
            <div class="formField">
                <input type="text" id="email" name="email" placeholder="email">
            </div>

            <label for="password">Password</label>
            <div class="formField">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="formbtn">
                <input type="submit" value="Login" class="btn">
            </div>

        </div>

        <div class="redirectLink">
            <p>Not a user yet?<br><br><a href="register.php">Register Now!</a></p>
        </div>
    </form>

</div>
</body>

</html>
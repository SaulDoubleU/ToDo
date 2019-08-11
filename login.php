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
            $_SESSION['user'] = $data;
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
    <title>TodoApp - login</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <form action="" method="post">
        <h2 class="formTitle">Login</h2>

        <?php if( isset($error) ): ?>
            <div class="form__error">
                <p>
                    Sorry, we can't log you in with that email and password. Can you try again?
                </p>
            </div>
        <?php endif; ?>

        <div class="formInput">
            <div class="formField">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="email">
            </div>

            <div class="formField">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>


            <input type="submit" value="Login" class="btn">

        </div>

        <div class="redirectLink">
            <p>Not a user yet? <a href="register.php"> Register Now!</a></p>
        </div>
    </form>


</body>

</html>
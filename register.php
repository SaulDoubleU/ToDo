<?php 

    require_once("bootstrap/bootstrap.php");

    if( !empty($_POST) ){
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        

        try{
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setPasswordConfirmation($passwordConfirm);

            if($user->register()) {
                $user->doLogin($email);
            }

        }
        
        catch( Exception $e){
            $error = $e->getMessage();
        }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="loginContainer">
    <div class="left">
        <form action="" method="post">
            <h2 class="formTitle">Signup</h2>

            <?php if (isset($error)): ?>
            <div class="formError">
                <p>
                    <?php echo $error ?>
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
                    <input type="password" name="password" id="password" placeholder="password">
                </div>

                <div class="formField">
                    <label for="passwordConfirm">Confirm Password</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="password">
                </div>


                <input type="submit" value="Sign up" class="btn">

            </div>

            <div class="redirectLink">
                <p>Already got an account? <a href="login.php"> Go back to login </a></p>
            </div>
        </form>

        </div>

        <div class="right">

        
        </div>
    </div>    
</body>
</html>
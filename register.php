<?php 
    require_once("bootstrap.php");
    include_once("classes/Security.class.php");

    if( !empty($_POST) ){

        $security = new Security();
        $email = $_POST['email'];
        $security->password = $_POST['password'];
        $security->passwordConfirmation = $_POST['passwordConfirm'];
        
        if( $security->passwordsAreSecure() ){

        try{ 
            $user = new User();     
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setPasswordConfirmation($_POST['passwordConfirm']);

            if($user->isAccountAvailable($_POST['email'])){
                $data = $user->register();
                if($data != false) {
                    $_SESSION['username'] = $data;
                    header('location: index.php');
                }else{
                    $error = true;
                }
            }
            else {
                $error = "Email already in use!";
            }
        
    }
    catch(Exception $e) {
        $error = $e->getMessage();
    }
}

else {
    $error = "Your passwords are not secure (min 8 characters) or do not match.";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoApp - Register</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form action="" method="post">
        <h2 class="formTitle">Signup</h2>

         <?php if(isset($error)): ?>
                        <div class="form__error">
                            <p>
                                <?php echo "Something went wrong!"; ?>
                                
                            </p>
                        </div>
                <?php endif; ?>
                <?php if(isset($error)): ?>
                        <div class="form__error">
                            <p>
                              <?php echo $error; ?>
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

            <div class="formField">
                <label for="passwordConfirm">Confirm Password</label>
                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Password">
            </div>


            <input type="submit" value="Sign up" class="btn">

        </div>

        <div class="redirectLink">
            <p>Already got an account? <a href="login.php"> Go back!</a></p>
        </div>
    </form>


</body>

</html>
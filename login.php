<?php 
    require_once("bootstrap/bootstrap.php");
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(User::canLogin($email, $password)){
            User::doLogin($email);
        } else {
            $error = true;
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
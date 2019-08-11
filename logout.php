<?php
    require_once("bootstrap.php");
    setcookie('email', null, time()-3600);
    unset ($_SESSION['email']);
    session_destroy();
    header('location: login.php');
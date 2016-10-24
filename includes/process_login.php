<?php

include_once 'db_connect.php';
include_once 'functions.php';

session_start();

if (isset($_POST['name'], $_POST['pass'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    
    if (login($name, $pass, $mysqli) == true) {
        //Success
        header("Location: ../index.php");
        exit();
    } else {
        //Failure
        header('Location: ../login.php?error=1');
        exit();
    }
} else {
    //Login form vars were not sent
    header('Location: ../error.php?err=Could not process login');
    exit();
}

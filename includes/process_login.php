<?php

include_once 'db_connect.php';
include_once 'functions.php';

session_start();

//Verifies name and password were entered
if (isset($_POST['name'], $_POST['pass'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    
    //Calls login function to verify correct credentials
    if (login($name, $pass, $mysqli) == true) {
        //Success
        header("Location: ../");
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

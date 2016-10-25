<?php
include_once 'config.php';

session_start();

if (isset($_POST['status'])){
    $sql = "UPDATE users SET status = '{$_POST['status']}' WHERE id={$_SESSION['uid']}";
    $conn = mysqli_connect(HOST, USER, PASSWORD);
    if(! $conn ) {
        die('Error: Could not connect to database = ' . mysqli_error());
    }


    mysqli_select_db($conn,DATABASE);
    $retval = mysqli_query( $conn, $sql );

    if(! $retval ) {
        die('Error: Could not update info ' . mysqli_error());
    } else {
        header("Location: ../people/{$_SESSION['name']}");
        exit();
    }
} else {
    header("Location: ../error.php?error=Incorrect data");
    exit();
}

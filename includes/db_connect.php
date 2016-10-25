<?php
//Was originally going to use this to hold the db connection, now its just here. Will end up changing it.

include_once 'config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

function query($sql){
    $conn = mysqli_connect(HOST, USER, PASSWORD);
    if (!$conn) {
        die('Error: Could not connect to database ' . mysqli_error());
    }

    mysqli_select_db($conn,DATABASE);
    $retval = mysqli_query($conn,$sql);

    if (!$retval) {
        die('Error: Could not process sql request '.mysqli_error());
    }

    return $retval;
}

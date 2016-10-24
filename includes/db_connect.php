<?php
//Was originally going to use this to hold the db connection, now its just here. Will end up changing it.

include_once 'config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
    header("Location: ../error.php?err=Unable to connect to MySQL");
    exit();
}

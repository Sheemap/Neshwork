<?php
include_once 'config.php';
include_once 'db_connect';
include_once 'functions.php';

session_start();

$error_msg = "";

if (isset($_POST['pass'], $_POST['name'])){

    if ($_POST['pass'] != $_POST['cnfpass']){
        $error_msg .= "<p class='error'>Password and confirmation do not match!</p>";
    } else {

        $name = $_POST['name'];
        $prepass = $_POST['pass'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $conn = mysqli_connect(HOST, USER, PASSWORD);


        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
   
        $sql1 = "SELECT name FROM users";
        $sql = "INSERT INTO users(id, name, pass ) VALUES ( NULL, '$name', '$pass' )";
      
        mysqli_select_db($conn,DATABASE);
        $retval1 = mysqli_query( $conn, $sql1 );
  
        if(! $retval1 ) {
           die('Could not enter data:' . mysqli_error());
        }


        while($row = mysqli_fetch_array($retval1)) {
            if($row['name']==$name){
                $cname = true;
        $error_msg .= "<p class='error'>There is already a user with that name! Please choose another.</p>";
            }
        }


        if($cname!==true){
            $retval = mysqli_query( $conn, $sql );
            if(! $retval ) {
                die('Could not enter dat: ' . mysqli_error());
            }
            login($name,$prepass,$mysqli);
            header("Location: reg_success.html");
            exit(); 
        }
   
   
        mysqli_close($conn);
    }
}
?>

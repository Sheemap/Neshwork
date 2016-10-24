<?php
include_once 'config.php';
include_once 'db_connect';
include_once 'functions.php';

session_start();

$error_msg = "";

if (isset($_POST['pass'], $_POST['name'])){

    if ($_POST['pass'] != $_POST['cnfpass']){
        $error_msg .= "<p class='error'>Password and confirmation do not match!</p>";
    }
    
    if (preg_match('/\s/',$_POST['name'])){
        $error_msg .= "<p class='error'>Username must not contain any whitespace.</p>";
    }

    if (strlen($_POST['name']) > 15){
        $error_msg .= "<p class='error'>Username is too long! Please limit to 15 characters.</p>";
    }

        if (empty($errormsg)) {

            $name = $_POST['name'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $conn = mysqli_connect(HOST, USER, PASSWORD);
            
            if (strlen($_POST['pass']) < 8){
                $error_msg .= "<p class='error'>Password must be at least 8 characters.</p>";
            }

            if(! $conn ) {
                die('Error: Could not connect to database ' . mysqli_error());
            }
   
            $sql1 = "SELECT name FROM users";
            $sql = "INSERT INTO users(id, name, pass ) VALUES ( NULL, '$name', '$pass' )";
      
            mysqli_select_db($conn,DATABASE);
            $retval1 = mysqli_query( $conn, $sql1 );
  
            if(! $retval1 ) {
                die('Error: Could not check username' . mysqli_error());
            }


            while($row = mysqli_fetch_array($retval1)) {
                if(strtolower($row['name'])==strtolower($name)){
                    $error_msg .= "<p class='error'>There is already a user with that name! Please choose another.</p>";
                }
            }


            if(empty($error_msg)){
                $retval = mysqli_query( $conn, $sql );
                if(! $retval ) {
                    die('Error: Could not enter data ' . mysqli_error());
                }
                login($name,$_POST['pass'],$mysqli);
                header("Location: reg_success.html");
                exit(); 
            }
        }   

   
        mysqli_close($conn);
    
}
?>

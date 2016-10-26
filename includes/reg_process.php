<?php
include_once 'config.php';
include_once 'db_connect';
include_once 'functions.php';

session_start();

//Reset error messages
$error_msg = "";
$now = time();

//Verify fields were filled
if (isset($_POST['pass'], $_POST['name'], $_POST['cnfpass'])){

    //Verify correct pass was entered twice
    if ($_POST['pass'] != $_POST['cnfpass']){
        $error_msg .= "<p class='error'>Password and confirmation do not match!</p>";
    }
    
    //Check for whitespace in username
    if (preg_match('/\s/',$_POST['name'])){
        $error_msg .= "<p class='error'>Username must not contain any whitespace.</p>";
    }

    if (preg_match("/'/",$_POST['name']) or preg_match('/"/',$_POST['name'])){
        $error_msg .= "<p class='error'>Username must not contain any apostrophes or quotes.</p>";
    }

    //Force username less thn 15 chars
    if (strlen($_POST['name']) > 15){
        $error_msg .= "<p class='error'>Username is too long! Please limit to 15 characters.</p>";
    }

        //Continues if no error was found
        if (empty($errormsg)) {

            $name = $_POST['name'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $conn = mysqli_connect(HOST, USER, PASSWORD);
            
            //Forces pass to be at least 8 chars
            if (strlen($_POST['pass']) < 8){
                $error_msg .= "<p class='error'>Password must be at least 8 characters.</p>";
            }

            if(! $conn ) {
                die('Error: Could not connect to database ' . mysqli_error());
            }
   
            $sql1 = "SELECT name FROM users";
            $sql = "INSERT INTO users(id, name, pass, lastseen, status, msgcount, joined) VALUES ( NULL, '$name', '$pass', $now, '', 0, NOW())";
      
            mysqli_select_db($conn,DATABASE);
            $retval1 = mysqli_query( $conn, $sql1 );
  
            if(! $retval1 ) {
                die('Error: Could not check username' . mysqli_error());
            }

            //Checks if username is already in use
            while($row = mysqli_fetch_array($retval1)) {
                if(strtolower($row['name'])==strtolower($name)){
                    $error_msg .= "<p class='error'>There is already a user with that name! Please choose another.</p>";
                }
            }

            //Actually enters data if no error was found
            if(empty($error_msg)){
                $retval = mysqli_query( $conn, $sql );
                if(! $retval ) {
                    die('Error: Could not enter data ' . mysqli_error());
                }
                //Auto logs the user in and reroutes to the success landing page
                login($name,$_POST['pass'],$mysqli);
                header("Location: reg_success.html");
                exit(); 
            }
        }   

   
        mysqli_close($conn);
    
}
?>

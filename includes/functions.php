<?php
include_once 'config.php';

function login($name, $pass, $mysqli) {
    //Search DB for matching user. Grab UID and pass hash
    $conn = mysqli_connect(HOST, USER, PASSWORD);
    if(! $conn ) {
        die('Error: Could not connect to database ' . mysqli_error());
    }
    
    $sql = "SELECT name, pass FROM users";
      
    mysqli_select_db($conn,DATABASE);
    $retval = mysqli_query( $conn, $sql );
   
    if(! $retval ) {
        die('Error: Could not fetch database credentials ' . mysqli_error());
    }

    while($row = mysqli_fetch_array($retval)) {
        if(strtolower($row['name'])==strtolower($name)){
            $cname = true;
            if(password_verify($pass,$row['pass'])){
                //Correct login, initiate session

                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['uid'] = $row['id'];
                $_SESSION['login_string'] = hash('sha512', $db_pass . $user_browser);
                $_SESSION['user'] = $row['name'];
                return true;
            } else {
                //Incorrect password
                /*$now = time();
                $sql1 = "INSERT INTO login_attempts(user_id, time) VALUES ('$uid', '$now')";
                $retval1 = mysqli_query($conn, $sql1);

                if(! $retval1) {
                    die('Could not enter data: ' . mysqli_error());
                }*/
                
                return false;
            }
        } 
    }
    if($cname!=true){
        //No such user
        return false;
    }
   
   
    mysqli_close($conn);
        
        
}


function login_check($mysqli) {
    //Verify all session vars are set
    if (isset($_SESSION['uid'], $_SESSION['user'], $_SESSION['login_string'])) {
        $uid = $_SESSION['uid'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['user'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $sql = "SELECT pass FROM users WHERE id=$uid LIMIT 1";

        $conn = mysqli_connect(HOST, USER, PASSWORD);
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }


        mysqli_select_db($conn,DATABASE);
        $retval = mysqli_query( $conn, $sql );

        if(! $retval ) {
            die('Could not enter data: ' . mysqli_error());
        }
   
        $hashpass = mysqli_fetch_row($retval);

        $login_check = hash('sha512', $hashpass['pass'] . $user_browser);
            
        if ($login_check == $login_string) {
            // Logged in
            return true;
        } else {
            //Not logged in
            return false;
        }

    } else {
        //Not logged in
        return false;
    }
}

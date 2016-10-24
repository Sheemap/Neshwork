<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();
?>

<!DOCTYPE html>
<html>
<body>

<!-- Basic login form. Passes info to includes/process_login.php -->

<form action="includes/process_login.php" method="post"> 
 Username: <input type="text" name="name"><br> 
 Password: <input type="password" name="pass" id="password"><br> 
<!-- Remember Me: <input type="checkbox" name="rememberme" value="1"<br>-->
 <input type="submit" value="Login"> 
</form> 


</body>
</html> 

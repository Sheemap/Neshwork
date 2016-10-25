<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
<body>

<!-- Basic login form. Passes info to includes/process_login.php -->

<?php
if (isset($_GET['error'])){
    echo "<p class='error'>Wrong usernme or password</p>";
}
?>

<form id="loginform" action="includes/process_login.php" method="post"> 
<p>
<label for="name">Username</label><br>
<input class="textbox" type="text" name="name"> 
</p>
<p>
<label for="pass">Password</label><br>
<input class="textbox" type="password" name="pass" id="password"> 
</p>
<!-- Remember Me: <input type="checkbox" name="rememberme" value="1"<br>-->
<input class="button" type="submit" value="Login"> 
</form> 


</body>
</html> 

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Neshwork - Login</title>
<link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
<body>

<p id="header">
  <a id="logo" href="/"><img src="img/logo.png" alt="Neshwork"/></a>

<?php
if (login_check($mysqli) == true) {

echo <<< EOT
  <span class="topright">
    <a href="people/{$_SESSION['name']}"><img src="img/profile.png" alt="Profile"/></a>
    <a href="logout"><img src="img/logout.png" alt="Logout"/></a>
  </span>
EOT;

} else {

echo <<< EOT
  <span class="topright">
    <a href="login"><img src="img/login.png" alt="Log In"/></a>
    <a href="register"><img src="img/signup.png" alt="Sign Up"/></a>
  </span>
EOT;

}
?>
</p>
<hr>

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

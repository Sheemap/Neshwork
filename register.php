<?php
include_once 'includes/reg_process.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Neshwork - Sign Up</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
//Prints any errors found 
if (!empty($error_msg)) {
    echo $error_msg;
}
?>

<!-- Basic form. All the actual work is handled by includes/reg_process.php -->

<p id="header">
  <a id="logo" href="/"><img src="img/logo.png" alt="Neshwork"/></a>

<?php
if (login_check($mysqli) == true) {

header("Location: /?err=Please logout to register a new account");
exit();

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

<form id="signupform" method="post" name="registration_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>
<label for="name">Username</label><br>
<input class="textbox" type="text" name="name">
</p>
<p>
<label for="pass">Password</label><br>
<input class="textbox" type="password" name="pass" id="password">
</p>
<p>
<label for="cnfpass">Confirm Password</label><br>
<input class="textbox" type="password" name="cnfpass" id="cnfpassword">
</p>
<input class="button" type="submit" value="Sign Up"/>
</form>

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

//Currently this whole files is pretty much only used for debugging

session_start();
print $_SESSION['user']."\n";
print $_SESSION['login_string']."\n";
print $_SESSION['uid']."\n";
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Neshwork</title>
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
    <a href="includes/logout"><img src="img/logout.png" alt="Logout"/></a>
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


<p>If you don't have a login, please <a href="register.php">register</a>.</p>
<p>If you are done, please <a href="includes/logout.php">log out</a>.</p>
<p>You are currently logged <?php echo $logged ?>.</p>
<p>Here you can <a href="login.php">login</a>.</p>
<p><a href="waow.php">test</a>

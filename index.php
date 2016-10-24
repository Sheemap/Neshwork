<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();
print $_SESSION['user'].'\n';
print $_SESSION['login_string'].'\n';
print $_SESSION['uid'].'\n';
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home page of amazing</title>
</head>
<body>

<p>If you don't have a login, please <a href="register.php">register</a>.</p>
<p>If you are done, please <a href="includes/logout.php">log out</a>.</p>
<p>You are currently logged <?php echo $logged ?>.</p>
<p>Here you can <a href="login.php">login</a>.</p>

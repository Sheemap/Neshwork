<?php
include_once 'includes/reg_process.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration</title>
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
<input class="button" type="submit" value="Register"/>
</form>

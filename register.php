<?php
include_once 'includes/reg_process.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration</title>
</head>
<body>
<h1>Register</h1>

<?php
//Prints any errors found 
if (!empty($error_msg)) {
    echo $error_msg;
}
?>

<!-- Basic form. All the actual work is handled by includes/reg_process.php -->

<form method="post" name="registration_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
Username: <input type="text" name="name"><br>
Password: <input type="password" name="pass" id="password"><br>
Confirm password: <input type="password" name="cnfpass" id="cnfpassword"><br>
<input type="submit" value="Register"/>
</form>

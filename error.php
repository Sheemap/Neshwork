<?php
include_once 'includes/functions.php';

$error = $_GET['err'];

if (! $error) {
    $error = 'Oops! An unknown error happened.';
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

<h2 align="center">There was a problem</h2>
<p class="error"><?php echo $error; ?></p>
</body>
</html>

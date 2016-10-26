<?php
//This wipes the SESSION variables and destroys the cookie. It then routes them to index.php, and they are logged out.

session_start();

$_SESSION = array();

session_destroy();
header("Location: /");
exit();

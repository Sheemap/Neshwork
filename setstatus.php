<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();

if (login_check($mysqli) != true){
    header("Location: error.php?=You must be logged in to see this");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Neshwork- Set Status</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>


<p id="header">
  <a id="logo" href="/"><img src="img/logo.png" alt="Neshwork"/></a>
  <span class="topright">
    <a href="people/{$_SESSION['name']}"><img src="img/profile.png" alt="Profile"/></a>
    <a href="includes/logout"><img src="img/logout.png" alt="Logout"/></a>
  </span>

<?php
$sql = "SELECT id, status FROM users WHERE id=$uid LIMIT 1";

$conn = mysqli_connect(HOST, USER, PASSWORD);
if(! $conn ) {
    die('Error: Could not connect to database = ' . mysqli_error());
}


mysqli_select_db($conn,DATABASE);
$retval = mysqli_query( $conn, $sql );

/*if(! $retval ) {
    die('Error: Could not fetch current status ' . mysqli_error());
}*/

$db_status = mysqli_fetch_row($retval);

if (isset($db_status['status'])){
    echo <<<EOT
    <h2>Change Your Status</h2>
    <p>Current status: $db_status</p>
    <p>Statuses must be under 256 characters</p>

    <form id="statusform" action="includes/change_status.php" method="post">
    <p>
    <label for="status">Enter new status</label><br>
    <input class="textbox" type="text" name="status">
    </p>
    <input class="button" type="submit" value="Submit">
    </form>
EOT;

} else {
    echo <<<EOT
    <h2>Set Your Status</h2>
    <p>Statuses must be under 256 characters

    <form id="statusform" action="includes/change_status.php" method="post">
    <p>
    <label for="status">Enter new status</label><br>
    <input class="textbox" type="text" name="status">
    </p>
    <input class="button" type="submit" value="Submit">
    </form>
EOT;
}


<?php
include_once 'includes/config.php';
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

session_start();

$now = time();
$cname = false;

if (isset($_GET['person'])){
    $name = $_GET['person'];

    //Check if logged in
    if (login_check($mysqli) == true) {
        $loggedin = true;
        //Check if logged in user is owner of profile
        if ($_SESSION['name'] == $name){
            $own = true;
        } else {
        $own = false;
        }
    } else {
        $own = false;
    }

    $conn = mysqli_connect(HOST, USER, PASSWORD);
    if(! $conn ) {
        die('Error: Could not connect to database ' . mysqli_error());
    }

    $sql = "SELECT * FROM users";

    mysqli_select_db($conn,DATABASE);
    $retval = mysqli_query( $conn, $sql );

    if(! $retval ) {
        die('Error: Could not fetch database credentials ' . mysqli_error());
    }

    //$sql = "SELECT * FROM users";
    //query($sql);

    //Checks for matching username
    while($row = mysqli_fetch_array($retval)) {
        error_log($row['name']);
        if(strtolower($row['name'])==strtolower($name)){
            $cname = true;
            $db_seen = $row['lastseen'];
            $timeago = ($now - $db_seen);

            if ($timeago < 60){
                $lastseen = "less than a minute ago";
            } elseif ($timeago < 3600){
                if (floor($timeago /60) == 1){
                    $lastseen = floor($timeago / 60) ." minute ago";
                } else {
                    $lastseen = floor($timeago / 60) ." minutes ago";
                }
            } elseif ($timeago < 86400){
                if (floor($timeago /3600) == 1){
                    $lastseen = floor($timeago / 3600) ." hour ago";
                } else {
                    $lastseen = floor($timeago / 3600) ." hours ago";
                }
            } else {
                if (floor($timeago /86400) == 1){
                    $lastseen = floor($timeago / 86400) ." day ago";
                } else {
                    $lastseen = floor($timeago / 86400) ." days ago";
                }
            }

            $msg = $row['msgcount'];
            if ($row['status'] != ''){
                if ($own == true){
                    $status = "<p class='status'>".$row['status']."<br><font size='6'><i><a href='../setstatus'>Click to change</a></i></font></p>";
                } else {
                    $status = "<p class='status'>".$row['status']."</p>";
                }
            } else {
                if ($own == true){
                    $status = "<p class='status'><i>You have not set a status yet! <a href='../setstatus'>Click here to set one now.</a></i></p>";
                } else {
                    $status = "<p class='status'><i>This user has not set a status yet.</i></p>";
                }
            }
         
            $joined = $row['joined'];
        } 
    }
      
    if ($cname != true){
        header("Location: ../error.php?err=No such user exists!");
        exit();
    }
    
    
} else {
    //No user in url
    header("Location: ./error.php?err=No user selected!");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<?php echo "<title>$name's Profile</title>"; ?>
<link rel="stylesheet" type="text/css" href="../style.css"/>
</head>
<body>


<p id="header">
  <a id="logo" href="/"><img src="../img/logo.png" alt="Neshwork"/></a>

<?php
if ($loggedin == true) {

echo <<<EOT
  <span class="topright">
    <a href="../people/{$_SESSION['name']}"><img src="../img/profile.png" alt="Profile"/></a>
    <a href="../logout"><img src="../img/logout.png" alt="Logout"/></a>
  </span>
EOT;

} else {

echo <<<EOT
  <span class="topright">
    <a href="../login"><img src="../img/login.png" alt="Log In"/></a>
    <a href="../register"><img src="../img/signup.png" alt="Sign Up"/></a>
  </span>
EOT;

}
?>
</p>

<?php 
echo <<<EOT
<h1>$name's profile</h1>
<p><i>Last seen $lastseen</i></p>
<h3>Status</h3>
$status
<h3>Statistics</h3>
<p>
Member since: $joined
<br>
Message count: $msg

</p>
EOT;
?>


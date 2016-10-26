<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

//Currently this whole files is pretty much only used for debugging

session_start();
/*print $_SESSION['name']."\n";
print $_SESSION['login_string']."\n";
print $_SESSION['uid']."\n";
*/
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
} else {
    $msg = "";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Neshwork</title>
<link rel="stylesheet" type="text/css" href="style.css"/>

<script>
function updateChat() {
   if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState === XMLHttpRequest.DONE && xmlhttp.status === 200) {
                document.getElementById("msgs").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET","includes/getmessages.php","true");
    xmlhttp.send();
}
</script>

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

<?php
if (isset($_GET['err'])){
    echo "<p class='error'>{$_GET['err']}</p>";
}
?>

<span id="posthead">Say something:</span><br/>
<form id="postform" action="includes/send_msg.php" method="post">
  <textarea name="msg" rows="5" cols="40"><?php echo $msg; ?></textarea><br/>
  <button type="submit">Post</button>
</form>

<script>
updateChat();
window.setInterval(function(){
    updateChat();
}, 5000);
</script>
<div id="msgs"></div>

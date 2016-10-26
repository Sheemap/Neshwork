<?php
include_once 'config.php';


$conn = mysqli_connect(HOST,USER,PASSWORD);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,DATABASE);
$sql="SELECT * FROM msgs ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

$amount = 1;
while($row = mysqli_fetch_array($result)) {
    if ($amount <= 50){
        $amount = $amount +1;
        $timeago = time() - $row['timestamp'];

        if ($timeago < 60){
            $timestamp = "less than a minute ago";
        } elseif ($timeago < 3600){
            $timestamp = floor($timeago / 60) ." minutes ago";
        } elseif ($timeago < 86400){
            $timestamp = floor($timeago / 3600) ." hours ago";
        } else {
            $timestamp = floor($timeago / 86400) ." days ago";
        }
    
        echo "<p class='message'>";
        echo "<a href='people/{$row['name']}'>{$row['name']}</a> <i class='timestamp'>$timestamp</i>";
        echo "<br>{$row['msg']}";
        echo "</p>";
    }
}

mysqli_close($conn);
?>

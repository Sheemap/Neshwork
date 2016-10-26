<?php
include_once 'functions.php';

session_start();

$msg = addslashes($_POST['msg']);

if (preg_replace('/\s/','',$msg) != ""){
    
    
    if (strlen($msg) <= 255) {
        if (isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            if (login_check($uid) == true){
                send_msg($uid,$msg);
            } else {
                send_msg(0,$msg);
            }
        } else {
            send_msg(0,$msg);
        }
    } else {
        header("Location: /?err=Messages must be under 255 characters&msg=$msg");
        exit();
    }
} else {
    header("Location: /?err=Cannot send a blank message!");
    exit();
}
header("Location: /");
exit();

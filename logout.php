<?php
    require('config.php');
    session_start();
    $_SESSION = array();
    session_destroy();
    setcookie("notice","Logout Successful.", time() + (86400 * 1), "/");
    setcookie("notice-x","x", time() + (86400 * 1), "/");
    header("location: ".$base);
?>
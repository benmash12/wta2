<?php
    session_start();
	include('config.php');
    if(isset($_GET['id']) && isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != ""){
        $id = $db -> real_escape_string(stripcslashes($_GET['id']));
        $que = "DELETE FROM product WHERE id='$id';";
        if($res = $db -> query($que)){
            setcookie("notice","Product deleted successfully.", time() + (86400 * 1), "/");
            setcookie("notice-x",".", time() + (86400 * 1), "/");
            header('Location: '.$base);
        }
        else{
            setcookie("notice","An error was encountered.", time() + (86400 * 1), "/");
            header('Location: '.$base);
        }
    }
    else{
        setcookie("notice","Access Denied.", time() + (86400 * 1), "/");
        if(!(isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != "")){
            session_destroy();
        }
        header('Location: '.$base);
    }
?>
<?php
	session_start();
	include('config.php');
    if(isset($_POST['update_product'])){
		$n = $_POST['name'];
		$q = $_POST['quantity'];
		$i = $_POST['id'];
		$err = array();
		if($n == "" || $q == "" || !(is_numeric($i))){
			array_push($err, "All fields are required.");
		}
		if(preg_match_all("/[^a-zA-Z0-9\-_\s]/",$n) != 0){
			array_push($err, "Please do not include special characters in name.");
		}
		if(intval($q) < 0){
			array_push($err, "Quantity cannot be less than zero.");
		}
		if(count($err) > 0){
			setcookie("notice",join("<br>",$err), time() + (86400 * 1), "/");
			header('Location: '.$_SERVER['PHP_SELF']."?id=".$i);
		}
		else{
			$n = $db -> real_escape_string(stripcslashes($n));
			$q = $db -> real_escape_string(stripcslashes($q));
			$i = $db -> real_escape_string(stripcslashes($i));
			date_default_timezone_set('Asia/Kolkata');
   			$l = date('d M, Y')." at ".date('g:i A');
			$l = $db -> real_escape_string($l);
			$que = "UPDATE product SET name='$n', quantity='$q', last_modified='$l' WHERE id='$i'";
			if($db -> query($que)){
				setcookie("notice","Product updated successfully.", time() + (86400 * 1), "/");
				setcookie("notice-x",".", time() + (86400 * 1), "/");
				header('Location: '.$_SERVER['PHP_SELF']."?id=".$i);
			}
			else{
				setcookie("notice","A server error occurred. Please try again later.", time() + (86400 * 1), "/");
				header('Location: '.$_SERVER['PHP_SELF']."?id=".$i);
			}
		}
	}
    if(!(isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != "")){
        setcookie("notice","Access Denied! Please login first.", time() + (86400 * 1), "/");
		session_destroy();
		header('Location: '.$base);
    }
    if(!isset($_GET['id'])){
        setcookie("notice","Access Denied!", time() + (86400 * 1), "/");
        header('Location: '.$base);
    }
    else{
        $id = $db -> real_escape_string(stripcslashes($_GET['id']));
        $que = "SELECT * FROM product WHERE id='$id';";
        if($res = $db -> query($que)){
            $l = $res -> num_rows;
            if($l == 1){
                $user = $res->fetch_array(MYSQLI_BOTH);
                $name = $user["name"];
                $quantity = $user["quantity"];
            }
            else{
                setcookie("notice","Product could not be fetched.", time() + (86400 * 1), "/");
                header('Location: '.$base);
            }
        }
        else{
            setcookie("notice","Server Error... Please try again", time() + (86400 * 1), "/");
                header('Location: '.$base);
        }
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Update Product: <?php echo $name; ?> | Web Technology Assignment 2</title>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="frameworks/jquery/jquery-3.4.1.min.js"></script>
        <script src="frameworks/popper/popper.min.js"></script>
        <link rel="stylesheet" href="frameworks/bootstrap/css/bootstrap.min.css">
        <script src="frameworks/bootstrap/js/bootstrap.min.js"></script>
        <link href="frameworks/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <?php includeWithVariables('header.php',array('title' =>'')); ?>
		<div id="my_login_cont" class="contx">
		<h1 class="heading">Update Product: <?php echo $name; ?></h1>
		<br>
		<?php include("notice.php"); ?>
		<form action="?id=<?php echo $id; ?>" name="add_form" id="addform" method="post">
			<div class="inp">
				<label for="name"><i class="fa fa-pencil"></i></label>
				<input value="<?php echo $name; ?>" maxlength="100" placeholder="Name" type="text" name="name" id="pr_name">
			</div>
			<div class="inp">
				<label for="quantity"><i class="fa fa-th"></i></label>
				<input value="<?php echo $quantity; ?>" maxlength="11" min="0" placeholder="Quantity" type="number" name="quantity" id="pr_quantity">
			</div>
			<input value="<?php echo $id; ?>" type="hidden" name="id">
			<div class="padten">
				<input class="btn btn-success mar5" name="update_product" type="submit" value="Update Product">
				<a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>" class="btn btn-info">View Products</a>
			</div>
		</form>
	</div>
    </body>
</html>
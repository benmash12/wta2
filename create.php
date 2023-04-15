<?php
	session_start();
	include('config.php');
    if(isset($_POST['add_product'])){
		$n = $_POST['name'];
		$q = $_POST['quantity'];
		$err = array();
		if($n == "" || $q == ""){
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
			header('Location: '.$_SERVER['PHP_SELF']);
		}
		else{
			$n = $db -> real_escape_string(stripcslashes($n));
			$q = $db -> real_escape_string(stripcslashes($q));
			date_default_timezone_set('Asia/Kolkata');
   			$l = date('d M, Y')." at ".date('g:i A');
			$l = $db -> real_escape_string($l);
			$que = "INSERT INTO product(name,quantity,last_modified) VALUES('$n','$q','$l')";
			if($db -> query($que)){
				setcookie("notice","Product added successfully.", time() + (86400 * 1), "/");
				setcookie("notice-x",".", time() + (86400 * 1), "/");
				header('Location: '.$base);
			}
			else{
				setcookie("notice","A server error occurred. Please try again later.", time() + (86400 * 1), "/");
				header('Location: '.$_SERVER['PHP_SELF']);
			}
		}
	}
    if(!(isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != "")){
        setcookie("notice","Access Denied! Please login first.", time() + (86400 * 1), "/");
		session_destroy();
		header('Location: '.$base);
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Add Product | Web Technology Assignment 2</title>
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
        <?php includeWithVariables('header.php',array('title' =>'ap')); ?>
		<div id="my_login_cont" class="contx">
		<h1 class="heading">Add Product</h1>
		<br>
		<?php include("notice.php"); ?>
		<form action="?" name="add_form" id="addform" method="post">
			<div class="inp">
				<label for="name"><i class="fa fa-pencil"></i></label>
				<input maxlength="100" placeholder="Name" type="text" name="name" id="pr_name">
			</div>
			<div class="inp">
				<label for="quantity"><i class="fa fa-th"></i></label>
				<input maxlength="11" min="0" placeholder="Quantity" type="number" name="quantity" id="pr_quantity">
			</div>
			
			<div class="padten">
				<input class="btn btn-success mar5" name="add_product" type="submit" value="Add Product">
				<a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>" class="btn btn-danger">Cancel</a>
			</div>
		</form>
	</div>
    </body>
</html>
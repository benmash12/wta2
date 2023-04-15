<?php
	session_start();
	include('config.php');
    if(isset($_POST['login'])){
		$un = $db -> real_escape_string(stripcslashes($_POST['username']));
		$pw = $db -> real_escape_string(stripcslashes($_POST['password']));
		$que = "SELECT * FROM admin WHERE username='$un';";
		$err = array();
		if($un == "" || $pw == ""){
			array_push($err, "All fields are required.");
		}
		if(preg_match_all("/[^a-zA-Z0-9\-_]/",$un) != 0){
			array_push($err, "Please do not include special characters or spaces in username.");
		}
		if(count($err) > 0){
			setcookie("notice",join("<br>",$err), time() + (86400 * 1), "/");
			header('Location: '.$base);
		}
		else{
			if($res = $db -> query($que)){
				$l = $res -> num_rows;
				if($l == 1){
					$user = $res->fetch_array(MYSQLI_BOTH);
					if(p_ver($pw,$user["password"])){
						session_start();
						$_SESSION['admin'] = $user["username"];
						header('Location: '.$base);
					}
					else{
						setcookie("notice","Wrong Username or Password", time() + (86400 * 1), "/");
						header('Location: '.$base);
					}
				}
				else{
					setcookie("notice","Wrong Username or Password", time() + (86400 * 1), "/");
					header('Location: '.$base);
				}
			}
			else{
				setcookie("notice","Server Error... Please try again", time() + (86400 * 1), "/");
					header('Location: '.$base);
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Web Technology Assignment 2</title>
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
	<?php
		includeWithVariables('header.php',array('title' =>'db'));
	?>
	<?php 
		
		if(isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != ""){
			
			$que = "SELECT * FROM product ORDER BY id DESC;";
			if($res = $db -> query($que)){
				$l = $res -> num_rows;
				if($l > 0){
					?>
	<div id="my_login_cont" class="contx cont-v">
		<p id="welcome">Welcome back, <?php echo $_SESSION["admin"];?> !</p>
		<br>
		<h1 class="heading">Products (<?php echo $l; ?>)</h1>
		<?php include("notice.php"); ?>
		<div class="tabcont horizon">
			<table class="table titi table-bordered">
				<tr>
					<th>S/N</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Last Updated</th>
					<th>Action</th>
				</tr>
				<?php
				$k = 1;
				while($r = mysqli_fetch_array($res)){
					$m = '<a href="update.php?id='.$r['id'].'" class="btn mar5 btn-info btn-xs">Update</a><button onclick="deleteProd('.$r['id'].')" class="btn mar5 btn-danger btn-xs">Delete</button>';
					echo "<tr>";
					echo "<td>".($k++)."</td>";
					echo "<td>".$r['name']."</td>";
					echo "<td>".$r['quantity']."</td>";
					echo "<td>".$r['last_modified']."</td>";
					echo "<td>".$m."</td>";
					echo "/<tr>";
				}
				
				?>
			</table>
		</div>
	</div>
					<?php
				}
				else{
					?>
	<div id="my_login_cont" class="contx">
		<p id="welcome">Welcome back, <?php echo $_SESSION["admin"];?> !</p>
		<h1 class="heading">Products</h1>
		<?php include("notice.php"); ?>
		<div class="my-err myerr_act myerr_gx">
			<span class="txt">
				Products have not been added yet. Please click on "Add Product" on the header to add products.
			</span>
		</div>
	</div>

					<?php
				}
			}
			else{
				?>
	<div id="my_login_cont" class="contx">
		<p id="welcome">Welcome back, <?php $_SESSION["admin"] ?></p>
		<h1 class="heading">Products</h1>
		<?php include("notice.php"); ?>
		<div class="my-err myerr_act ">
			<span class="txt">
				A database error was encountered. Products could not be fetched
			</span>
		</div>
	</div>
				<?php
			}
	?>
	<?php 
		}
		else{
	?>
	<div id="my_login_cont" class="contx">
		<h1 class="heading">Login</h1>
		<br>
		<?php include("notice.php"); ?>
		<form action="?" name="login_form" id="loginform" method="post">
			<div class="inp">
				<label for="username"><i class="fa fa-user"></i></label>
				<input maxlength="100" placeholder="Username" type="text" name="username" id="username">
			</div>
			<div class="inp">
				<label for="password"><i class="fa fa-lock"></i></label>
				<input maxlength="100" placeholder="********" type="password" name="password" id="password">
			</div>
			<div class="padten">
			<input class="btn btn-default " name="login" type="submit" value="Login">
			</div>
			<span onclick="forgotPass()" class="tc padten"><strong class="text f16 tc cur">Forgot Password? | Register</strong></span>
		</form>
	</div>
	<?php 
		}
	?>
</body>
</html>
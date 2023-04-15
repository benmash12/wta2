<?php include('preloader.php'); ?>
<header>
		<div class="logo">
			<img src="img/logo.png" alt="Logo">
		</div>
		<nav class="nav">
			<?php 
				if(isset($_SESSION["admin"]) && $_SESSION["admin"] != NULL && $_SESSION["admin"] != ""){
			?>
				<a class="<?php if($title == "db") echo "active"; ?>" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
				<a class="<?php if($title == "ap") echo "active"; ?>" href="create.php"><i class="fa fa-plus-circle"></i> <span>Add Product</span></a>
				<a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout </span></a>
			<?php 
				}
				else{
					?>
				<a class="<?php if($title == "db") echo "active"; ?>" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>"><i class="fa fa-home"></i> <span>Home</span></a>
					<?php

				}
			?>
			<a class="<?php if($title == "ab") echo "active"; ?>" href="about.php"><i class="fa fa-question-circle"></i> <span>About </span></a>
		</nav>
	</header>
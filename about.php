<?php
	session_start();
	include('config.php');
    
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>About | Web Technology Assignment 2</title>
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
        <?php includeWithVariables('header.php',array('title' =>'ab')); ?>
		<div id="my_login_cont" class="contx">
		<h1 class="heading">About </h1>
		<p class="text">
            This website was developed by Gbiang Benedict Mashingil (TD1 92000104015) for  Web Technology Assignment 2 (Home with login using sessions and cookies, CRUD for product management system) 2022/2023 Academic session.
            <br><br>
            Admin login details are: <br>
            Username: root <br>
            Password (Case sensitive): Admin123#
            <br><br>
        </p>
	</div>
    </body>
</html>
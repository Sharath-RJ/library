<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <link rel="stylesheet" href="admin.css"> -->
     <link rel="stylesheet" href="header.css">
     
		<style>
			@media screen and (max-width: 992px) {
           .main-container {
                display: block;
				width:80%;
               }
           }
		</style>
</head>
<body>
	<?php

include 'database_connection.php';
include 'function.php';


?>

<div class="main-container">
	
 <div class="stud">
		<div class="container">
		<div class="card">
			<div class="slide slide1">
				<div class="content">
					<div class="icon">
						<!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
					<h2>ADMIN LOGIN</h2>
					</div>
				</div>
			</div>
			<div class="slide slide2">
				<div class="content">
					<div class="login_btn">
						<a href="admin_login.php"><h4>Login</h4></a>
					</div>
					<!-- <p>Trust yourself and keep going.</p> -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="admin">
		<div class="container">
		<div class="card">
			<div class="slide slide1">
				<div class="content">
					<div class="icon">
					<h2>STUDENT LOGIN</h2>	
					<!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
					
					</div>
				</div>
			</div>
			<div class="slide slide2">
				<div class="content">
					<div class="login_btn">
						<a href="user_login.php"><h4>Login</h4></a>

					</div>
					<!-- <p>Trust yourself and keep going.</p> -->
				</div>
			</div>
		</div>
	</div>
</div> 
</div>


	




	<?php


// <a href="user_login.php" class="btn btn-outline-secondary">User Login</a>

// 			<a href="user_registration.php" class="btn btn-outline-primary">User Sign Up</a>
// 			<a href="admin_login.php" class="btn btn-outline-light">Admin Login</a>
?>
</body>
</html>
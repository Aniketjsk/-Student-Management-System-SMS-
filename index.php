<?php
error_reporting(0);
session_start();
session_destroy();
if ($_SESSION['message']) {
	$message=$_SESSION['message'];
	echo "<script type='text/javascript'>
	alert('Your application was sent successfully!');</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home Page</title>
	<style type="text/css">
		.navbar{
			width: 100%;
			height: 50px;
			border: 1px solid;
			background-color: skyblue;
		}
		.logo{
			width: 50%;
			height: 50px;
			float: left;
		}
		.logo h2{
			margin-left: 30px;
		}
		.menu{
			width: 30%;
			height: 50px;
			float: left;
		}
		.menu ul li{
			display: inline;
			padding: 10px;
			margin-left: 20px;
		}
		.menu ul li a{
			text-decoration: none;
		}
		button{
			margin-top: 10px;
			padding: 5px;
			background-color: greenyellow;
			color: white;
		}
		button a{
			text-decoration: none;
			color: white;
		}
		.banner{
			width: 100%;
			height: 200px;
			border: 1px solid;
			background-image: url('collagenanner.jpg');
			background-size: cover;
			background-repeat: no-repeat;
		}
		.banner h1{
			text-align: center;
			margin-top: 60px;
		}
		.container{
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		form {
			width: 50%;
			border: 1px solid;
			margin: 20px auto;
			text-align: left;
		}
		form input, form button{
			display: block;
			width: 80%;
			margin: 10px auto;
		}
		form h1{
			text-align: center;
		}
		footer{
			width: 100%;
			height: 50px;
			background-color: black;
		}
		footer h2{
			text-align: center;
			color: white;
		}
	</style>
</head>
<body>
<div class="navbar">
	<div class="logo">
		<h2>Logo</h2>
	</div>
	<div class="menu">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Admission</a></li>
		</ul>
	</div>
	<button>
		<a href="login.php">Login</a>
	</button>
</div>

<div class="banner">
	<h1>Student Management System</h1>
</div>

<div class="container">
	<form method="POST" action="data_check.php">
		<h1>Admission Form</h1>
		Name: <input type="text" name="name" required>
		Email: <input type="email" name="gmail" required>
		Phone: <input type="number" name="number" required>
		Message: <input type="text" name="message" required>
		<button type="submit" name="submit">Apply</button>
	</form>
</div>

<footer><h2>All @Copyright by YouTude</h2></footer>
</body>
</html>

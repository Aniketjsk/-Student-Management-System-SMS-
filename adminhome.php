<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php

   include 'admin_css.php';
	?>
	<style type="text/css">
		header{
			width: 100%;
			height: 100px;
			background-color: skyblue;
		}
		.header{
			width: 50%;
			height: 100px;
			float: left;
		} 
		.header a{
			margin-left: 20px;
			margin-top: 30px;
		}
		.button{
			width: 40%;
			height: 100px;	
			float: left;
		}
		.button a{
			float: right;
			margin-top: 30px;
		}
		.side{
			width: 50%;
			height: 400px;
			margin: 0px auto;
			margin-top: 100px;
		}
        aside{
        	width: 25%;
        	height: 500px;
        	border: 1px solid;
            border-radius: 0px 10px 10px 0px;
        	background-color: dimgrey;
        	float: left;
        }
        aside ul li {
        	font-family: sans-serif;
        	font-size: 20px;
        	list-style-type: none;
        }
        aside ul li a{
        	color: white;
        	text-decoration: none;
        }
        .maincontent{
           width: 75%;
           height: 500px;
           background-color: whitesmoke;
           float: left;
        }
        .maincontent h1{
        	margin-top: 20px;
        	margin-left: 350px;
        }
	</style>
</head>
<body>
	<?php
     include 'admin_slider.php';
	?>
     <maincontent class="maincontent">
     	  <h1>Admin Deshbord</h1>
     </maincontent>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Panel</title>
	<style>
		body{
			background-image: url('collegebackground.jpg');
			background-size: cover;
            background-repeat: no-repeat;
			}
		.form {
			width: 50%;
			margin: 200px auto;
			padding: 20px;
			border: 1px solid #000;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		form {
			display: flex;
			flex-direction: column;
			gap: 10px;
		}
		input {
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		button {
			padding: 10px;
			border: none;
			background-color: #007BFF;
			color: white;
			border-radius: 4px;
			cursor: pointer;
		}
		button:hover {
			background-color: #0056b3;
		}
	</style>
</head>
<body>
	<div class="form">
		<form method="POST" action="login_check.php">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			
			<button type="submit">Login</button>
		</form>
	</div>
</body>
</html>

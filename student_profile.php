<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Connect to the database
$data = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username='$name'";
$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);

if (isset($_POST['save_profile'])) {
    $s_email = $_POST['email'];
    $s_phone = $_POST['phone'];
    $s_password = $_POST['password'];

    $sql2 = "UPDATE user SET email='$s_email', phone='$s_phone', password='$s_password' WHERE username='$name'";
    $result2 = mysqli_query($data, $sql2);
    if ($result2) {
        header('location:student_profile.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Profile</title>
    <?php include 'student_css.php'; ?>
    <style>
        form {
            width: 50%; /* Reduced the width of the form */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center; /* Centering the form */
            margin: 0 auto;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 80%; /* Increased width for inputs */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 20px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #555;
            margin-left: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 20%; /* Increased width for the button */
            margin: 10px auto; /* Centering the button */
            display: block; /* Make button a block element */
            margin-right: 200px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'student_sidebar.php'; ?>
    <div class="side2">
        <h1>Student Profile</h1>
        <form method="POST" action="#">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" required value="<?php echo $info['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required value="<?php echo $info['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required value="<?php echo $info['phone']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required value="<?php echo $info['password']; ?>">
            </div>
            <button type="submit" name="save_profile" class="submit-btn">Save Profile</button>
        </form>
    </div>
</body>
</html>

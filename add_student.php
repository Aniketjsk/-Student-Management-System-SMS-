<?php
session_start();

// Redirect if not logged in or if user is not an admin
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['usertype']) && $_SESSION['usertype'] !== "admin") {
    header("Location: login.php");
    exit();
}

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Connect to the database
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $usertype = "student";

    // Check if the username already exists
    $check = "SELECT * FROM user WHERE username='$username'";
    $check_user = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_user);

    if ($row_count > 0) {
        echo "Username already exists. Try another one.";
    } else {
        // Insert the student into the database if username doesn't exist
        $sql = "INSERT INTO user (username, email, phone, usertype, password) VALUES ('$username', '$email', '$number', '$usertype', '$password')";
        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "Data uploaded successfully.";
        } else {
            echo "Upload failed: " . mysqli_error($data); // Added error detail for debugging
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission</title>
    <?php include 'admin_css.php'; ?>
    <style>
        .maincontent {
            width: 75%;
            height: 500px;
            background-color: whitesmoke;
            float: left;
        }
        .maincontent h1 {
            margin-top: 20px;
            text-align: center; /* Centered title */
        }
        form {
            margin: 0 auto;
            width: 50%; /* Center form and limit width */
        }
    </style>
</head>
<body>
    <?php include 'admin_slider.php'; ?>

    <div class="maincontent">
        <h1>Add Student</h1>
        <form method="POST" action="#">
            <label>Username:</label>
            <input type="text" name="username" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Phone:</label>
            <input type="number" name="number" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Create a connection to the database
$data = mysqli_connect($host, $user, $password, $db);

// Check connection
if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $name = mysqli_real_escape_string($data, $_POST['username']);
    $password = mysqli_real_escape_string($data, $_POST['password']);

    // SQL query to check if the user exists
    $sql = "SELECT * FROM user WHERE username='$name' AND password='$password'";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    // Check user type and redirect accordingly
    if ($row) {
        if ($row["usertype"] == "student") {
            $_SESSION['username'] = $name; // Store username in session
            header("Location: studenthome.php");
            exit(); // Prevent further script execution
        } elseif ($row["usertype"] == "admin") {
             $_SESSION['username'] = $name;
            header("Location: adminhome.php");
            exit(); // Prevent further script execution
        }
    } else {
        session_destroy(); // Destroy session if login fails
        $message = "Invalid username or password";
        $_SESSION['loginMessage'] = $message; // Store error message in session
        header("Location: login.php"); // Redirect back to login page
        exit(); // Prevent further script execution
    }
}
?>

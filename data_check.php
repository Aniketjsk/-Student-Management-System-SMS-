<?php
// Start session to store session messages
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Create a connection to the database
$data = mysqli_connect($host, $user, $password, $db);
if ($data == false) {
    die("Connection error");
}



if (isset($_POST['submit'])) {
    $user_name = $_POST['name'];
    $user_gmail = $_POST['gmail'];
    $user_number = $_POST['number'];
    $user_message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO admission (name, email, phone, message) VALUES ('$user_name', '$user_gmail', '$user_number', '$user_message')";
    $result = mysqli_query($data, $sql);
    
    if ($result) {
    	$_SESSION['message']='Your application was sent successfully!';
    	header("location:index.php");
       // echo "<p>Your application was sent successfully!</p>";
    }
     else {
        echo "<p>Apply Failed</p>";
    }
}
?>

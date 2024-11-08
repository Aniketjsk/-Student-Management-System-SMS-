<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Connect to the database
$data = mysqli_connect($host, $user, $password, $db);

if (isset($_GET['student_id'])) {
    $user_id = $_GET['student_id'];
    $sql = "DELETE FROM user WHERE id='$user_id'";
    $result = mysqli_query($data, $sql);

    if ($result) {
    	$_SESSION['message']='Delete Student is Successful';
        header("Location: view_student.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
}
?>

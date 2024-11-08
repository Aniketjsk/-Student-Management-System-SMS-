<?php
session_start();

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

// Connect to the database
$data = mysqli_connect($host, $user, $password, $db);

// Check if student_id is provided in the URL
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch the current student data
    $sql = "SELECT * FROM user WHERE id='$student_id'";
    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Update query
    $update_sql = "UPDATE user SET username='$username', email='$email', phone='$phone', password='$password' WHERE id='$student_id'";
    $update_result = mysqli_query($data, $update_sql);

    if ($update_result) {
        $_SESSION['message'] = "Student details updated successfully.";
        header("Location: view_student.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Student</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        .form-container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: whitesmoke;
            border: 1px solid black;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-container label {
            font-size: 18px;
            margin-top: 10px;
            display: block;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update Student Information</h2>
        <?php if (isset($info)) { ?>
        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $info['username']; ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo $info['email']; ?>" required>

            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $info['phone']; ?>" required>

            <label>Password</label>
            <input type="password" name="password" value="<?php echo $info['password']; ?>" required>

            <input type="submit" value="Update Student">
        </form>
        <?php } else { ?>
            <p>Student not found.</p>
        <?php } ?>
    </div>
</body>
</html>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

// Check user type
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] !== "admin") {
    header("location:login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "studentmanagementsystem";

$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM admission";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        .maincontent {
            width: 75%;
            height: 500px;
            background-color: whitesmoke;
            float: left;
        }
        .maincontent h1 {
            margin-top: 20px;
            margin-left: 350px;
        }
        table {
            margin-top: 20px;
            margin-left: 350px;
        }
    </style>
</head>
<body>
    <?php include 'admin_slider.php'; ?>
    <div class="maincontent">
        <h1>Applied For Admission</h1>
        <table border="1px">
            <tr>
                <th style="padding: 20px; font-size: 15px;">Name</th>
                <th style="padding: 20px; font-size: 15px;">Email</th>
                <th style="padding: 20px; font-size: 15px;">Phone Number</th>
                <th style="padding: 20px; font-size: 15px;">Message</th>
            </tr>
            <?php while ($info = $result->fetch_assoc()) { ?>
            <tr>
                <td style="padding: 20px; font-size: 15px;"><?php echo htmlspecialchars($info['name']); ?></td>
                <td style="padding: 20px; font-size: 15px;"><?php echo htmlspecialchars($info['email']); ?></td>
                <td style="padding: 20px; font-size: 15px;"><?php echo htmlspecialchars($info['phone']); ?></td>
                <td style="padding: 20px; font-size: 15px;"><?php echo htmlspecialchars($info['message']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

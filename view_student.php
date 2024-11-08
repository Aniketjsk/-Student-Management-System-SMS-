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
$sql = "SELECT * FROM user WHERE usertype='student'";
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
            height: auto;
            background-color: whitesmoke;
            float: left;
            padding-bottom: 20px;
        }
        .maincontent h1 {
            margin-top: 20px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .table_th, .table_td {
            padding: 20px;
            font-size: 20px;
            border: 1px solid black;
            text-align: center;
        }
        .table_td a {
            text-decoration: none;
            color: black;
        }
        .message {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <?php include 'admin_slider.php'; ?>
    
    <div class="maincontent">
        <h1>View Student</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>
        <table>
            <tr>
                <th class="table_th">Username</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Password</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>
            <?php
            while ($info = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="table_td"><?php echo $info['username']; ?></td>
                <td class="table_td"><?php echo $info['email']; ?></td>
                <td class="table_td"><?php echo $info['phone']; ?></td>
                <td class="table_td"><?php echo $info['password']; ?></td>
                <td class="table_td">
                    <a class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')" href='delete.php?student_id=<?php echo $info['id']; ?>'>Delete</a>
                </td>
                <td class="table_td">
                    <a class="btn btn-primary" onClick="return confirm('Are you sure you want to Update this?')" href='Update.php?student_id=<?php echo $info['id']; ?>'>Update</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>

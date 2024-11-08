<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Teachers</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        .maincontent {
            width: 75%;
            min-height: 500px;
            background-color: whitesmoke;
            float: left;
            padding: 20px;
        }
        .maincontent h1 {
            margin-top: 20px;
            text-align: center;
        }
        .teacher-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .teacher-table, .teacher-table th, .teacher-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .teacher-table th {
            background-color: #007bff;
            color: white;
        }
        .teacher-img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'admin_slider.php'; ?>

    <div class="maincontent">
        <h1>View Teachers</h1>

        <?php
        // Connect to the database
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "studentmanagementsystem";
        $conn = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch teachers from the database
        $sql = "SELECT * FROM teacher";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='teacher-table'>";
            echo "<tr><th>Image</th><th>Name</th><th>Description</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                // Handle null values by setting default empty strings
                $image = htmlspecialchars($row['image'] ?? '');
                $name = htmlspecialchars($row['name'] ?? '');
                $description = htmlspecialchars($row['description'] ?? '');

                echo "<tr>";
                echo "<td><img src='uploads/" . $image . "' class='teacher-img' alt='Teacher Image'></td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $description . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No teachers found.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

<?php
session_start();

if (isset($_POST['teacher_add'])) {
    $teacher_name = $_POST['teachername'];
    $description = $_POST['description'];

    // Check if image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Handling image upload
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate image type and size
        if (in_array(strtolower($image_ext), $allowed_extensions) && $image_size <= 5000000) {
            $image_folder = "uploads/" . $image;

            // Move the uploaded image to the desired folder
            if (move_uploaded_file($image_tmp, $image_folder)) {
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

                // Use prepared statements to insert the teacher data securely
                $sql = "INSERT INTO teacher (name, description, image) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sss', $teacher_name, $description, $image);

                // Execute query
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Teacher added successfully!');</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }

                // Close the statement and connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } else {
                echo "<script>alert('Image upload failed!');</script>";
            }
        } else {
            echo "<script>alert('Invalid image file or file too large!');</script>";
        }
    } else {
        // No image uploaded, insert only teacher name and description
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "studentmanagementsystem";
        $conn = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Use prepared statements to insert the teacher data securely
        $sql = "INSERT INTO teacher (name, description) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $teacher_name, $description);

        // Execute query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Teacher added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
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
    <style type="text/css">
        .maincontent {
            width: 75%;
            height: 500px;
            background-color: whitesmoke;
            float: left;
        }

        .maincontent h1 {
            margin-top: 20px;
            text-align: center;
        }

        .teachersection {
            width: 50%;
            height: 400px;
            margin: 0 auto;
        }

        .teachersection input,
        .teachersection button {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .teachersection button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .teachersection button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'admin_slider.php'; ?>

    <div class="maincontent">
        <h1>Add Teacher</h1>
        <div class="teachersection">
            <form method="POST" action="#" enctype="multipart/form-data">
                <label for="teachername">Teacher Name:</label>
                <input type="text" name="teachername" id="teachername" required><br><br>

                <label for="description">Description:</label>
                <input type="text" name="description" id="description" required><br><br>

                <label for="image">Image:</label>
                <input type="file" name="image" id="image"><br><br>

                <button type="submit" name="teacher_add">Add Teacher</button>
            </form>
        </div>
    </div>
</body>
</html>

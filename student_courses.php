<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Course</title>
       <?php include 'student_css.php'; ?>
    </style>
</head>
<body>
    <?php include 'student_sidebar.php'; ?>
     <div class="side2">
    <h1>Student Course</h1>
</div>
</body>
</html>
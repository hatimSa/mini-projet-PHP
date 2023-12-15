<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .section {
            margin-bottom: 20px;
        }

        .card {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="dashboard-container">
        <h2>Professor Dashboard</h2>

        <div class="section">
            <h3>My Courses</h3>
            <div class="card">
                <!-- Content for My Courses -->
            </div>
        </div>

        <div class="section">
            <h3>Student Grades</h3>
            <div class="card">
                <!-- Content for Student Grades -->
            </div>
        </div>

        <!-- Add more sections and cards as needed -->

    </div>

</body>

</html>
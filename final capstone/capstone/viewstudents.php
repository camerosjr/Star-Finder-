
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 20px;
            animation: fadeIn 0.5s ease-in-out; /* Fade in animation */
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .header {
            background-color: #dc3545;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0;
        }

        .table th,
        .table td {
            border-color: #dee2e6;
        }

        .btn-back {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<?php
session_start(); // Start the session

// Include the database connection file
include_once "connection.php";

// Check if student_id, section, and subject_code are provided
if (isset($_GET['student_id']) && isset($_GET['section']) && isset($_GET['subject_code'])) {
    // Sanitize inputs to prevent SQL injection
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);
    $section = mysqli_real_escape_string($conn, $_GET['section']);
    $subject_code = mysqli_real_escape_string($conn, $_GET['subject_code']);

    // Query to retrieve attendance records based on student ID, section, and subject code
    $query = "SELECT * FROM attendance_records WHERE student_id = '$student_id' AND section = '$section' AND subject_code = '$subject_code'";
    $result = mysqli_query($conn, $query);

    // Check if query executed successfully
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Display attendance records
            echo "<div class='container'>";
            echo "<div class='header'>";
            echo "<h1>Attendance Records</h1>";
            echo "</div>";
            echo "<div class='card'>";
            echo "<h2>Attendance Records for Student ID: $student_id, Section: $section, Subject Code: $subject_code</h2>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Attendance Status</th>";
            echo "<th>Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['attendance_status'] . "</td>";
                echo "<td>" . $row['date_time'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>"; // Close table-responsive div
            echo "</div>"; // Close card div
            echo "</div>"; // Close container div
        } else {
            echo "<div class='container'>";
            echo "<div class='header'>";
            echo "<h1>Attendance Records</h1>";
            echo "</div>";
            echo "<div class='card'>";
            echo "<p>No attendance records found for Student ID: $student_id, Section: $section, Subject Code: $subject_code</p>";
            echo "</div>"; // Close card div
            echo "</div>"; // Close container div
        }
    } else {
        echo "<div class='container'>";
        echo "<div class='header'>";
        echo "<h1>Attendance Records</h1>";
        echo "</div>";
        echo "<div class='card'>";
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
        echo "</div>"; // Close card div
        echo "</div>"; // Close container div
    }
} else {
    echo "<div class='container'>";
    echo "<div class='header'>";
    echo "<h1>Attendance Records</h1>";
    echo "</div>";
    echo "<div class='card'>";
    echo "<p>Student ID, Section, and Subject Code are required.</p>";
    echo "</div>"; // Close card div
    echo "</div>"; // Close container div
}
?>

<div class="container mt-3">
    <a href="student.php" class="btn btn-back">Back</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

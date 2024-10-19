<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

// Include database connection
include("connection.php");

// Check if the request is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id and status are set in the POST data
    if (isset($_POST['user_id']) && isset($_POST['status'])) {
        // Sanitize user_id and status to prevent SQL injection
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Update the attendance status in the database
        $query = "UPDATE user SET attendance_status = '$status' WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Attendance status updated successfully
            echo "Attendance status updated successfully.";
        } else {
            // Error updating attendance status
            echo "Error: Unable to update attendance status.";
        }
    } else {
        // Missing user_id or status in the POST data
        echo "Error: Missing user_id or status in the request.";
    }
} else {
    // Request method is not POST
    echo "Error: Invalid request method.";
}
?>

<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

include("connection.php");

// Check if the form is submitted and save button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_records'])) {
    // Check if attendance data is received
    if(isset($_POST['attendance'])) {
        foreach($_POST['attendance'] as $user_id => $attendance_status) {
            // Escape user input to prevent SQL injection
            $user_id = mysqli_real_escape_string($conn, $user_id);
            $attendance_status = mysqli_real_escape_string($conn, $attendance_status);
            
            // Update the attendance status in the database
            $query = "UPDATE `user` SET attendance_status = '$attendance_status' WHERE user_id = $user_id";
            $result = mysqli_query($conn, $query);

            // Check if the update query executed successfully
            if (!$result) {
                die("Error updating record: " . mysqli_error($conn));
            }
        }

        // Redirect to view_records.php after saving attendance records
        echo "<script>window.location.href='view_records.php?file=".urlencode($_GET['file'])."';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>No attendance data received.</div>";
    }
}
?>

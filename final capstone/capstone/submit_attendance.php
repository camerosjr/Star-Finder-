<?php
session_start();
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit; // Make sure to exit after redirecting
}

// Check if the attendance data is received
if (isset($_POST['attendanceData']) && !empty($_POST['attendanceData'])) {
    // Prepare a SQL statement to insert attendance records
    $stmt = $conn->prepare("INSERT INTO attendance (user_id, date_added, attendance_status) VALUES (?, NOW(), ?)");
    
    // Bind parameters
    $stmt->bind_param("ss", $user_id, $status);
    
    // Loop through each attendance record
    foreach ($_POST['attendanceData'] as $attendance) {
        $user_id = $attendance['user_id'];
        $status = $attendance['status'];
        
        // Execute the statement
        $stmt->execute();
    }
    
    // Close the statement
    $stmt->close();
    
    // Return a success message
    echo "Attendance submitted successfully";
} else {
    // If attendance data is not received, return an error message
    echo "Error: Attendance data is missing";
}
?>

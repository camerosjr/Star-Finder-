<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

// Check if the form is submitted and save button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_records'])) {
    // Check if attendance data is received
    if(isset($_POST['attendance'])) {
        // Define the folder path where records will be saved
        $folder_path = "records/";

        // Create the records folder if it doesn't exist
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }

        // Generate a unique filename based on current date and time
        $file_name = date("Ymd_His") . "_attendance.csv";

        // Open or create the CSV file for writing in the records folder
        $file = fopen($folder_path . $file_name, "w");

        // Write headers to the CSV file
        fputcsv($file, array('User ID', 'Attendance Status'));

        // Loop through attendance data and write to the CSV file
        foreach($_POST['attendance'] as $user_id => $attendance_status) {
            fputcsv($file, array($user_id, $attendance_status));
        }

        // Close the file handle
        fclose($file);

        // Redirect to a success page or perform further actions if needed
        echo "<script>alert('Attendance records saved successfully.');</script>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>No attendance data received.</div>";
    }
}
?>

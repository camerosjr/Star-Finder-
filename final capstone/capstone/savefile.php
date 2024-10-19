<?php
session_start();
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}
include("connection.php");

// Check if the form is submitted and save button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_records'])) {
    // Check if there are records to save
    if (isset($_SESSION['attendance'])) {
        // Define the folder path where records will be saved
        $folder_path = "records/";

        // Check if the records folder exists, if not, create it
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }

        // Get the subject code, section, first name, and last name from the session data
        $subject_code = '';
        $section = '';
        $first_name = '';
        $last_name = '';

        // Fetch subject code, section, first name, and last name from the database
        $query = "SELECT subject_code, section, first_name, last_name FROM attendance_records WHERE date_time = (SELECT MAX(date_time) FROM attendance_records)";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $subject_code = $row['subject_code'];
            $section = $row['section'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }

        // Generate the filename based on section and subject code
        $filename = $folder_path . "{$section}_{$subject_code}_" . date("Ymd_His") . ".csv";

        // Open the file for writing
        $file = fopen($filename, "w");

        // Write the headers to the file
        $headers = "User ID,Subject Code,Section,First Name,Last Name,Attendance,Date Time\n";
        fwrite($file, $headers);

        // Write each record to the file
        foreach ($_SESSION['attendance'] as $student_id => $attendance_status) {
            // Get the current date and time
            $date_time = date("Y-m-d H:i:s");

            // Construct the record with all fields populated
            $record = "$student_id,$subject_code,$section,$first_name,$last_name,$attendance_status,$date_time\n";
            fwrite($file, $record);
        }

        // Close the file
        fclose($file);

        // Redirect to viewfile.php
        header("Location: viewfile.php");
        exit;
    } else {
        echo "<p>No attendance records to save.</p>";
    }
} else {
    // If save button is not clicked or form is not submitted, redirect to viewfile.php
    header("Location: viewfile.php");
    exit;
}
?>

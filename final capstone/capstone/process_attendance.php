<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$uploadsDirectory = "C:/xampp/htdocs/capstone/uploads";

if (isset($_POST['selected_file'])) {
    $selectedFile = $_POST['selected_file'];
    if (file_exists($uploadsDirectory . DIRECTORY_SEPARATOR . $selectedFile)) {
        $fileContent = file_get_contents($uploadsDirectory . DIRECTORY_SEPARATOR . $selectedFile);
    } else {
        $errorMessage = "Selected file not found.";
    }
}

if (isset($fileContent)) {
    $attendanceRecords = array_map('str_getcsv', explode("\n", $fileContent));

    foreach ($attendanceRecords as $record) {
        if (!empty(array_filter($record))) {
            $studentId = $record[0];
            $subjectCode = $record[1];
            $section = $record[2];
            $firstName = $record[3];
            $lastName = $record[4];
            $attendanceStatus = $_POST['attendance'][$studentId];

            $sql = "INSERT INTO attendance_records (student_id, section, Subject_Code, first_name, last_name, attendance_status) 
                    VALUES ('$studentId', '$section', '$subjectCode', '$firstName', '$lastName', '$attendanceStatus')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    header("Location: view_attendance.php");
    exit();
} else {
    echo "No attendance records found.";
}

$conn->close();
?>

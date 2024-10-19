<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login_admin.php");
    exit();}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the folder name is provided
    if (isset($_GET['folder'])) {
        $folderName = $_GET['folder'];
        $folderPath = "folders/$folderName";

        // Check if the folder exists
        if (is_dir($folderPath)) {
            // Initialize an array to store star students' records
            $starStudentsRecords = array();

            // Open the folder
            if ($dir = opendir($folderPath)) {
                // Process each file in the folder
                while (($file = readdir($dir)) !== false) {
                    if ($file != "." && $file != ".." && strpos($file, "_attendance") !== false) {
                        $filePath = "$folderPath/$file";
                        $lines = file($filePath);
                        // Start from the second row to skip the header
                        for ($i = 1; $i < count($lines); $i++) {
                            $fields = str_getcsv($lines[$i]);
                            $userID = $fields[0];
                            $attendance = $fields[4];
                            // Check if the student has 3 or more absences
                            if ($attendance === "Absent") {
                                // Add the record to the array
                                $starStudentsRecords[] = $lines[$i];
                            }
                        }
                    }
                }
                // Close the directory handle
                closedir($dir);

                // Save the star students' records to a file named "star_students.txt"
                if (!empty($starStudentsRecords)) {
                    $file = fopen("star_students.txt", "w");
                    foreach ($starStudentsRecords as $record) {
                        fwrite($file, $record);
                    }
                    fclose($file);
                    // Redirect to starstudents.php after saving records
                    header("Location: starstudents.php");
                    exit();
                } else {
                    echo "<p>No star students found.</p>";
                }
            } else {
                echo "<p>Error: Unable to open folder.</p>";
            }
        } else {
            echo "<p>Error: Folder not found.</p>";
        }
    } else {
        echo "<p>Error: Folder name not provided.</p>";
    }
}
?>

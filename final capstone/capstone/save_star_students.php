<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

// Include the database connection file
include 'connection.php';

// Check if folder parameter is set in the POST data
if (isset($_POST['folder'])) {
    $folderName = $_POST['folder'];
    $folderPath = "folders/$folderName";

    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Initialize an array to store user IDs, subject codes, and their absence counts
        $absenceCounts = array();

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
                        $subjectCode = $fields[1]; // Extract subject code
                        $attendance = $fields[4];
                        // Count absences for each user and subject code
                        if ($attendance === "Absent") {
                            $key = "$userID|$subjectCode";
                            if (array_key_exists($key, $absenceCounts)) {
                                $absenceCounts[$key]++;
                            } else {
                                $absenceCounts[$key] = 1;
                            }
                        }
                    }
                }
            }
            // Close the directory handle
            closedir($dir);

            // Insert star students with 3 or more absences into the database
            foreach ($absenceCounts as $key => $absenceCount) {
                list($userID, $subjectCode) = explode('|', $key);
                // Prepare and execute the SQL query to insert the data into the database
                $sql = "INSERT INTO star_students (user_id, subject_code, absences) VALUES ('$userID', '$subjectCode', '$absenceCount')";
                if ($conn->query($sql) === TRUE) {
                    echo "Record inserted successfully for user $userID and subject code $subjectCode<br>";
                } else {
                    echo "Error inserting record for user $userID and subject code $subjectCode: " . $conn->error . "<br>";
                }
            }

            // Redirect to view_star_students.php after inserting records
            header("Location: folders.php");
            exit; // Ensure that no further output is sent
        } else {
            echo "<p>Error: Unable to open folder.</p>";
        }
    } else {
        echo "<p>Error: Folder not found.</p>";
    }
} else {
    echo "<p>Error: No folder specified.</p>";
}

// Close the database connection
$conn->close();
?>

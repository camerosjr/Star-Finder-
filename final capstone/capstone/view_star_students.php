<?php
session_start(); // Start the session

// Include your database connection file
include_once "connection.php";

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Function to insert star students data into the database
function insertStarStudents($connection, $starStudents) {
    foreach ($starStudents as $key => $absenceCount) {
        list($userID, $subjectCode, $section) = explode('|', $key); // Split user ID, subject code, and section
        $query = "INSERT INTO star_students (user_id, subject_code, section, absences) 
                  VALUES ('$userID', '$subjectCode', '$section', $absenceCount)";
        mysqli_query($connection, $query);
    }
}

// Check if the form is submitted
if(isset($_POST['send_to_admin'])) {
    // Check if folder parameter is set in the URL
    if (isset($_GET['folder'])) {
        $folderName = $_GET['folder'];
        $folderPath = "folders/$folderName";

        // Check if the folder exists
        if (is_dir($folderPath)) {
            // Initialize an array to store user IDs, subject codes, sections, and their absence counts
            $absenceCounts = array();

            // Open the folder
            if ($dir = opendir($folderPath)) {
                // Process each file in the folder
                while (($file = readdir($dir)) !== false) {
                    if ($file != "." && $file != ".." && strpos($file, ".csv") !== false) {
                        $filePath = "$folderPath/$file";
                        $lines = file($filePath);
                        // Start from the second row to skip the header
                        for ($i = 1; $i < count($lines); $i++) {
                            $fields = str_getcsv($lines[$i]);
                            $userID = $fields[0];
                            $subjectCode = $fields[1]; // Extract subject code
                            $section = $fields[2]; // Extract section
                            $attendance = $fields[5]; // Extract attendance status
                            // Count absences for each user, subject code, and section
                            if ($attendance === "Absent") {
                                $key = "$userID|$subjectCode|$section";
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

                // Display star students with 3 or more absences
                $starStudents = array_filter($absenceCounts, function($count) {
                    return $count >= 3;
                });

                // Insert star students data into the database
                insertStarStudents($conn, $starStudents);
                
                // Redirect back to the folders page after sending data to admin
                header("Location: folders.php");
                exit();
            } else {
                echo "<p>Error: Unable to open folder.</p>";
            }
        } else {
            echo "<p>Error: Folder not found.</p>";
        }
    } else {
        echo "<p>Error: No folder specified.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Star Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #DC3545;
            margin-bottom: 20px;
        }
        .btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Star Students (3 or More Absences)</h2>
    <?php
    // Check if folder parameter is set in the URL
    if (isset($_GET['folder'])) {
        $folderName = $_GET['folder'];
        $folderPath = "folders/$folderName";

        // Check if the folder exists
        if (is_dir($folderPath)) {
            // Initialize an array to store user IDs, subject codes, sections, and their absence counts
            $absenceCounts = array();

            // Open the folder
            if ($dir = opendir($folderPath)) {
                // Process each file in the folder
                while (($file = readdir($dir)) !== false) {
                    if ($file != "." && $file != ".." && strpos($file, ".csv") !== false) {
                        $filePath = "$folderPath/$file";
                        $lines = file($filePath);
                        // Start from the second row to skip the header
                        for ($i = 1; $i < count($lines); $i++) {
                            $fields = str_getcsv($lines[$i]);
                            $userID = $fields[0];
                            $subjectCode = $fields[1]; // Extract subject code
                            $section = $fields[2]; // Extract section
                            $attendance = $fields[5]; // Extract attendance status
                            // Count absences for each user, subject code, and section
                            if ($attendance === "Absent") {
                                $key = "$userID|$subjectCode|$section";
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

                // Display star students with 3 or more absences
                $starStudents = array_filter($absenceCounts, function($count) {
                    return $count >= 3;
                });

                if (empty($starStudents)) {
                    echo "<p>No star students found with 3 or more absences.</p>";
                } else {
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>User ID</th>";
                    echo "<th scope='col'>Subject Code</th>";
                    echo "<th scope='col'>Section</th>";
                    echo "<th scope='col'>Absences</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($starStudents as $key => $absenceCount) {
                        list($userID, $subjectCode, $section) = explode('|', $key); // Split user ID, subject code, and section
                        echo "<tr>";
                        echo "<td>$userID</td>";
                        echo "<td>$subjectCode</td>";
                        echo "<td>$section</td>";
                        echo "<td>$absenceCount</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                }
            } else {
                echo "<p>Error: Unable to open folder.</p>";
            }
        } else {
            echo "<p>Error: Folder not found.</p>";
        }
    } else {
        echo "<p>Error: No folder specified.</p>";
    }
    ?>
    <!-- Form to send star students data to admin -->
    <form action="" method="post">
        <input type="hidden" name="send_to_admin" value="1">
        <button type="submit" class="btn btn-success mt-3">Send to Admin</button>
    </form>
    <a href="folders.php" class="btn btn-primary mt-3">Back to Folders</a>
</div>
</body>
</html>

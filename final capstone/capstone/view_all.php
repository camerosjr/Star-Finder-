<?php
session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>All Files in Folder</h2>
    <?php
    // Check if folder parameter is set in the URL
    if (isset($_GET['folder'])) {
        $folderName = $_GET['folder'];
        $folderPath = "folders/$folderName";

        // Check if the folder exists
        if (is_dir($folderPath)) {
            // Get an array of files in the folder sorted by modification time
            $files = scandir($folderPath, SCANDIR_SORT_DESCENDING);

            // Display each file in the folder
            foreach ($files as $file) {
                if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
                    // Display file name
                    echo "<h4>$file:</h4>";
                    // Read and display file contents in a table
                    echo "<table>";
                    $filePath = "$folderPath/$file";
                    $lines = file($filePath);
                    // Display header row
                    echo "<tr>";
                    foreach (str_getcsv($lines[0]) as $cell) {
                        // Change "User Name" to "Section"
                        if ($cell == "User Name") {
                            echo "<th>Section</th>";
                        } else {
                            echo "<th>$cell</th>";
                        }
                    }
                    echo "</tr>";
                    // Display data rows
                    for ($i = 1; $i < count($lines); $i++) {
                        echo "<tr>";
                        foreach (str_getcsv($lines[$i]) as $cell) {
                            echo "<td>$cell</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table><br>";
                }
            }
        } else {
            echo "<p>Error: Folder not found.</p>";
        }
    } else {
        echo "<p>Error: No folder specified.</p>";
    }
    ?>

    <!-- Button to find students with 3 or more absences -->
    <form action="view_star_students.php" method="get">
        <input type="hidden" name="folder" value="<?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>">
        <button type="submit" class="btn btn-warning mt-3">Find Students with 3 or More Absences</button>
    </form>

    <a href="folders.php" class="btn btn-primary mt-3">Back to Folders</a>
</div>
</body>
</html>

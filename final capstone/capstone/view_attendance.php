<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT *, CONCAT(section, '_', Subject_Code) AS file_name FROM attendance_records 
        WHERE (student_id, section, Subject_Code, first_name, last_name, date_time) IN 
        (SELECT student_id, section, Subject_Code, first_name, last_name, MAX(date_time) 
         FROM attendance_records 
         GROUP BY student_id, section, Subject_Code, first_name, last_name) 
        ORDER BY date_time DESC";

// Modify the query to fetch only distinct records based on specific columns
$sql = "SELECT DISTINCT student_id, section, Subject_Code, first_name, last_name, attendance_status, date_time, CONCAT(section, '_', Subject_Code) AS file_name 
        FROM attendance_records 
        WHERE (student_id, section, Subject_Code, first_name, last_name, date_time) IN 
        (SELECT student_id, section, Subject_Code, first_name, last_name, MAX(date_time) 
         FROM attendance_records 
         GROUP BY student_id, section, Subject_Code, first_name, last_name) 
        ORDER BY date_time DESC";

$result = $conn->query($sql);

// Function to export data to CSV file
function exportToCSV($data, $filename) {
    $file = fopen($filename, 'w');
    if ($file === false) {
        echo "Failed to open the file.";
        return;
    }
    $headers = array("User ID", "Subject Code", "Section", "First Name", "Last Name", "Attendance", "Date Time");
    fputcsv($file, $headers);
    foreach ($data as $row) {
        // Format the data for each row
        $formattedRow = array(
            $row["student_id"],
            $row["Subject_Code"],
            $row["section"],
            $row["first_name"],
            $row["last_name"],
            $row["attendance_status"],
            date("m/d/Y H:i:s", strtotime($row["date_time"])),
            // Include any additional columns here
            // For example, if there's an additional column named 'Column9':
            // $row["Column9"]
        );
        fputcsv($file, $formattedRow);
    }
    fclose($file);
}

// Check if the "Save Records" button is clicked
if (isset($_POST['save_records'])) {
    // Generate filename based on Section and Subject Code
    $date = date('m-d-Y_H-i-s');
    $filename = "C:/xampp/htdocs/capstone/records/" . $result->fetch_assoc()['file_name'] . "_" . $date . ".csv";
    
    // Fetch all the rows of data
    $allData = $result->fetch_all(MYSQLI_ASSOC);
    
    // Export all data to CSV
    exportToCSV($allData, $filename);
    
    // Redirect to viewfile.php
    header("Location: viewfile.php?filename=" . urlencode($filename));
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Latest Attendance Records</h2>

        <?php if ($result->num_rows > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Subject Code</th>
                        <th>Section</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Attendance</th>
                        <th>Date Time</th>
                        <!-- Include additional column headers here -->
                        <!-- For example: <th>Column9</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetching the first record separately
                    $firstRow = $result->fetch_assoc();
                    ?>
                        <tr>
                            <td><?php echo $firstRow["student_id"]; ?></td>
                            <td><?php echo $firstRow["Subject_Code"]; ?></td>
                            <td><?php echo $firstRow["section"]; ?></td>
                            <td><?php echo $firstRow["first_name"]; ?></td>
                            <td><?php echo $firstRow["last_name"]; ?></td>
                            <td><?php echo $firstRow["attendance_status"]; ?></td>
                            <td><?php echo date("m/d/Y H:i:s", strtotime($firstRow["date_time"])); ?></td>
                            <!-- Include additional columns here -->
                            <!-- For example: <td><?php echo $firstRow["Column9"]; ?></td> -->
                        </tr>
                    <?php
                    // Remaining records
                    foreach ($result as $row) :
                    ?>
                        <tr>
                            <td><?php echo $row["student_id"]; ?></td>
                            <td><?php echo $row["Subject_Code"]; ?></td>
                            <td><?php echo $row["section"]; ?></td>
                            <td><?php echo $row["first_name"]; ?></td>
                            <td><?php echo $row["last_name"]; ?></td>
                            <td><?php echo $row["attendance_status"]; ?></td>
                            <td><?php echo date("m/d/Y H:i:s", strtotime($row["date_time"])); ?></td>
                            <!-- Include additional columns here -->
                            <!-- For example: <td><?php echo $row["Column9"]; ?></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Save Records Button -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="save_records" class="btn btn-primary">Save Records</button>
            </form>
        <?php else : ?>
            <p>No attendance records found.</p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php
$conn->close();
?>

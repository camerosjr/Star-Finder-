<?php
include("connection.php");

// Start the session
session_start();
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

// Check if the form is submitted and save button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_records'])) {
    // Check if attendance data is received
    if(isset($_POST['attendance'])) {
        // Store attendance data in session
        $_SESSION['attendance'] = $_POST['attendance'];
        
        foreach($_POST['attendance'] as $student_id => $attendance_status) {
            // Escape user input to prevent SQL injection
            $student_id = mysqli_real_escape_string($conn, $student_id);
            $attendance_status = mysqli_real_escape_string($conn, $attendance_status);
            
            // Check if student_id and attendance_status are not NULL
            if ($student_id !== NULL && $attendance_status !== NULL) {
                // Get the subject code, first name, last name, and section from the form data
                $subject_code = ''; // Initialize subject code variable
                $first_name = ''; // Initialize first name variable
                $last_name = ''; // Initialize last name variable
                $section = ''; // Initialize section variable
                $file_name = isset($_GET['file']) ? $_GET['file'] : '';
                
                // Check if file exists and open it for reading
                if ($file_name != "" && file_exists("uploads/" . $file_name)) {
                    $handle = fopen("uploads/" . $file_name, "r");
                    if ($handle !== FALSE) {
                        // Loop through each line until finding the matching student ID
                        while (($data = fgetcsv($handle)) !== FALSE) {
                            if ($data[0] == $student_id) {
                                $subject_code = $data[1]; // Assign subject code
                                $section = $data[2]; // Assign section
                                $first_name = $data[3]; // Assign first name
                                $last_name = $data[4]; // Assign last name
                                break; // Exit loop once found
                            }
                        }
                        fclose($handle);
                    }
                }

                // Insert or update the attendance record in the database
                $query = "INSERT INTO attendance_records (student_id, subject_code, section, first_name, last_name, attendance_status) 
                          VALUES ('$student_id', '$subject_code', '$section', '$first_name', '$last_name', '$attendance_status') 
                          ON DUPLICATE KEY UPDATE attendance_status = VALUES(attendance_status)";
                $result = mysqli_query($conn, $query);

                // Check if the insert or update query executed successfully
                if (!$result) {
                    die("Error inserting record: " . mysqli_error($conn));
                }
            }
        }

        // Redirect to view_records.php after saving attendance records
        header("Location: view_records.php?file=" . urlencode($_GET['file']));
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>No attendance data received.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded CSV File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8FF;
        }
        .hero-section {
            image
            padding: 20px;
            background: #F8F8FF;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-dark {
            background-color: #8f1111 !important; /* Set the background color to red */
        }
        .navbar .collapse {
            background:#8f1111;
        }

        .name {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .hero-section {
            padding: 50px 0;
        }

        .dashboard-item {
            background-color: #dc3545;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-item:hover {
            transform: translateY(-5px);
        }

        .dashboard-item i {
            font-size: 3rem;
            color: #F8F8FF;
        }

        .dashboard-item p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .logout-btn {
            margin-top: 20px;
        }

        .logout-btn:hover {
            color: #fff;
        }
        .dashboard-item.clicked {
            animation: scaleEffect 0.3s ease-in-out; /* Define animation */
        }
        .btn-primary {
            --bs-btn-color: #fff;
            --bs-btn-bg: #8f1111 ;
            --bs-btn-border-color: #8f1111 ;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #8f1111 ;
            --bs-btn-hover-border-color: #8f1111 ;
            --bs-btn-focus-shadow-rgb: 49,132,253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #8f1111 ;
            --bs-btn-active-border-color: #0a53be;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #0d6efd;
            --bs-btn-disabled-border-color: #0d6efd;
        }

        @keyframes scaleEffect {
            0% { transform: scale(1); } /* Initial scale */
            50% { transform: scale(1.1); } /* Scale up */
            100% { transform: scale(1); } /* Scale back to normal */
        }
        .navbar .navbar-brand i {
        font-size: 25px;
        background: #8f1111;
        border-radius: 50%;
        padding: 10px 15px;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-star"></i> UNIWATCH:STAR FINDER</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">Create Folder</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php">Upload Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="folders.php">Folders</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="edit.php?id=<?php echo $res_id; ?>">Change Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</head>

<body>
    <div class="container">
        <h2>Contents of Uploaded File: <?php echo isset($_GET['file']) ? $_GET['file'] : ''; ?></h2>
        <form id="attendanceForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?file=' . urlencode($_GET['file']); ?>" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Subject Code</th>
                        <th>Section</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $file_name = isset($_GET['file']) ? $_GET['file'] : '';
                    if ($file_name != "" && file_exists("uploads/" . $file_name)) {
                        $handle = fopen("uploads/" . $file_name, "r");
                        if ($handle !== FALSE) {
                            $header = true;
                            while (($data = fgetcsv($handle)) !== FALSE) {
                                echo "<tr>";
                                foreach ($data as $index => $value) {
                                    echo "<td>$value</td>";
                                }
                                echo "<td>";
                                // Check if attendance status is selected for this student
                                echo "<select name='attendance[$data[0]]'>";
                                if(isset($_POST['attendance'][$data[0]]) && $_POST['attendance'][$data[0]] == 'Present') {
                                    echo "<option value='Present' selected>Present</option>";
                                    echo "<option value='Absent'>Absent</option>";
                                } else {
                                    echo "<option value='Present'>Present</option>";
                                    echo "<option value='Absent' selected>Absent</option>";
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            fclose($handle);
                        } else {
                            echo "<tr><td colspan='6'>Error: Unable to open the file.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>File not found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-inline-block">
                <button type="submit" class="btn btn-primary" name="save_records">Save</button>
                <a href="upload.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <script>
        function submitForm(selectElement) {
            selectElement.form.submit();
        }
    </script>
</body>
</html>

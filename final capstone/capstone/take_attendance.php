<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Define the directory path where files are uploaded
$uploadsDirectory = "C:/xampp/htdocs/capstone/uploads"; // Update this with your uploads directory path

// Check if a file is selected
if (isset($_POST['file_selected'])) {
    $selectedFile = $_POST['file_selected'];
    // Check if the selected file exists
    if (file_exists($uploadsDirectory . DIRECTORY_SEPARATOR . $selectedFile)) {
        // Read the content of the selected file
        $fileContent = file_get_contents($uploadsDirectory . DIRECTORY_SEPARATOR . $selectedFile);
    } else {
        $errorMessage = "Selected file not found.";
    }
}

// Parse the CSV content if available
if (isset($fileContent)) {
    $attendanceRecords = array_map('str_getcsv', explode("\n", $fileContent));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8FF;
            animation: fadeIn 0.5s ease-in-out; /* Fade in animation */
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
            background: #8f1111;
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
            --bs-btn-active-bg: #0a58ca;
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
        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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
                            <a class="nav-link" href="attendance.php">attendance</a>
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
                                    <a class="dropdown-item" href="edit.php">Change Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


<body>

    <div class="container">
        <h2 class="text-center">Attendance Records: <?php echo isset($selectedFile) ? $selectedFile : ''; ?></h2>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($attendanceRecords)) : ?>
            <form action="process_attendance.php" method="post">
                <input type="hidden" name="selected_file" value="<?php echo $selectedFile; ?>">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
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
                        <?php foreach ($attendanceRecords as $record) : ?>
                            <?php if (!empty(array_filter($record))) : ?>
                                <tr>
                                    <?php foreach ($record as $index => $value) : ?>
                                        <td><?php echo $value; ?></td>
                                    <?php endforeach; ?>
                                    <td>
                                        <select name="attendance[<?php echo $record[0]; ?>]" class="form-select">
                                            <option value="Present">Present</option>
                                            <option value="Absent">Absent</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Attendance</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>

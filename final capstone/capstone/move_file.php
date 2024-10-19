<?php

session_start(); // Start the session
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();}

// Check if the filename is provided as a query parameter
if (isset($_GET['filename'])) {
    // Define the source folder path
    $sourceFolder = "records/";

    // Define the destination folder path
    $destinationFolder = "folders/";

    // Get the filename from the query parameter
    $filename = $_GET['filename'];

    // Check if the file exists in the source folder
    if (file_exists($sourceFolder . $filename)) {
        // Get the list of folders in the destination directory
        $folders = array_diff(scandir($destinationFolder), array('.', '..'));

        if (isset($_POST['destinationFolder'])) {
            $selectedFolder = $_POST['destinationFolder'];
            $destinationFolder = $destinationFolder . $selectedFolder . "/";
            // Check if the selected folder exists
            if (!is_dir($destinationFolder)) {
                echo "<script>alert('Selected folder does not exist.');</script>";
            } else {
                // Move the file from the source folder to the selected destination folder
                if (rename($sourceFolder . $filename, $destinationFolder . $filename)) {
                    echo "<script>alert('File moved successfully.');</script>";
                    echo "<script>window.location.href = 'folders.php';</script>";
                    exit; // Exit after redirect
                } else {
                    echo "<script>alert('Failed to move file.');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('File not found.');</script>";
    }
} else {
    echo "<script>alert('Filename not provided.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS for table styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 0px;
        }

        h2 {
            color: #DC3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
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
        .btn-primary {
        --bs-btn-color: #fff;
        --bs-btn-bg: #8f1111;
        --bs-btn-border-color: #8f1111;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #8f1111;
        --bs-btn-hover-border-color:#8f1111;
        --bs-btn-focus-shadow-rgb: 49,132,253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #0a58ca;
        --bs-btn-active-border-color: #0a53be;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #0d6efd;
        --bs-btn-disabled-border-color: #0d6efd;
        }
    </style>
</head>
<body>
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
    <div class="container mt-5">
        <h2>Move File</h2>
        <form action="#" method="post">
            <div class="mb-3">
                <label for="destinationFolder" class="form-label">Select Destination Folder:</label>
                <select class="form-select" id="destinationFolder" name="destinationFolder" required>
                    <option value="" selected disabled>Select Folder</option>
                    <?php
                    // Display dropdown options for each folder
                    foreach ($folders as $folder) {
                        echo "<option value='{$folder}'>{$folder}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Move File</button>
        </form>
        <!-- Back button -->
        <a href="folders.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html>

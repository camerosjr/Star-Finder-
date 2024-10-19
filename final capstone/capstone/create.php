<?php
include("connection.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit; // Make sure to exit after redirecting
}

// Function to create the 'folders' directory if it doesn't exist
function createFoldersDirectoryIfNeeded() {
    $foldersPath = "../capstone/folders";
    if (!is_dir($foldersPath)) {
        mkdir($foldersPath, 0777, true);
    }
}

// Check if 'folders' directory exists, if not, create it
createFoldersDirectoryIfNeeded();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Folder</title>
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
            background-color:#8f1111 !important; /* Set the background color to red */
        }
        .navbar .collapse {
            background: #8f1111;
        }
        .navbar {
        padding: 20px;
        background:#dc3545;
        }
        .navbar .navbar-brand i {
        font-size: 25px;
        background: #8f1111;
        border-radius: 50%;
        padding: 10px 15px;
        }
        .btn-primary {
        --bs-btn-color: #fff;
        --bs-btn-bg:#8f1111;
        --bs-btn-border-color: #8f1111;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #0b5ed7;
        --bs-btn-hover-border-color: #0a58ca;
        --bs-btn-focus-shadow-rgb: 49,132,253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #0a58ca;
        --bs-btn-active-border-color: #0a53be;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #0d6efd;
        --bs-btn-disabled-border-color: #0d6efd;
        }
        .btn-secondary {
        --bs-btn-color: #fff;
        --bs-btn-bg: #8f1111;
        --bs-btn-border-color: #8f1111;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #5c636a;
        --bs-btn-hover-border-color: #565e64;
        --bs-btn-focus-shadow-rgb: 130,138,145;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #565e64;
        --bs-btn-active-border-color: #51585e;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #6c757d;
        --bs-btn-disabled-border-color: #6c757d;
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create Folder
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <label for="folderName" class="form-label">Folder Name</label>
                                <input type="text" class="form-control" id="folderName" name="folderName" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="createFolder">Create</button>
                            <a href="home.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            
                        </form>
                        <?php
                        if (isset($_POST['createFolder'])) {
                            $folderName = $_POST['folderName'];
                            $folderPath = "../capstone/folders/$folderName";
                            if (!is_dir($folderPath)) {
                                if (mkdir($folderPath, 0777, true)) {
                                    echo "<div class='alert alert-success mt-3' role='alert'>Folder created successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger mt-3' role='alert'>Failed to create folder.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning mt-3' role='alert'>Folder already exists!</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>

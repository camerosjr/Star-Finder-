<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit; // Make sure to exit after redirecting
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_extension = array("csv");
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        // Check file extension
        if (in_array($extension, $allowed_extension)) {
            $file_name = $_FILES["file"]["name"];
            $file_temp = $_FILES["file"]["tmp_name"];
            // Move uploaded file to desired directory
            if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
                // Redirect to view_uploaded_file.php after successful upload
                header("location: view_uploaded_file.php?file=$file_name");
                exit; // Make sure to exit after redirection
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Only CSV files are allowed.";
        }
    } else {
        // No file selected
        echo "Please select a file to upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV File</title>
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
            --bs-btn-bg: #8f1111;
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
            --bs-btn-bg: #dc3545;
            --bs-btn-border-color: #dc3545;
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
        .upload-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .upload-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #dc3545;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .custom-file input[type=file] {
            height: 0;
            overflow: hidden;
        }

        .custom-file label {
            cursor: pointer;
            background-color: #dc3545;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .custom-file label:hover {
            background-color: #c82333;
        }

        .btn-upload {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-upload:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <!-- Your HTML content here -->

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

    <!-- Main content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form class="upload-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" accept=".csv">
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include your JavaScript and other scripts here -->
</body>

</html>

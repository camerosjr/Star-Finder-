<?php
session_start(); // Start the session

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Folder</title>
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
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #212529;
        }
        .btn {
            margin-top: 20px;
            margin-right: 10px;
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
<div class="container mt-5">
    <h2>Folder Contents</h2>
    <?php
    // Check if folder parameter is set in the URL
// Check if folder parameter is set in the URL
if (isset($_GET['folder'])) {
    $folderName = $_GET['folder'];
    $folderPath = "folders/$folderName";

    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Open the folder
        if ($dir = opendir($folderPath)) {
            // Display each file in the folder
            echo "<ul>";
            while (($file = readdir($dir)) !== false) {
                if ($file != "." && $file != "..") {
                    // Display file name, delete button, and link to view the file
                    echo "<li>";
                    echo "<span>$file</span>"; // Display file name
                    echo "<form action='delete_file.php' method='post'>"; // Form to submit delete request
                    echo "<input type='hidden' name='folder' value='$folderName'>"; // Hidden input for folder name
                    echo "<input type='hidden' name='file' value='$file'>"; // Hidden input for file name
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Delete File</button>"; // Delete button
                    echo "</form>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            // Close the directory handle
            closedir($dir);

            // Count the files in the folder
            $fileCount = count(glob("$folderPath/*.csv"));

            // Display button to view star students if there are files in the folder
            if ($fileCount > 0) {
                echo "<a href='view_all.php?folder=$folderName' class='btn btn-success'>View All Files</a>";
            } else {
                echo "<p>No files found in the folder to analyze.</p>";
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

    <form action="delete_folder.php" method="post">
        <input type="hidden" name="folder" value="<?php echo $folderName; ?>">
        <button type="submit" class="btn btn-danger">Delete Folder</button>
    </form>
    <a href="folders.php" class="btn btn-primary">Back to Folders</a>
</div>
</body>
</html>

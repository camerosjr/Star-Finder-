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
    <title>View Records</title>
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
            background: #8f1111 ;
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
        background: #8f1111 ;
        border-radius: 50%;
        padding: 10px 15px;
        }
        .btn-primary {
        --bs-btn-color: #fff;
        --bs-btn-bg: #8f1111 ;
        --bs-btn-border-color:#8f1111 ;
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
        .btn-danger {
            --bs-btn-color: #fff;
            --bs-btn-bg:#8f1111;
            --bs-btn-border-color: #8f1111;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #8f1111;
            --bs-btn-hover-border-color: #8f1111;
            --bs-btn-focus-shadow-rgb: 225,83,97;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #b02a37;
            --bs-btn-active-border-color: #a52834;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #dc3545;
            --bs-btn-disabled-border-color: #dc3545;
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
    
<?php
// Define the folder path where records are saved
$folder_path = "records/";

// Check if the records folder exists
if (file_exists($folder_path)) {
    // Get all files in the records folder
    $files = scandir($folder_path);

    // Remove . and .. from the list
    $files = array_diff($files, array('.', '..'));

    // Check if there are any files in the folder
    if (count($files) > 0) {
        echo "<h2>View Records</h2>";
        echo "<table>";
        echo "<thead><tr><th>Filename</th><th>Date</th><th>Action</th></tr></thead>";
        echo "<tbody>";

        // Loop through each file and display its name and date
        foreach ($files as $file) {
            // Get the file creation or modification date
            $file_path = $folder_path . $file;
            $file_date = date("Y-m-d H:i:s", filemtime($file_path));

            echo "<tr>";
            echo "<td>{$file}</td>";
            echo "<td>{$file_date}</td>";
            // Move file button
            echo "<td><button class='btn btn-primary move-file-btn' data-filename='{$file}'>Move File</button>";
            // Delete file button
            echo "<button class='btn btn-danger delete-file-btn' onclick=\"deleteFile('{$file}')\">Delete File</button></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";

        // Back button
        echo "<a href='home.php' class='btn btn-primary mt-3'>Back</a>";
    } else {
        echo "No records found.";
    }
} else {
    echo "Records folder does not exist.";
}
?>
<script>
    // JavaScript function to handle moving files
    document.querySelectorAll('.move-file-btn').forEach(item => {
        item.addEventListener('click', event => {
            // Get the filename from the data attribute
            const filename = event.target.getAttribute('data-filename');
            // Redirect to the move file page with the filename as a query parameter
            window.location.href = `move_file.php?filename=${filename}`;
        });
    });

    // JavaScript function to handle file deletion
    function deleteFile(filename) {
        // Confirm with the user before deleting the file
        if(confirm("Are you sure you want to delete this file?")) {
            // Redirect to delete_file.php with the filename as a query parameter
            window.location.href = `delete_file.php?filename=${filename}`;
        }
    }
</script>
</body>
</html>

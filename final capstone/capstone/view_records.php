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
    <title>Latest Attendance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS for table styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: -1px;
        }

        h2 {
            color: #8f1111 ;
        }

        .star-icon {
            color:#8f1111 ; /* Change color as needed */
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

        /* Style for the Save button */
        .save-btn {
            margin-top: 20px;
            margin-right: 10px;
        }

        /* Style for the Back button */
        .back-btn {
            margin-top: 20px;
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
            background-color: #8f1111  !important; /* Set the background color to red */
        }
        .navbar .collapse {
            background:#8f1111 ;
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
<?php
// Include the database connection file
include("connection.php");

// Fetch the latest records from the database
$query = "SELECT student_id, subject_code, section, first_name, last_name, attendance_status, date_time FROM attendance_records WHERE date_time = (SELECT MAX(date_time) FROM attendance_records)";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<h2><span class='star-icon'>&#9733;</span> Latest Attendance Records</h2>";
    echo "<table id='attendance-table'>";
    echo "<thead><tr><th>User ID</th><th>Subject Code</th><th>Section</th><th>First Name</th><th>Last Name</th><th>Attendance</th><th>Date Time</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . (isset($row['student_id']) ? $row['student_id'] : '') . "</td>";
        echo "<td>" . (isset($row['subject_code']) ? $row['subject_code'] : '') . "</td>";
        echo "<td>" . (isset($row['section']) ? $row['section'] : '') . "</td>";
        echo "<td>" . (isset($row['first_name']) ? $row['first_name'] : '') . "</td>";
        echo "<td>" . (isset($row['last_name']) ? $row['last_name'] : '') . "</td>";
        echo "<td>" . (isset($row['attendance_status']) ? $row['attendance_status'] : '') . "</td>";
        echo "<td>" . (isset($row['date_time']) ? $row['date_time'] : '') . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    echo "<form action='savefile.php' method='post'>"; // Updated action to savefile.php
    echo "<button type='submit' class='btn btn-primary save-btn' name='save_records'>Save</button>";
    echo "<button type='button' class='btn btn-secondary back-btn' onclick='history.back()'>Back</button>";
    echo "</form>";
} else {
    echo "<p>No attendance records found.</p>";
}
?>
</body>
</html>

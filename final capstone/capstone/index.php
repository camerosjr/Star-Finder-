<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniwatch: Star Finder</title>
    <img src="img/unistar.png" width="700" height="250">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            border-radius: 10px;
            padding: 150px;
            text-align: center;
            display: flex; /* Added flex property */
            flex-direction: column; /* Stack buttons vertically */
            align-items: center;
                
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo h1, .logo h2 {
            margin: 0;
            padding: 0;
        }
        .button {
            background-color: #8f1111 ;
            color: #fff;
            padding: 10px 200px;
            border: none;
            border-radius: 5px;
            margin: 10px; /* Margin for spacing */
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
        </div>
        <a href="login_admin.php" class="button">ADMIN</a>
        <a href="login.php" class="button">TEACHER</a>
        <a href="student.php" class="button">STUDENTS</a>
    </div>
</body>
</html>
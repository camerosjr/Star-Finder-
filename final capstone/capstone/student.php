<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Attendance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
            color: #212529;
            animation: fadeIn 0.5s ease-in-out; /* Fade in animation */
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            color: #8f1111 ;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"],
        .btn-back {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #8f1111 ;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button[type="submit"]:hover,
        .btn-back:hover {
            background-color: #0056b3;
        }

        .btn-back {
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
        }

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
    <div class="container mt-5">
    <h1>Search Attendance Records</h1>
    <form method="GET" action="viewstudents.php">
        <label for="student_id">Enter your Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <label for="section">Enter your Section:</label>
        <input type="text" id="section" name="section" required>
        <label for="subject_code">Enter your Subject Code:</label>
        <input type="text" id="subject_code" name="subject_code" required>
        <button type="submit" name="search">Search</button>
        <a href="index.php" class="btn-back">Back</a>
    </form>
    </div>
</body>
</html>

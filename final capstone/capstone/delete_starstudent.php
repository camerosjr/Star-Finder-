<?php
// Include the database connection file
include 'connection.php';

// Check if the record ID is provided via POST request
if (isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Delete the record from the star_students table
    $sql = "DELETE FROM star_students WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

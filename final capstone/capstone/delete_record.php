<?php
$file = "star_students.txt";

// Check if the file exists
if (file_exists($file)) {
    // Attempt to delete the file
    if (unlink($file)) {
        echo "<script>alert('Star students\' records have been successfully deleted.')</script>";
        echo "<script>window.location.replace('starstudents.php');</script>";
    } else {
        echo "<script>alert('Error deleting the file.')</script>";
        echo "<script>window.location.replace('starstudents.php');</script>";
    }
} else {
    echo "<script>alert('File not found.')</script>";
    echo "<script>window.location.replace('starstudents.php');</script>";
}
?>

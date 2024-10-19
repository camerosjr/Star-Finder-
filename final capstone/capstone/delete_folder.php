<?php
// Check if the folder name is provided
if (isset($_POST['folder'])) {
    $folderName = $_POST['folder'];
    $folderPath = "folders/$folderName";

    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Delete the folder and its contents
        if (deleteFolder($folderPath)) {
            echo "<script>window.location.href = 'folders.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to delete folder.');</script>";
        }
    } else {
        echo "<script>alert('Folder not found.');</script>";
    }
} else {
    echo "<script>alert('Folder name not provided.');</script>";
}

// Function to recursively delete a folder and its contents
function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return false;
    }

    $files = array_diff(scandir($folderPath), array('.', '..'));

    foreach ($files as $file) {
        if (is_dir("$folderPath/$file")) {
            deleteFolder("$folderPath/$file");
        } else {
            unlink("$folderPath/$file");
        }
    }

    return rmdir($folderPath);
}
?>

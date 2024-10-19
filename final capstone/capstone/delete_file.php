<?php
// Check if the filename parameter is set
if(isset($_GET['filename'])) {
    // Sanitize the filename to prevent directory traversal attacks
    $filename = basename($_GET['filename']);
    
    // Define the folder path where records are saved
    $folder_path = "records/";

    // Construct the full path of the file
    $file_path = $folder_path . $filename;

    // Check if the file exists and delete it
    if(file_exists($file_path) && unlink($file_path)) {
        // File deletion successful, redirect to home.php
        header("Location: home.php");
        exit;
    } else {
        // File deletion failed or file not found
        echo "Failure: Unable to delete the file.";
    }
} else {
    // No filename parameter provided
    echo "Failure: No filename provided.";
}
?>

<?php
// Check if folder and file parameters are set
if(isset($_POST['folder']) && isset($_POST['file'])){
    // Get folder and file names
    $folder = $_POST['folder'];
    $file = $_POST['file'];

    // Define folder path
    $folderPath = "folders/$folder/";

    // Check if the file exists in the folder
    if(file_exists($folderPath . $file)){
        // Attempt to delete the file
        if(unlink($folderPath . $file)){
            // Redirect back to view_folder.php
            header("Location: view_folder.php?folder=$folder");
            exit(); // Ensure no further code execution
        } else {
            // Error occurred while deleting the file
            header("Location: view_folder.php?folder=$folder&error=delete_failed");
            exit(); // Ensure no further code execution
        }
    } else {
        // File does not exist
        header("Location: view_folder.php?folder=$folder&error=file_not_found");
        exit(); // Ensure no further code execution
    }
} else {
    // Folder or file parameters not set
    header("Location: view_folder.php?error=missing_parameters");
    exit(); // Ensure no further code execution
}
?>

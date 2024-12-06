<?php
// Path to the dataset folder
$datasetFolder = 'C:/Dataset';

// Check if the form submitted the file name
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['file'])) {
    $fileName = urldecode($_POST['file']); // Decode the file name from the form

    // Full path to the file
    $filePath = $datasetFolder . '/' . $fileName;

    // Check if the file exists before attempting to delete
    if (file_exists($filePath)) {
        // Delete the file
        if (unlink($filePath)) {
            echo "<p class='text-green-600'>File " . htmlspecialchars($fileName) . " has been deleted successfully.</p>";
        } else {
            echo "<p class='text-red-600'>Sorry, there was an error deleting the file.</p>";
        }
    } else {
        echo "<p class='text-red-600'>The file does not exist.</p>";
    }

    // Redirect back to the dataset folder page after deletion
    header("Location: datasetList.php");
    exit;
} else {
    echo "<p class='text-red-600'>No file selected for deletion.</p>";
}
?>

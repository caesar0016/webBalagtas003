<?php
session_start(); // Start the session

$host = "localhost";
$port = "5432";
$dbName = "webBalagtas03";
$user = "postgres";
$password = "Kuz18647";

// Create connection string
$connectionString = "host=$host port=$port dbname=$dbName user=$user password=$password";

// Establish connection
$conn = pg_connect($connectionString);

if (!$conn) {
    die("Connection Failed: " . pg_last_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newPassword = $_POST['password01'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $userID = $_SESSION['accountid'];

    // Corrected query to update password
    $query = "UPDATE tblAccount SET password = $1 WHERE accountid = $2";

    // Execute the query
    $result = pg_query_params($conn, $query, array($hashedPassword, $userID));

    if ($result) {
        // Redirect to login page after success
        header('Location: login.php');
        exit();
        
    } else {
        // Log the error for debugging purposes
        error_log("Error updating password: " . pg_last_error($conn));

        // Show an alert message to the user
        echo "<script>alert('Failed to update password. Please try again later.');</script>";

        // Redirect to the change password page with an error flag
        header("Location: changePassword.php?error=1");
        exit();
    }
}

// Close the database connection
pg_close($conn);
?>

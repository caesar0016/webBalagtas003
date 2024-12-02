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

// Function to check if username exists
function usernameExists($conn, $username) {
    $sql = "SELECT COUNT(*) FROM tblAccount WHERE username = $1 AND archiveflag = 1";
    $result = pg_query_params($conn, $sql, array($username));
    if ($result) {
        $count = pg_fetch_result($result, 0, 0);
        return $count > 0; // Returns true if the username exists with archiveflag = 1
    }
    return false; // Default to false if the query fails
}

// Retrieve POST data
$name = trim($_POST['name01']);
$username = trim($_POST['username01']);
$password = $_POST['password01'];
$accountType1 = $_POST['account_type']; // Use accountType01 here

// Check if the username already exists
if (usernameExists($conn, $username)) {
    $_SESSION['error_username'] = "Username already exists. Please choose another."; // Set the error message
    header("Location: manageAcc01.php"); // Redirect to your registration form
    exit(); // Make sure to exit after redirection
} else {
    // Hash the password
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    // Prepare the insert query
    $query = "INSERT INTO tblAccount (name, username, password, accounttype) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, array($name, $username, $hashPass, $accountType1));

    if ($result) {
        echo "Account created successfully!";
        header("Location: manageAcc01.php");
        exit(); // Make sure to exit after header redirection
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

// Close the connection
pg_close($conn);
?>

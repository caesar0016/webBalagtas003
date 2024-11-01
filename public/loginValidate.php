<?php
session_start(); // Start the session
$host = "localhost";
$port = "5432";
$dbName = "webBalagtas01";
$user = "postgres";
$password = "Kuz18647";

// Create connection string
$connectionString = "host=$host port=$port dbname=$dbName user=$user password=$password";

// Establish connection
$conn = pg_connect($connectionString);

if (!$conn) {
    die("Connection Failed: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameInput = $_POST['loginUser']; // Keep the original username input
    $passwordInput = $_POST['loginPass']; // Keep the original password input

    // Prepare the SQL query
    $query = "SELECT * FROM tblAccount WHERE username = $1 AND archiveFlag = 1"; // Only fetch active accounts

    $result = pg_query_params($conn, $query, array($usernameInput));

    if ($result) {
        $user = pg_fetch_assoc($result); // Fetch the user data
        // Check if the user exists and password is correct
        if ($user && password_verify($passwordInput, $user['password'])) {
            // Store user's name and account ID in the session
            $_SESSION['name'] = htmlspecialchars($user['name']); //retrieving from db is case sensitive
            $_SESSION['accountid'] = (int)$user['accountid']; // Cast to int for clarity

            echo "Login successful! Welcome, " . $_SESSION['name'] . ".";
            header('Location: mainPage.php'); // Redirect to a welcome page
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "An error occurred during login. Please try again.";
        header("Location: login.php");
        echo "Error: " . pg_last_error($conn); // Query execution error
    }
}

// Close the connection
pg_close($conn);
?>
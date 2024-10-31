<?php
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
    $query = "SELECT * FROM tblAccount WHERE username = $1";
    $result = pg_query_params($conn, $query, array($usernameInput));

    if ($result) {
        $user = pg_fetch_assoc($result); // Fetch the user data

        if ($user && password_verify($passwordInput, $user['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . ".";
            $_SESSION['username'] = $username;
            header('Location: mainPage.php'); // Redirect to a welcome page
            exit();
            header("Location: mainPage.php");
        } else {
            header("Location: login.php?message=Invalid username or password.");
            exit;
        }
    } else {
        echo "Error: " . pg_last_error($conn); // Query execution error
    }
}

// Close the connection
pg_close($conn);
?>

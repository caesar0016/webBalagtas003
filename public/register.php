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

$name = $_POST['name01'];
$username = $_POST['username01'];
$password = $_POST['password01'];
$accountType1 = $_POST['account_type']; // Use accountType01 here

$hashPass = password_hash($password, PASSWORD_DEFAULT);



$query = "Insert into tblAccount(name, username, password, accountType) values($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($name, $username, $hashPass, $accountType1));

if ($result) {
    echo "Account created successfully!";
} else {
    echo "Error: " . pg_last_error($conn);
}

// Close the connection
pg_close($conn);
?>
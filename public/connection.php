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

// Check connection
if (!$conn) {
    die("Connection Failed: " . pg_last_error());
}else{
    echo "Connected Successfully";
}



// Close the connection
pg_close($conn);
?>

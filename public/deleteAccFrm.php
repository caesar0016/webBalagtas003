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
  //  echo "Connected Successfully";
}   

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $userID = intval($_POST['accountid']);

    if(!empty($userID)){
        $query = "Update tblaccount set archiveflag = 0 where accountid = $1";
        $result = pg_query_params($conn, $query, array($userID));

        header("Location: manageAcc.php");
        exit;
    }else{
        echo "Error: Account ID cannot be found. Please try again.";
    }
}else{
    echo "Error: ". pcntl_get_last_error($conn);
}
pg_close($conn);
?>

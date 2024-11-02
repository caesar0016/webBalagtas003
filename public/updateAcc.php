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

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $userID = intval($_POST['sendID']);
            $name = pg_escape_string($_POST['name01']);
            $username = pg_escape_string($_POST['username01']);
            $password = pg_escape_string($_POST['password01']);
            $accountType = pg_escape_string($_POST['userType']);

            $query = "Update tblaccount set name = $1, username = $2, password = $3, accounttype = $4 where accountid = $5";
            $result = pg_query_params($conn, $query, array($name, $username, $password, $accountType, $userID));

            if($result){
                echo "Update Success";
            }else{
                echo "Error: " . pcntl_get_last_error($conn);
            }
           

        }

    }
    
    
    
    // Close the connection
    pg_close($conn);

    
?>
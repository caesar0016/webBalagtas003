<?php

    $host = "localhost";
    $port = "5432";
    $dbName = "webBalagtas03";
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
            $name = trim(pg_escape_string($_POST['name01']));
            $username = trim(pg_escape_string($_POST['username01']));
            $accountType = pg_escape_string($_POST['userType']);
            $password = trim(pg_escape_string($_POST['password01']));

            
            if(!empty($password)){//if password is empty don't update
                //this hash the password
                $haspass = password_hash($password, PASSWORD_DEFAULT);
                
                $query = "Update tblaccount set name = $1, username = $2, password = $3, accounttype = $4 where accountid = $5";
                $result = pg_query_params($conn, $query, array($name, $username, $haspass, $accountType, $userID));
                
            }else{
                $query = "Update tblaccount set name = $1, username = $2, accounttype = $3 where accountid = $4";
                $result = pg_query_params($conn, $query, array($name, $username, $accountType, $userID));
            }
            //Checks if the Update is success or not
            if($result){
                echo "Update Success";
                header("Location: manageAcc.php");
            }else{
                echo "Error: " . pcntl_get_last_error($conn);
            }
        }
    }
    // Close the connection
    pg_close($conn);
?>
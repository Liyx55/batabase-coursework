<?php
    //Create database connection
    $Server="localhost";
     $username="root";
     $psrd="root";
     $dbname = "bidding2";
     $conn= mysqli_connect($Server,$username,$psrd,$dbname);
    // Database configuration
    //Check database connection 
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

?>
<?php
    //Create database connection
    $conn = mysqli_connect("localhost","root","root","bidding2"); // Database configuration
    //Check database connection 
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }
    //Background running 'buyer_email.php' to check if any auction ended,
    //and send auto email to winner and seller notify them the result.
    #require_once 'buyer_email.php'; 
?>
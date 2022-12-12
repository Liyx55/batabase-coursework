<?php 
include_once("header.php");
require("utilities.php");
include('database.php'); 
session_start();
?>


<div class="container">

<h2 class="my-3">My listings</h2>

<?php
  // This page is for showing a user the auction listings they've made.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  


  $_SESSION['logged_in'] = true;
  $userId =  $_SESSION['UserId'];
  //TODO register之后没有办法拿到userid
    // Check user's credentials (cookie/session).
  $sql = "SELECT * FROM bidding where userid = $userId;";  
  $result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//$test = $row['itemname'];
//echo $test;
//echo "1";

           if($userId == null || $userId == ' ')
           {
            echo('<div class="text-center">Please Login!</div>');
            // Redirect to index after 5 seconds
            header("refresh:5;url=login.php"); 
           }
           elseif($result->num_rows > 0){          // Perform a query to pull up their auctions.
                  while($row = mysqli_fetch_assoc($result)) {
                    $item_id = $row['itemid'];
                    $title = $row['itemname'];
                    $desc = $row['description'];
                    $price = $row['currentprice'];
                    $end_time = new DateTime($row['endtime']);
                    $winner = $row['winner'];
                    // Print out item details using the print_mylisting_li function defined in utilities.php
                    print_mylisting_li($item_id, $title, $desc, $price, $end_time, $time_remaining, $winner);
                    }
                    }
                    else{
                      echo 'You have not created any bid products yet.';
                  }
                
                  
  // TODO: Loop through results and print them out as list items.
  
  
?>

<?php include_once("footer.php")?>
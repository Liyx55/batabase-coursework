<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My bids</h2>

<?php
  // This page is for showing a user the auctions they've bid on.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  // TODO: Check user's credentials (cookie/session).
  $userId =  $_SESSION['UserId'];
           if($userId == null || $userId == ' '){
            echo('<div class="text-center">Please Login!</div>');
            // Redirect to index after 5 seconds
            header("refresh:5;url=login.php"); 
           }else{
            // TODO: Perform a query to pull up their auctions.
              
                session_start(); //Start a session 
                $userId =  $_SESSION['UserId']; 
                $sql = "SELECT itemid, itemname, description, state, category, currentprice, endtime, winner FROM bidding where userid = $userId;";  
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0){
                  while($row = mysqli_fetch_assoc($result)) {
                    $item_id = $row['itemid'];
                    $title = $row['itemname'];
                    $desc = $row['description'];
                    $price = $row['currentprice'];
                    $end_time = new DateTime($row['endtime']);
                    $winner = $row['winner'];
                    if($winner == $userId){
                      echo 'you win the bid!';
                    }else{
                      echo 'Winner: $winner';
                    }
                    // Print out item details using the print_mylisting_li function defined in utilities.php
                    print_mylisting_li($item_id, $title, $desc, $price, $end_time, $time_remaining, $wetherwin);
                    }
                    }
                    

                  }
  // TODO: Perform a query to pull up the auctions they've bidded on.
  
  // TODO: Loop through results and print them out as list items.
  
?>

<?php include_once("footer.php")?>



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
  
  
  // TODO: Check user's credentials (cookie/session).


  $userId =  $_SESSION['UserId']; 
  $sqlmylisting = "SELECT itemid FROM bidding where userid = $userId;";
  $resultsml = mysqli_query($conn, $sqlmylisting);
           if($userId == null || $userId == ' ')
           {
            echo('<div class="text-center">Please Login!</div>');
            // Redirect to index after 5 seconds
            header("refresh:5;url=login.php"); 
           }
           elseif($resultsml == NULL){
              echo 'You have not created any bid products yet.';
            }
           else{
            // TODO: Perform a query to pull up their auctions.
              
                $sql = "SELECT itemid, itemname, description, state, category, currentprice, endtime, winner FROM bidding where userid = $userId;";  
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0){
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
                  }
                
                  
  // TODO: Loop through results and print them out as list items.
  
  
?>

<?php include_once("footer.php")?>
<?php 
include_once("header1.php");
require("utilities.php");
include('database.php'); 
session_start();
?>

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
  $sqlhistory = "SELECT itemid, MAX(biddingprice) as usermaxbid FROM biddinghistory where userid = $userId GROUP BY itemid";
  $resulthistory = mysqli_query($conn, $sqlhistory);

  if($userId == null || $userId == ' ')
  {
   echo('<div class="text-center">Please Login!</div>');
   // Redirect to index after 5 seconds
   header("refresh:5;url=login.php"); 
  }
  else{
    while($row1 = mysqli_fetch_assoc($resulthistory)) {
    //echo "1";
        if(($resulthistory->num_rows > 0)){
          $item_id = $row1['itemid'];
          $sqlbid = "SELECT itemid, itemname, description, endtime, winner FROM bidding WHERE itemid='$item_id'";  
          $resultbid = mysqli_query($conn, $sqlbid);
          while($row = mysqli_fetch_assoc($resultbid)){
        //echo "3";  
            $itemid = $row['itemid'];
            $title = $row['itemname'];
            $desc = $row['description'];
            $price = $row1['usermaxbid'];
            $end_time = new DateTime($row['endtime']);
            $winner = $row['winner'];
            print_mybidding_li($itemid, $title, $desc, $price, $end_time, $time_remaining, $winner);
               }       
          }
          else{
            echo 'You have not bid any products yet.';
           }
       

  }
      
    }
 
?>
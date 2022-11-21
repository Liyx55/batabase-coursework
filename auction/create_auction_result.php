<?php include_once("header.php")?>

<div class="container my-5">

<?php
include_once("database.php");
           session_start();
           $userId =  $_SESSION['UserId'];
           if($userId == null || $userId == ' '){
            echo('<div class="text-center">Please Login!</div>');
            // Redirect to index after 5 seconds
            header("refresh:5;url=login.php"); 
           }
           elseif( empty($_POST['auctionTitle']) || empty($_POST['auctionCategory'])|| empty($_POST['auctionStartPrice'])|| empty($_POST['auctionEndDate']) ) {
                     echo('<div class="text-center">Missing information. Please try again</div>');
        // Redirect to index after 5 seconds
                     header("refresh:5;url=create_auction.php");     
            }
            else{
              // upload photo(test)
              $itemid=mysqli_insert_id($conn);
              //var_dump($_FILES);
              $imagname = $_FILES['photofile']['name'];
              $tmp = $_FILES['photofile']['tmp_name'];
              $filepath = 'itemphoto/';
              move_uploaded_file($tmp,$filepath.$imagname.".png");
              //if( move_uploaded_file($tmp,$filepath.$imagname.".png")){
              //  echo"success";
              //}else{
              //  echo "fail";
              //}
            
                
            session_start(); //Start a session
            $userId =  $_SESSION['UserId'];  
            $name = mysqli_real_escape_string($conn, $_POST['auctionTitle']);
            $detail = mysqli_real_escape_string($conn, $_POST['auctionDetails']);
            $startprice = mysqli_real_escape_string($conn, $_POST['auctionStartPrice']);
            $reserveprice = mysqli_real_escape_string($conn, $_POST['auctionReservePrice']);
            $endtime = mysqli_real_escape_string($conn, $_POST['auctionEndDate']); 
            $category = mysqli_real_escape_string($conn, $_POST['auctionCategory']);
            if (empty($_POST['auctionReservePrice'])){
              $reserveprice = 0;
          }
          if (empty($_POST['auctionDetails'])){
              $description = 'No Details';
          }
        $query = "INSERT INTO bidding(userid,itemname,category,startingprice,reserveprice,currentprice,endtime,description)
           VALUES ('$userId','$name','$category','$startprice','$reserveprice','$startprice','$endtime','$detail');";
        $result = mysqli_query($conn,$query)
           or die('Error making saveToDatabase query');
        mysqli_close($conn);
            
// If all is successful, let user know.
echo('<div class="text-center">Auction successfully created! <a href="mylistings.php">View your new listing.</a></div>');
}
?>

</div>


<?php include_once("footer.php")?>
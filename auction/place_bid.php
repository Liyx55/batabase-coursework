<?php include_once("header.php")?>
<?php require("utilities.php")?>

<?php
  include_once("database.php");
  session_start();
  $Item_id = $_SESSION["Item_Id"];// Get info from ?:
  $userId = $_SESSION['UserId'];
  $newprice = $_POST['placebid'];

  if(isset($_POST['placebid'])){

    $query = "SELECT * FROM bidding WHERE userid ='$userId'";
    $Result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($Result);
    $Buyer=$row['userId'];//TODO 改成userid就可以正常使用了

    if($Buyer==$userId)
     {
    	echo"<script>alert('This Is Your Product, You Can Not Bid Your Own Product!');</script>";
      header("refresh:0.5;url= browse.php");
    }
    else{
      $sqlprice = "SELECT * FROM bidding WHERE itemid = $Item_id";
      $priceresult = mysqli_query($conn,$sqlprice);
      $row1 = mysqli_fetch_assoc($priceresult);
      $price1=$row1['currentprice'];
      
      
      if($_POST['placebid'] <= $price1)
      {
      echo"<script>alert('You must bid higher than the base price');</script>";
      header("refresh:0.5;url= listing.php?item_id=$Item_id");
     }
     else
     {

      
      echo"<script>alert( 'Your bid is successfull!');</script>";
      $insertprice = "INSERT INTO biddinghistory (bidid, userid, itemid, biddingprice, biddingdate) VALUES (NULL, $userId, $Item_id, $newprice, CURRENT_TIMESTAMP)";
      $run = mysqli_query($conn,$insertprice) or die(mysqli_error($conn));
      $updateprice = "UPDATE bidding SET currentprice = $newprice WHERE itemid = $Item_id";
      $runupdate = mysqli_query($conn,$updateprice) or die(mysqli_error($conn));
      $conn->close();
      header("refresh:0.5;url= browse.php");
      

    }
     }
     }
     
       
      
       
      
     
  ?>

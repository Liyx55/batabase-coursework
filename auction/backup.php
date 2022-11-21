<?php include_once("header.php")?>
<?php require("utilities.php")?>

<?php
  include_once("database.php");
  session_start();
  $item_id = $_SESSION['ItemId'];// Get info from the URL:
  $userId = $_SESSION['UserId'];

  if(isset($_POST['placebid'])){

    $query = "SELECT * FROM bidding WHERE userid ='$userId'";
    $Result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($Result);
    $Buyer=$row['userId'];//改成userid就可以正常使用了

    if($Buyer==$userId)
     {
    	echo"<script>alert('This Is Your Product, You Can Not Bid Your Own Product!');</script>";
    }
    else{
      $sqlprice = "SELECT * FROM bidding WHERE itemid = $item_id";
      $priceresult = mysqli_query($conn,$sqlprice);
      $row1 = mysqli_fetch_assoc($priceresult);
      $price1=$row1['currentprice'];
      
      if($_POST['placebid'] <= $price1)
      {
      echo"<script>alert('You must bid higher than the base price');</script>";
     }
     else
     {
      echo"<script>alert( 'Your bid is successfull!');</script>";
      
    }
     }
       }
      
       
      
     
  ?>
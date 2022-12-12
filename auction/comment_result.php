<?php 
  include 'database.php'; //Connect to the database
  #include 'listing.php';
  //When user submit the register form 
  session_start();
  $Item_id = $_SESSION["Item_Id"];
  $userId =  $_SESSION['UserId'];
  $_SESSION["Item_Id"] = $Item_id;
  $has_session = true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required boxes are NOT empty
    if(!empty($_POST['Score']) 
    && !empty($_POST['Message'])) {
      // Receive all input values from "Register Form"	 
      $Score = $_POST['Score'];
      $Message = $_POST['Message'];
      $sql = "INSERT INTO `feedback`(`userid`, `itemid`, `score`,`message`,`reviewdate`) 
      VALUES ('$userId','$Item_id','$Score','$Message',NOW())";
      $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      echo '<script>alert("comment success!!!")</script>';
      header("refresh:0.5;url=listing.php?item_id=$Item_id"); 
    }
        
}

?>
 <?php
 include 'database.php'; //Connect to the database
 //Get current session 
 session_start(); 
 $user_id = $_SESSION['UserId']; 
 $item_id = $_SESSION['Item_Id']; 
 //$functionname = $_SESSION['functionname'];
 $functionname = $_GET['functionname'];
 //echo $functionname;

if ($functionname == "add_to_watchlist") {
  // TODO: Update database and return success/failure.
  $sql = "INSERT INTO watchlist (userid, itemid) VALUES ('$user_id', '$item_id')";
  $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  //header('Location: ' . $_SERVER['HTTP_REFERER']);
  $res = "success";
}
else if ($functionname == "remove_from_watchlist") {
  // TODO: Update database and return success/failure.
  mysqli_query($conn,"DELETE FROM WatchList WHERE userid = '$user_id' AND itemid = '$item_id'");
  //header('Location: ' . $_SERVER['HTTP_REFERER']);
  $res = "success";
}

// Note: Echoing from this PHP function will return the value as a string.
// If multiple echo's in this file exist, they will concatenate together,
// so be careful. You can also return JSON objects (in string form) using
// echo json_encode($res).
echo $res;

?>
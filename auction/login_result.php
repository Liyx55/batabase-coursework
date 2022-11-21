<?php
include_once("database.php");
// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

#session_start();
$_SESSION['logged_in'] = true;
$_SESSION['username'] = "test";
$_SESSION['account_type'] = "buyer";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    $email = mysqli_real_escape_string($conn,$_POST['Email']); 
    $password = mysqli_real_escape_string($conn,$_POST['Password']); 
    //Hash password
    $password = md5($password); 
    //Queyr to get UserId based on user login form entry
    $sql = "SELECT userid FROM userinfo WHERE Email = '$email' and Password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    // If result matched email and password, table row must be 1 row
    if($count == 1) {
      session_start(); //start a session
      //Set session variables
      $_SESSION['logged_in'] = true; 
      $_SESSION['Email'] = $email;
      $userId = current($conn->query("SELECT userid FROM userinfo WHERE Email = '$email'")->fetch_assoc());
      $_SESSION['UserId'] = $userId; 
      header("refresh:0.5;url= browse.php"); //Auto refresh to browse.php
      echo '<script>alert("You are now logged in! You will be redirected shortly.")</script>';
    }else { //If no user found
      echo '<script>alert("Wrong username/password combination")</script>';
      $_SESSION['logged_in'] = false; //Set session variable logged_in as false, so user stay logged out and can't access content of the rest of the site
      header("refresh:0.5; url=login.php"); //Auto refresh back to login.php
    }                   
  }


// Redirect to index after 5 seconds
header("refresh:0.5;url=index.php");
$conn->close();
?>
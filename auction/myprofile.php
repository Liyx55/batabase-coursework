<?php 
include_once("header1.php");
require("utilities.php");
include('database.php'); 
session_start();
?>

<div class="container">

<h2 class="my-3">My Profile</h2>

<table class="table table-striped" style='text-align:center' height=500px>
<?php
    $userId =  $_SESSION['UserId']; 
    $sqlhistory = "SELECT userid, username, password, fullname, email, jointime, role FROM userinfo where userid = $userId ";
    $resulthistory = mysqli_query($conn, $sqlhistory);
    if($userId == null || $userId == ' ')
    {
      echo('<div class="text-center">Please Login!</div>');
    // Redirect to index after 5 seconds
      header("refresh:5;url=login.php"); 
    }
    else{
        while($row = mysqli_fetch_assoc($resulthistory)) 
        {
        #profile 
        $userId = $row['userid'];
        $username = $row['username'];
        $password = $row['password'];
        $fullname = $row['fullname'];
        $email = $row['email'];
        $jointime = $row['jointime'];
        $role=$row['role'];
        }
    }
?>
    <tr>
      <th>Username</th>
      <th><?php echo $username?></th>
    </tr>
    <tr>
      <th>Fullname</th>
      <th><?php echo $fullname?></th>
    </tr>
    <tr>
      <th>Email</th>
      <th><?php echo $email?></th>
    </tr>
    <tr>
      <th>jointime</th>
      <th><?php echo $jointime?></th>
    </tr>
    <tr>
      <th>Role</th>
      <th><?php if($role==1){echo "buyer";}
      else{echo "seller";}      
      ?></th>
    </tr>
  </table>
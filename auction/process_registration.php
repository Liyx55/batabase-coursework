<?php 
  session_start();
  #include_once("header.php");
  include 'database.php'; //Connect to the database
  //When user submit the register form 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required boxes are NOT empty
    if(!empty($_POST['UserName']) 
    && !empty($_POST['Fullname']) 
    && !empty($_POST['Email']) 
    && !empty($_POST['Password'])
    && !empty($_POST['passwordConfirmation'])) {
      // Receive all input values from "Register Form"	 
      $UserName = $_POST['UserName'];
      $Fullname = $_POST['Fullname'];
      $email = $_POST['Email'];
      $password = $_POST['Password'];
      $passwordConfirmation = $_POST['passwordConfirmation'];
      //Query to check if email address already exists in the database 
      $check_email = mysqli_query($conn, "SELECT email FROM userinfo WHERE email = '$email'");
      //If If result matched email  table row will be greater than 0
      if(mysqli_num_rows($check_email) != 0 ){ 
        echo '<script>alert("User already exists!")</script>';
        header("refresh:0.5;url= register.php");
      }else{
        if (!isset($_POST['Password']) or !isset($_POST['passwordConfirmation'])) {
          echo '<script>alert("Please enter the password")</script>';
          header("refresh:0.5;url= register.php");
      } elseif (trim($_POST['Password']) != trim($_POST['passwordConfirmation'])) {
          echo '<script>alert("Please enter matching valid password")</script>';
          header("refresh:0.5;url= register.php");
      }else{
        $password = md5($password); //Hash password
        //Query to insert new user into database
        $sql = "INSERT INTO `userinfo`(`username`, `fullname`, `email`,`password`,`jointime`,`role`) 
        VALUES ('$UserName','$Fullname','$email','$password',NOW(),'1')";
        $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $_SESSION['logged_in'] = true;
        $_SESSION['UserName'] = $UserName;
        $_SESSION['Email'] = $email; //Set session variable Email as user's email address 
        echo '<script>alert("Welcome!!!")</script>';
        header("refresh:0.5;url= browse.php"); //Auto fresh to browse.php
      }
        
      }
    }
    mysqli_close($conn);
  }
  ?>
</div>
<?php include_once("footer.php")?>
<?php
  // FIXME: At the moment, I've allowed these values to be set manually.
  // But eventually, with a database, these should be set automatically
  // ONLY after the user's login credentials have been verified via a 
  // database query.
  include 'database.php'; // Connect to the database
  #include 'process_registration.php';
  
  #$_SESSION['logged_in'] = false;
  #$_SESSION['account_type'] = 'buyer'; 
  error_reporting(E_ERROR | E_PARSE);
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap and FontAwesome CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="css/custom.css">

  <title>[My Auction Site] <!--CHANGEME!--></title>
</head>


<body>
    <!-- Navbars -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mx-2">
      <!-- Navigate to index.php when user click on it -->
      <a class="navbar-brand" href="browse1.php">Bid Everything</a> 
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"> 
          <?php
            session_start();
            // Displays either login or logout on the right, depending on user's current status (session).
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
              $email = $_SESSION['Email'] ;
              $UserName= $_SESSION['UserName'];
              echo $email;
              echo '<a class="nav-link" href="logout.php"> Logout</a>';
            }else {
              echo '<button type="button" class="btn nav-link" ><a class="nav-link" href="login.php">Login<a/></button>';
            }
          ?>
        </li>
      </ul>
    </nav>

    <!-- All buttons navigating to different pages.  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="browse1.php">Browse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="watchlist.php">WatchList</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="recommendations.php">Recommendation</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mybids.php">My Bids</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <!-- Buyer and seller buttons -->
          <li><a class="btn btn-success my-2 my-sm-0" href="myprofile.php" role="button">My Profile</a></li>
        </form>
      </div>
    </nav>
  </body>


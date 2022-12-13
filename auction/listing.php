<?php require("utilities.php")?>
<?php 
session_start();
if(@$_SESSION['account_type'] == "seller"){include_once("header2.php");}
else{include_once("header1.php");}?>
<?php
  // Get info from the URL:
  include_once("database.php");
  session_start();
  $item_id = $_GET['item_id'];
  $userId =  $_SESSION['UserId'];
  $_SESSION["Item_Id"] = $item_id;
  //echo $item_id;
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require 'PHPMailermaster/src/Exception.php';
  require 'PHPMailermaster/src/PHPMailer.php';
  require 'PHPMailermaster/src/SMTP.php';


  // TODO: Use item_id to make a query to the database.
  $itemsql = "SELECT * FROM bidding WHERE itemid = $item_id";
  $result = $conn->query($itemsql);
  //if($result){
   // echo 'succeed';
  //}
  //echo  $itemsql;
  $itemresult = mysqli_query($conn,$itemsql);
  while($row = mysqli_fetch_assoc($itemresult)){
    $title = $row['itemname'];
    $item_user = $row['userid'];
    $description = $row['description'];
    $state = $row['state'];
    $category = $row['category'];
    $current_price = $row['currentprice'];
    $reserve_price = $row['reserveprice'];
    $end_time = new DateTime($row['endtime']);
    $buyerid = $row['buyer'];
  };
  session_start();
  $_SESSION['buyerid'] = $buyerid;
  //echo $buyerid;
  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not.
  
  // Calculate time to auction end:
  $now = new DateTime();
  //print_r($now->format('Y-m-d H:i:s'));
  //print_r($end_time->format('Y-m-d H:i:s'));

  
  if ($now < $end_time) {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  $findexistingsql = "SELECT * FROM Watchlist WHERE UserId = $userId AND ItemId=$item_id";
  $findexistingresult = mysqli_query($conn,$findexistingsql);
  $count = mysqli_num_rows($findexistingresult);
  if ($count>0){
    $has_session = true;
    $watching = true;
    //$functionname = 'remove_from_watchlist';
    //session_start();
  //$_SESSION['functionname'] = $functionname;
  //echo $functionname;
  }else{
  $has_session = true;
  $watching = false;
  //$functionname = 'add_to_watchlist';
  //  session_start();
  //$_SESSION['functionname'] = $functionname;
  //echo $functionname;
  }
?>


<div class="container">
  <!-- Print Name of the item as the title of the page-->
  <br><h1 class="my-3"><?php echo($title); ?></h1><hr><br> 
  <div class="row"> <!--Start of first row -->
    <!-- Left Column: Item details -->
    <div class="col-sm-8"> 
    <div class="itemDescription">
        <?php 
          echo('<strong>Description</strong>: '.$description.'<br>'); 
          echo('<strong>Cateogry</strong>: '.$category.'<br>');
        ?>
      </div>
    </div>


  <div class="col-sm-4 align-self-center"> <!-- Right col -->
<?php
  /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
  if ($now < $end_time):
?>
    <div id="watch_nowatch" <?php if ($has_session && $watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
    </div>
    <div id="watch_watching" <?php if (!$has_session || !$watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
    </div>
<?php endif /* Print nothing otherwise */ ?>
  </div>
</div>

<div class="row"> <!-- Row #2 with auction description + bidding info -->
  <div class="col-sm-8"> <!-- Left col with item info -->

    <div class="itemPhoto">
    <?php echo '<img class="card-img-top img-fluid " width="80px" style="margin-top: 20px;" src="itemphoto/'.$_GET['item_id'].'.jpg" alt="image description"></td>'; ?>
    </div>

  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->

    <p>
      
          <!-- TODO: Print the result of the auction here? -->
    <?php 
    if ($now > $end_time): {
      echo "This auction ended in ";
      echo(date_format($end_time, 'j M H:i'));
      if($current_price>=$reserve_price){
        echo "<br/>The price is: ".$current_price;
        $sqlmaxbidder = "SELECT userid FROM biddinghistory WHERE itemid = $item_id AND biddingprice = $current_price";
        $resultmax =  mysqli_query($conn, $sqlmaxbidder);
        $assign = mysqli_fetch_assoc($resultmax);
        $winner = $assign['userid'];
        echo "<br/>The winner is: ".$winner;
        $insertwinner = "UPDATE bidding SET winner = $winner WHERE itemid = $item_id";
        $runinsert = mysqli_query($conn,$insertwinner) or die(mysqli_error($conn));
        
        $sqlmaxbidderemail = "SELECT email FROM userinfo WHERE userid = $winner";
        $resultemail1 = mysqli_query($conn, $sqlmaxbidderemail);
        $do = mysqli_fetch_assoc($resultemail1);
        $winneremail = $do['email'];

        $sqlseller = "SELECT userid FROM bidding WHERE itemid = $item_id";
        $resultemail1 = mysqli_query($conn, $sqlseller);
        $do1 = mysqli_fetch_assoc($resultemail1);
        $seller = $do1['userid'];

        $sqlselleremail = "SELECT email FROM userinfo WHERE userid = $seller";
        $resultemail2 = mysqli_query($conn, $sqlselleremail);
        $do2 = mysqli_fetch_assoc($resultemail2);
        $selleremail = $do2['email'];

        $towinner = "Congratulations! You have won the product! The product ID is:".$item_id; //发送的邮件内容 html写的
        $toseller = "Congratulations! Your product is sold out! Go back to check the winner.";

        
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions        
            
            $mail->CharSet ="UTF-8";                     
            $mail->SMTPDebug = 0;                        
            $mail->isSMTP();                             
            $mail->Host = 'smtp.gmail.com';                
            $mail->SMTPAuth = true;                     
            $mail->Username = 'bbcoursework@gmail.com';                
            $mail->Password = 'csmxmyedjlybaaao';            
            $mail->SMTPSecure = 'tls';   
            $mail->SMTPAutoTLS = false;                
            $mail->Port = 587;                            
        
            $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup');  
            $mail->addAddress($winneremail,$winner);  
            //$mail->addAddress('ellen@example.com');  
            $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); 
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Winner Announce';
            $mail->Body = $towinner;
            $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';
        
            $mail->send();        

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions        
            
            $mail->CharSet ="UTF-8";                     
            $mail->SMTPDebug = 0;                        
            $mail->isSMTP();                            
            $mail->Host = 'smtp.gmail.com';                
            $mail->SMTPAuth = true;                      
            $mail->Username = 'bbcoursework@gmail.com';               
            $mail->Password = 'csmxmyedjlybaaao';             
            $mail->SMTPSecure = 'tls';   
            $mail->SMTPAutoTLS = false;                
            $mail->Port = 587;                            
        
            $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup'); 
            $mail->addAddress($selleremail,$seller);  
            //$mail->addAddress('ellen@example.com');  
            $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); 
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Winner Announce';
            $mail->Body = $toseller;
            $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';
        
            $mail->send();

      }else{
        echo "<br/>The auction was cancelled due to lack of high-enough bids.";
      }
    }
      ?>
      <?php else: ?>
          Auction ends <?php echo(date_format($end_time, 'j M H:i') . $time_remaining) ?></p>  
          <p class="lead">Current bid: £<?php echo(number_format($current_price, 2)) ?></p>

    <!-- Bidding form -->
    <form method="POST" action="place_bid.php">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
	    <input type="number" name="placebid" class="form-control" id="bid">
      </div>
      <button type="submit" class="btn btn-primary form-control">Place bid</button>
    </form>
<?php endif ?>

  
  </div> <!-- End of right col with bidding info -->

</div> <!-- End of row #2 -->
<div>
        <p>Bid History:</p>
        <!-- get bidrecord data and print in a table -->
        <table class="table table-striped" style='text-align:center'>
          <tr>
            <th>Bid Amount</th>
            <th>Bid Date & Time</th>
          </tr>
          <?php 
            //Query to get data from BidRecord table depend on item_id order by the price from highest to lowest
            $bidhistory = "SELECT biddingprice, biddingdate FROM biddinghistory WHERE itemid=$item_id ORDER BY biddingprice DESC";
            $bidresult = $conn->query($bidhistory); 
            while($row = $bidresult->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['biddingprice']?></td>
              <td><?php echo $row['biddingdate']?></td>
            </tr>
          <?php }$conn->close();?>
        </table>
      </div>
<div>
  <p>Comment and Rate:</p>
  <form method="POST" action="comment_result.php">
    
    <div class="form-group row">
      <label for="Score" class="col-sm-3 col-form-label text-right">Score <span class="text-danger"></span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="Score" required>
    </div>
    </div>
    <div class="form-group row">
      <label for="Message" class="col-sm-3 col-form-label text-right">Message <span class="text-danger"></span></label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="Message" required>
      </div>
    </div>
    <!-- Submit button -->
    <div class="form-group row">
      <button type="submit" class="btn btn-primary form-control">submit</button>
    </div>
  </form>
  <!-- <table class="table table-striped" style='text-align:center'>
    <tr>
      <th>Score(0-5)</th>
      <th>Message</th>
    </tr>
    <tr>
    <td><input type="text" class="form-message" name="Score" required></td>
    <td><input type="text" class="form-message" name="Message" required></td>
    </tr>
  </table>
  <div class="form-group row">
      <button type="submit" class="btn btn-primary form-control">submit</button>
    </div> -->
</div>
<?php $conn->close();?>
<?php include_once("footer.php")?>


<script> 
// JavaScript functions: addToWatchlist and removeFromWatchlist.

function addToWatchlist(button) {
  console.log("These print statements are helpful for debugging btw");

  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "GET",
    data: {functionname: 'add_to_watchlist', arguments: [<?php echo($item_id);?>]},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
       
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_nowatch").hide();
          $("#watch_watching").show();
        }
        else {
          var mydiv = document.getElementById("watch_nowatch");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func

function removeFromWatchlist(button) {
  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "GET",
    data: {functionname: 'remove_from_watchlist', arguments: [<?php echo($item_id);?>]},

    success: 
      function (obj, textstatus) {
       
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_watching").hide();
          $("#watch_nowatch").show();
        }
        else {
          var mydiv = document.getElementById("watch_watching");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call
} // End of addToWatchlist func
</script>
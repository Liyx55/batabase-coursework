<?php include_once("header.php")?>
<?php require("utilities.php")?>
<?php session_start()?>

<?php
  include 'database.php';
  $item_id = $_GET['itemid'];// Get info from the URL:
  $user_id = $_SESSION['userid'];

  // TODO: Use item_id to make a query to the database.
  $itemsql = "SELECT * FROM 'bidding' WHERE itemid = $item_id";
  $itemresult = mysqli_query($conn,$itemsql);
  while($row = mysqli_fetch_assoc($itemresult)) {
    $title = $row['itemname'];
    $item_user = $row['userid'];
    $description = $row['description'];
    $state = $row['state'];
    $category = $row['category'];
    $current_price = $row['currentprice'];
    $end_time = new DateTime($row['endtime']);
  };

  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not.
  
  // Calculate time to auction end:
  $now = new DateTime();
  
  if ($now < $end_time) {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  $has_session = true;
  $watching = false;
?>


<div class="container">

<div class="row"> <!-- Row #1 with auction title + watch button -->
  <div class="col-sm-8"> <!-- Left col -->
    <h2 class="my-3"><?php echo($title); ?></h2>
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

    <div class="itemDescription">
    <?php echo($description); ?>
    </div>

  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->

    <p>
      <?php if ($now > $end_time): ?>
          This auction ended <?php echo(date_format($end_time, 'j M H:i')) ?>
          <!-- TODO: Print the result of the auction here? -->
      <?php else: ?>
          Auction ends <?php echo(date_format($end_time, 'j M H:i') . $time_remaining) ?></p>  
          <p class="lead">Current bid: £<?php echo(number_format($current_price, 2)) ?></p>
          <?php 
                // bidding history 
                if($current_price!=NULL){
                  session_start();
                  $_SESSION['isbid'] = "1";
                  echo ('£'.$current_price.'');
                }else{
                  session_start();
                  $_SESSION['isbid'] = "0";
                  echo "No Bid Yet!";
                }
              ?>


    <!-- Bidding form -->
    <?php 
        include 'database.php'; //Connect to the database
        session_start();
        $_SESSION['itemid'] = $item_id;
      ?>
    <!-- Check if current user is the seller -->
    <?php if ($item_user!=$user_id):?>

    <form method="POST" action="place_bid.php">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
	    <input type="number" class="form-control" id="bid">
      </div>
      <button type="submit" class="btn btn-primary form-control">Place bid</button>
    </form>
    <?php endif ?>
    <?php $conn->close();?>
  
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
            include 'database.php'; 
            //Query to get data from BidRecord table depend on item_id order by the price from highest to lowest
            $bidhistory = "SELECT biddingprice, biddingdate FROM biddinghistory WHERE itemid =  $item_id ORDER BY biddingprice DESC";
            $bidresult = $conn->query($bidhistory); 
            while($row = $bidresult->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['BidPrice']?></td>
              <td><?php echo $row['BidDateTime']?></td>
            </tr>
          <?php }$conn->close();?>
        </table>
      </div>
    <?php endif ?>


<?php include_once("footer.php")?>


<script> 
// JavaScript functions: addToWatchlist and removeFromWatchlist.

function addToWatchlist(button) {
  console.log("These print statements are helpful for debugging btw");

  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
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
    type: "POST",
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
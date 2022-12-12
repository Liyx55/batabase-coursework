<?php session_start();
if($_SESSION['account_type'] == "buyer"){include_once("header1.php");}
else{include_once("header2.php");}?>
<?php require("utilities.php")?>

<div class="container">
  <h2 class="my-4">Watching list</h2>
    <div class="container mt-5">
      <ul class="list-group">
      <?php
        include 'database.php'; 
        $search = $_GET['search']; // Get What user entered in the search bar
        $category = $_GET['category']; // Get user's selected category from the list
        $sortby = $_GET['order_by']; //Get user's selected sort by option
        session_start();
        $userId =  $_SESSION['UserId'];

        //echo '<script>alert("$search")</script>';
        //GROUP BY category
        //AND endtime >= CURRENT_TIMESTAMP
        $swlwatch = "SELECT itemid FROM watchlist where userid = $userId";
        $resultwatch = mysqli_query($conn,$swlwatch);
        while($row1 = mysqli_fetch_assoc($resultwatch)){
        $item_id = $row1['itemid'];
        $sql = "SELECT i.itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
          FROM bidding   i
          WHERE itemid = $item_id AND endtime >= CURRENT_TIMESTAMP";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)) {
            $item_id = $row['itemid'];
            $title = $row['itemname'];
            $description = $row['description'];
            $price = $row['highest_price'];
            $end_time = new DateTime($row['endtime']);
            $nums="SELECT count(*)as numbers FROM biddinghistory where itemid=$item_id group by itemid";
            $numsresult=mysqli_query($conn,$nums);
            $row1 = mysqli_fetch_assoc($numsresult);
            if($row1['numbers']==0){
              $num_bids=0;
            }else{
              $num_bids = $row1['numbers'];
            }
            // Print out item details using the print_listing_li function defined in utilities.php
            print_listing_li($item_id, $title, $description, $price ,$num_bids,$end_time );
          } 
        }
      ?> 
      </ul>
      <!-- If user is not logged in, message below will be shown to indicate they need to log in first before access any contents -->
    </div>
</div>
<?php include_once("footer.php")?>
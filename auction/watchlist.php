<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">
  <h2 class="my-4">Watching list</h2>
  <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true):?> 
    <div id="searchSpecs">
      <!-- Filterings that allow user to re-arrange listings of items based on search bar, sortby, and category -->
      <form method="GET" action="browse.php">
        <div class="row">
          <div class="col-md-5 pr-0">
            <!-- Search bar -->
            <div class="form-group">
              <div class="input-group">
                <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
              </div>
            </div>
          </div>
          <div class="col-md-3 pr-0">
            <!-- Category drop-down menu -->
            <div class="form-group">
              <select class="form-control" name="category">
                <option value="" disabled selected>Select your category</option>
                <option value="bedroom">bedroom</option>
                <option value="living Room">living Room</option>
                <option value="kitchen">kitchen</option>
                <option value="bathroom">bathroom</option>
                <option value="study">study</option>
                <option value="appliances">appliances</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 pr-0">
            <!-- Sort by drop-down menu -->
            <div class="form-inline">
              <select class="form-control" name="order_by">
                <option value="" disabled selected>Sort by</option>
                <option value="pricelow">Price (low to high)</option>
                <option value="pricehigh">Price (high to low)</option>
                <option value="date">Soonest expiry</option>
              </select>
            </div>
          </div>
          <!-- Search button -->
          <div class="col-md-1 px-0">
            <label class="mx-1"> </label>
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div> 
  </div>

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
      //find itemid in watchlist
      if ($search){ $searchsql = "SELECT itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
        FROM bidding i
        WHERE itemid= $item_id AND itemname LIKE '%$search%'";
        $searchresult = mysqli_query($conn,$searchsql);
        if (mysqli_num_rows($searchresult) > 0){
          while($row = mysqli_fetch_assoc($searchresult) ){
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
            /*
            出价次数现在用的是浏览次数 这个后面要修改
            */
            // Print out item details using the print_listing_li function defined in utilities.php
            print_listing_li($item_id, $title, $description, $price ,$num_bids,$end_time );/* $image,$time_remaining 如果加上需要修改uitilities.php函数*/
          }
        }else{
          echo ('<div class="d-flex justify-content-center"><h3>NOTHING MATCHES YOUR SEARCH</h3></div>
          <br><div class="d-flex justify-content-center"><p>Please check the spelling or try less specific search terms.</p></div>');
        } 
      }else if ($category){$categorysql = "SELECT itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
        FROM bidding   i
        WHERE category LIKE '$category' AND itemid= $item_id";
        $categoryresult = mysqli_query($conn,$categorysql);
        if (mysqli_num_rows($categoryresult) > 0){
        //if ($categoryresult->num_rows > 0){     AND endtime >= CURRENT_TIMESTAMP
          while($row = mysqli_fetch_assoc($categoryresult) ){
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
        }else{
          //echo ('<div class="d-flex justify-content-center"><h3>NOTHING MATCHES YOUR SEARCH</h3></div>
          //<br><div class="d-flex justify-content-center"><p>Please check the spelling or try less specific search terms.</p></div>');
          print_listing_li($item_id, $title, $description, $price ,$num_bids,$end_time );
          print($category);
        }
      }else if ($sortby){  //if user selected sort by option
        if($sortby=='pricehigh'){  //Sort price from highest to lowest
          //Query to sort item by price from highest to lowest 
          $maxsortsql = "SELECT itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
          FROM bidding   i
          WHERE endtime >= CURRENT_TIMESTAMP AND itemid= $item_id
          ORDER BY highest_price DESC";
          $maxsortresult = mysqli_query($conn,$maxsortsql);
          while($row = mysqli_fetch_assoc($maxsortresult)) {
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
          };
        }else if($sortby=='pricelow'){//sort price from lowest to highest
          //Query to sort item by price from lowest to highest
          $minsortsql = "SELECT i.itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
          FROM bidding   i
          WHERE endtime >= CURRENT_TIMESTAMP AND itemid= $item_id
          ORDER BY highest_price ASC";
          $minsortresult = mysqli_query($conn,$minsortsql);
          while($row = mysqli_fetch_assoc($minsortresult)) {
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
          };
        }else if ($sortby=="date"){ //sort by date
          //Query to sort item by expiry date from soonest to latest
          $datesortsql = "SELECT itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
          FROM bidding   i
          WHERE endtime >= CURRENT_TIMESTAMP AND itemid= $item_id
          ORDER BY endtime ASC";
          $dateresult = mysqli_query($conn,$datesortsql);
          while($row = mysqli_fetch_assoc($dateresult)) {
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
          };
        }
      }else{
        //Query to get all items from the database if no filter is being used
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
        };
      }
    }
      $conn->close(); //Close connection
    ?> 
    </ul>
    <!-- If user is not logged in, message below will be shown to indicate they need to log in first before access any contents -->
    <?php else :?>
    <p>Please Log in to see the contents :)</p>
  <?php endif?>
</div>
<?php include_once("footer.php")?>
<?php include_once("header.php")?>

<div class="container my-5">
<?php
// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
            ?>
<?php
$Server="localhost";
     $username="root";
     $psrd="";
     $dbname = "test1";
     $connection= mysqli_connect($Server,$username,$psrd,$dbname) or die("数据库连接错误");
?>

<?php
/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */
              if( empty($_POST['auctionTitle']) || empty($_POST['auctionCategory'])|| empty($_POST['auctionStartPrice'])|| empty($_POST['auctionEndDate']) ) {
                     echo('<div class="text-center">Missing information. Please try again</div>');
        // Redirect to index after 5 seconds
                     header("refresh:5;url=create_auction.php");     
            }
            else{
    

/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */
            $name = mysqli_real_escape_string($connection, $_POST['auctionTitle']);
            $d = mysqli_real_escape_string($connection, $_POST['auctionDetails']);
            $sp = mysqli_real_escape_string($connection, $_POST['auctionStartPrice']);
            $rp = mysqli_real_escape_string($connection, $_POST['auctionReservePrice']);
            $et = mysqli_real_escape_string($connection, $_POST['auctionEndDate']); 
            $category = mysqli_real_escape_string($connection, $_POST['auctionCategory']);
    $query = "INSERT INTO bidding(itemname,category,startingprice,reserveprice,currentprice,endtime,description)
           VALUES ('$name','$category','$sp','$rp','$sp','$et','$d');";
    $result = mysqli_query($connection,$query)
           or die('Error making saveToDatabase query');
    mysqli_close($connection);
            }


// If all is successful, let user know.
echo('<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>');

?>

</div>


<?php include_once("footer.php")?>
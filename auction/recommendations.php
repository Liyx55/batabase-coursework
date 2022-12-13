<?php require("utilities.php")?>
<?php 
session_start();
if(@$_SESSION['account_type'] == "seller"){include_once("header2.php");}
else{include_once("header1.php");}
?>
<div class="container">
  <h2 class="my-3">Recommendations for you</h2>
  <div class="container mt-5">
  <ul class="list-group">
  <?php
    include 'database.php'; 
    include 'Synchronize.php';

    $sql = "SELECT * FROM recommend";
    $result=mysqli_query($conn,$sql);
    $array = array();
    $neighbour_num_recommend = 3;
    while($row=mysqli_fetch_array($result,MYSQLI_NUM))
    {
        $array[]=$row;//$array[][]是一个二维数组
    } 

    $row_num = mysqli_num_rows($result); //行数
    $col_num = mysqli_num_fields($result);

    $search_row = 0;
    $userId =  $_SESSION['UserId'];

    for($x=0;$x<$row_num;$x++){
        if($array[$x][0]==$userId){
            $search_row = $x;
            break;
        }
        else{
            continue;
        }
    } 

    $cos = array();
    $cos[0] = 0;
    $base1 = 0;


    function cal_base($search_row,$row_num,$array = array()){
        global $base1;
        for($x=1;$x<$row_num;$x++){
            if($array[$search_row][$x] != null){
                $base1 += $array[$search_row][$x] * $array[$search_row][$x]; 
            }
        }
        $base1 = sqrt($base1);
        return $base1;
    }

    $base1 = cal_base($search_row,$row_num,$array);

    for($x=0; $x<$row_num;$x++){
        $sum = 0;
        $base2 = 0;
        if($x!=$search_row){
            
            // echo "Cos(".$array[$search_row][0].",".$array[$x][0].")=";
            
            for($y=1;$y<$col_num;$y++){
                //计算分子
                if($array[$search_row][$y] != null && $array[$x][$y] != null){
                    $sum += $array[$search_row][$y] * $array[$x][$y];
                }
                //计算分母2
                if($array[$x][$y] != null){
                    $base2 = cal_base($x,$row_num,$array);
                }			
            }
            $base2 = sqrt($base2);
            $cos[$x] = ($sum/$base1)/$base2;
            // echo $cos[$x]."<br/>";
        }
    }

    for($x=0; $x<$row_num; $x++){
        if($x!=$search_row){
            $scores = 0;
            $score_num = 0;
            for($y=0; $y<$col_num;$y++){
                if($array[$x][$y]==NULL){
                    $score_num += 1;
                }
                else{
                    $scores += $array[$x][$y];
                    $score_num += 1;

                }
            }
            $scores = $scores / $score_num;
            // echo $scores."<br/>"; 
            for($y=0; $y<$col_num;$y++){
                if($array[$x][$y]==NULL){
                    $array[$x][$y] = $scores;
                    // echo $array[$x][$y]."<br/>"; 
                }
            }
        }
        else{
            $array[$x][$y] = 0;
        }
    }
//choose three users;
    $rec_user1 = array();
    $variable_1 = 0;
    $variable_2 = 0;
    for ($x= 0;$x<$row_num;$x++){
        $variable_1 = $cos[$x];
        $variable_2 = $x;
        if($variable_1>$recommend_user1[0][0]){
            // 00smallest
            $recommend_user1[0][0] = $cos[$x];
            $recommend_user1[0][1] = $x;
            if($variable_1 >$recommend_user1[1][0]){
                $recommend_user1[0][0] = $recommend_user1[1][0];
                $recommend_user1[0][1] = $recommend_user1[1][1];
                $recommend_user1[1][0]= $variable_1;
                $recommend_user1[1][1]= $variable_2; 
                if($variable_1 >>$recommend_user1[2][0]){
                    $recommend_user1[1][0] = $recommend_user1[2][0];
                    $recommend_user1[1][1] = $recommend_user1[2][1];
                    $recommend_user1[2][0]= $variable_1;
                    $recommend_user1[2][1]= $variable_2; 
                }
            }
        }
    }

    $x1 = $recommend_user1[0][1];
    $x2 = $recommend_user1[1][1];
    $x3 = $recommend_user1[2][1];
    $Rec = array();//推荐数组
    //计算平均加权
    for($y=1;$y<=$row_num;$y++){
        if($array[$search_row][$y]!=NULL){
            $num = $cos[$recommend_user1[0][1]]+$cos[$recommend_user1[1][1]]+$cos[$recommend_user1[2][1]];
            $sum = $recommend_user1[0][0]*$array[$x1][$y]+$recommend_user1[1][0]*$array[$x2][$y]+$recommend_user1[2][0]*$array[$x3][$y];
            $Rec[$y][0]=$sum/$num;
            $Rec[$y][1]= $y;

        }
    }

// choose three products--sort
    global $res;
    $res = array();
    $middle_var1 = 0;
    $middle_var2 = 0;
    for ($x= 1;$x<=$col_num;$x++){
        $middle_var1 = $Rec[$x][0];
        $middle_var2 = $Rec[$x][1];
        if($middle_var1>$res[0][0]){
            // 00smallest
            $res[0][0] = $middle_var1;
            $res[0][1] = $middle_var2;
            if($middle_var1 >$res[1][0]){
                $res[0][0] = $res[1][0];
                $res[0][1] = $res[1][1];
                $res[1][0]= $middle_var1;
                $res[1][1]= $middle_var2; 
                if($middle_var1 >>$res[2][0]){
                    $res[1][0] = $res[2][0];
                    $res[1][1] = $res[2][1];
                    $res[2][0]= $middle_var1;
                    $res[2][1]= $middle_var2; 
                }
            }
        }
    }
    
    // echo $res[0][1]."<br/>";
    // echo $res[1][1]."<br/>";
    // echo $res[2][1]."<br/>";
    
    $items=array();
    array_push($items,$res[0][1]);
    array_push($items,$res[1][1]);
    array_push($items,$res[2][1]);
    
    #var_dump($items);
    $sql = "SELECT itemid, itemname, category, startingprice, reserveprice, currentprice  as highest_price, endtime,description,userid, buyer, viewnum
    FROM bidding
    where  itemid in ($items[0],$items[1],$items[2])";
    #echo $res[1][1]."<br/>";
    $result = mysqli_query($conn, $sql);
    if($userId == null || $userId == ' ')
           {
            echo('<div class="text-center">Please Login!</div>');
            // Redirect to index after 5 seconds
            header("refresh:5;url=login.php"); 
           }
    else{
        while($row = mysqli_fetch_assoc($result)) 
    {      
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
        print_listing_li($item_id, $title, $description, $price ,$num_bids,$end_time );
        
        }
    }
    
  ?>  
  </ul>
  </div>
</div>

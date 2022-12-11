<!-- 不符合推荐条件的不要列进来，比如过期的 -->
<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">
  <h2 class="my-3">Recommendations for you</h2>
  <div class="container mt-5">
  <ul class="list-group">
  <?php
    include 'database.php'; 
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
    $search_col = 5;
    $cos = array();
    $cos[0] = 0;
    global $base1;
    $base1 = 0;


    function cal_base($search_col,$row_num,$array = array()){
        for($x=1;$x<$row_num;$x++){
            if($array[$search_col][$x] != null){
                $base1 += $array[$search_col][$x] * $array[$search_col][$x]; 
            }
        }
        $base1 = sqrt($base1);
        return $base1;
    }

    $base1 = cal_base($search_col,$row_num,$array);



    for($x=0; $x<$col_num;$x++){
        $sum = 0;
        $base2 = 0;
        if($x!=$search_col){
            
            // echo "Cos(".$array[$search_col][0].",".$array[$x][0].")=";
            
            for($y=1;$y<9;$y++){
                //计算分子
                if($array[$search_col][$y] != null && $array[$x][$y] != null){
                    $sum += $array[$search_col][$y] * $array[$x][$y];
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

    for($x=0; $x<$col_num; $x++){
        if($x!=$search_col){
            $scores = 0;
            $score_num = 0;
            for($y=0; $y<$row_num;$y++){
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
            for($y=0; $y<$row_num;$y++){
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
    for ($x= 0;$x<$col_num;$x++){
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
    $Rec = array();
    for($y=1;$y<=$row_num;$y++){
        if($array[$search_col][$y]!=NULL){
            $num = $cos[$recommend_user1[0][1]]+$cos[$recommend_user1[1][1]]+$cos[$recommend_user1[2][1]];
            $sum = $recommend_user1[0][0]*$array[$x1][$y]+$recommend_user1[1][0]*$array[$x2][$y]+$recommend_user1[2][0]*$array[$x3][$y];
            $Rec[$y][0]=$sum/$num;
            $Rec[$y][1]= $y;

        }
    }

// choose three products
    global $res;
    $res = array();
    $b = 0;
    $c = 0;
    for ($x= 1;$x<=$row_num;$x++){
        $b = $Rec[$x][0];
        $c = $Rec[$x][1];
        if($b>$res[0][0]){
            // 00smallest
            $res[0][0] = $b;
            $res[0][1] = $c;
            if($b >$res[1][0]){
                $res[0][0] = $res[1][0];
                $res[0][1] = $res[1][1];
                $res[1][0]= $b;
                $res[1][1]= $c; 
                if($b >>$res[2][0]){
                    $res[1][0] = $res[2][0];
                    $res[1][1] = $res[2][1];
                    $res[2][0]= $b;
                    $res[2][1]= $c; 
                }
            }
        }
    }
    
    #echo $res[0][1]."<br/>";
    #echo $res[1][1]."<br/>";
    #echo $res[2][1]."<br/>";

    $userId =  $_SESSION['UserId']; 
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

    while($row = mysqli_fetch_assoc($result)) 
    {      
        $item_id = $row['itemid'];
        $title = $row['itemname'];
        $description = $row['description'];
        $price = $row['highest_price'];
        $end_time = new DateTime($row['endtime']);
        $num_bids = $row['viewnum'];
        print_listing_li($item_id, $title, $description, $price ,$num_bids,$end_time );
        
        }
  ?>  
  </ul>
  </div>
</div>

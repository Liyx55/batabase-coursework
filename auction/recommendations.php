<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

  <h2 class="my-3">Recommendations for you</h2>
  <?php
    include 'database.php'; 
    $sql = "SELECT * FROM recommend";
    $result=mysqli_query($conn,$sql);
    $array = array();
    while($row=mysqli_fetch_array($result,MYSQLI_NUM))
    {
        $array[]=$row;//$array[][]是一个二维数组
    } 

    $row_num = mysqli_num_rows($result); //行数
    $col_num = mysqli_num_fields($result);
    $col_srh_num = 5;
    $cos = array();
    $cos[0] = 0;
    $base1 = 0;


    // for($i=1;$i<$col_num;$i++){
    //   if($array[$col_srh_num][$i] != null){//$array[5]代表Leo
    //     $base1 += $array[$col_srh_num][$i] * $array[$col_srh_num][$i];
    //   }
    // }

    // function cal_base($col_srh_num,$row_num)
    // {
    //     for($j=1;$j<$row_num;$j++){
    //         if($array[$col_srh_num][$j] != null){
    //             // $base += $array[$col_srh_num][$j] * $array[$col_srh_num][$j]; 
    //             echo $j;
    //             echo $array[$col_srh_num][$j];
    //         }
    //         else {
    //             echo "!";
    //             echo $array[$col_srh_num][$j];
    //         }
    //     }
    //     $base = sqrt($base);
    //     return $base;
    // }
    // $base1 = cal_base($col_srh_num,$col_num);
    // echo $base1;

    

    //计算分母1，分母1是第一个公式里面 “*”号左边的内容，分母二是右边的内容
    for($i=1;$i<$row_num;$i++){
        if($array[$col_srh_num][$i] != null){
            $base1 += $array[$col_srh_num][$i] * $array[$col_srh_num][$i]; 
            echo  $array[$col_srh_num][$i];
        }
    }
    $base1 = sqrt($base1);

    for($i=0;$i<5;$i++){
        $sum = 0;
        $base2 = 0;
        echo "Cos(".$array[5][0].",".$array[$i][0].")=";
        
        for($j=1;$j<9;$j++){
            //计算分子
            if($array[5][$j] != null && $array[$i][$j] != null){
                $sum += $array[5][$j] * $array[$i][$j];
            }
            //计算分母2
            if($array[$i][$j] != null){
                $base2 += $array[$i][$j] * $array[$i][$j];
            }			
        }
        $base2 = sqrt($base2);
        $cos[$i] = $sum/$base1/$base2;
        echo $cos[$i]."<br/>";
    }

    //对计算结果进行排序,凑合用快排吧先
    function quicksort($str){
        if(count($str)<=1) return $str;//如果个数不大于一，直接返回
        $key=$str[0];//取一个值，稍后用来比较；
        $left_arr=array();
        $right_arr=array();
        
        for($i=1;$i<count($str);$i++){//比$key大的放在右边，小的放在左边；
            if($str[$i]>=$key)
            $left_arr[]=$str[$i];
            else
            $right_arr[]=$str[$i];
        }
        $left_arr=quicksort($left_arr);//进行递归；
        $right_arr=quicksort($right_arr);
        return array_merge($left_arr,array($key),$right_arr);//将左中右的值合并成一个数组；
    }

    $neighbour = array();//$neighbour只是对cos值进行排序并存储
    $neighbour = quicksort($cos);


    //$neighbour_set 存储最近邻的人和cos值
    $neighbour_set = array();
    for($i=0;$i<3;$i++){
        for($j=0;$j<5;$j++){
            if($neighbour[$i] == $cos[$j]){
                $neighbour_set[$i][0] = $j;
                $neighbour_set[$i][1] = $cos[$j];
                $neighbour_set[$i][2] = $array[$j][6];//邻居对f的评分
                $neighbour_set[$i][3] = $array[$j][7];//邻居对g的评分
                $neighbour_set[$i][4] = $array[$j][8];//邻居对h的评分
            }
        }
    }
    print_r($neighbour_set);
    // echo "<p><br/>";

    //计算Leo对f的评分
    $p_arr = array();
    $pfz_f = 0;
    $pfm_f = 0;
    for($i=0;$i<3;$i++){
        $pfz_f += $neighbour_set[$i][1] * $neighbour_set[$i][2];
        $pfm_f += $neighbour_set[$i][1];
    }
    $p_arr[0][0] = 6;
    $p_arr[0][1] = $pfz_f/sqrt($pfm_f);
    if($p_arr[0][1]>0){
        echo "推荐f";
    }
    echo $p_arr[0][1]."<br/>";

    //计算Leo对g的评分
    $pfz_g = 0;
    $pfm_g = 0;
    for($i=0;$i<3;$i++){
        $pfz_g += $neighbour_set[$i][1] * $neighbour_set[$i][3];
        $pfm_g += $neighbour_set[$i][1];
        $p_arr[1][0] = 7;
        $p_arr[1][1] = $pfz_g/sqrt($pfm_g);
    }
    if($p_arr[0][1]>0){
        echo "推荐g";
    }

    //计算Leo对h的评分
    $pfz_h = 0;
    $pfm_h = 0;
    for($i=0;$i<3;$i++){
        $pfz_h += $neighbour_set[$i][1] * $neighbour_set[$i][4];
        $pfm_h += $neighbour_set[$i][1];
        $p_arr[2][0] = 8;
        $p_arr[2][1] = $pfz_h/sqrt($pfm_h);
    }
    print_r($p_arr);
    if($p_arr[0][1]>0){
        echo "推荐h";
    }
  ?>  
</div>
  <!-- // This page is for showing a buyer recommended items based on their bid 
  // history. It will be pretty similar to browse.php, except there is no 
  // search bar. This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  // TODO: Check user's credentials (cookie/session).
  
  // TODO: Perform a query to pull up auctions they might be interested in.
  
  // TODO: Loop through results and print them out as list items. -->
  

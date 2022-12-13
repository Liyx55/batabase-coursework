<?php 

// UPDATE


      $sql = "SELECT userid, itemid,score FROM feedback";
      $result=mysqli_query($conn,$sql);
      $row_num = mysqli_num_rows($result); //行数
      $col_num = mysqli_num_fields($result);
      $array = array();
      $neighbour_num_recommend = 3;
      while($row=mysqli_fetch_array($result,MYSQLI_NUM))
      {
      $array[]=$row;//$array[][]是一个二维数组
      } 
      // // 利用feedback生产一张新表
      $a = "item";
      // for($x=0;$x<$row_num;$x++){
      //       $array[$x][1] = $a.strval($array[$x][1]);//小心重复
      //       // $sql = "ALTER recommend ADD '$array[$x][1]' INT(11)";
      //       // $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            

      //       // $sql2= "INSERT INTO recommend(userid, $array[$x][1]) 
      //       // VALUES ($array[$x][0],$array[$x][2])";
      //       // $run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
      // }

      // $mysql_query=("ALTER TABLE `recommend ` ADD `item10` int");
      // $run = mysqli_query($conn, $mysql_query);

      // $row_num 输出feedback验证
      for($x=0;$x<$row_num;$x++){
            $userid = $array[$x][0];
            $itemid = $a.strval($array[$x][1]);
            $b = $array[$x][2];
            $sql1 = "UPDATE recommend
            SET $itemid = $b
            WHERE userid = $userid";
            $result2 = mysqli_query($conn,$sql1);
      }
?>
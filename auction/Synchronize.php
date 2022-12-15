

<?php 
      $sql = "SELECT userid, itemid,score FROM feedback";
      $result=mysqli_query($conn,$sql);
      $row_num = mysqli_num_rows($result); 
      $col_num = mysqli_num_fields($result);
      $array = array();
      $neighbour_num_recommend = 3;
      while($row=mysqli_fetch_array($result,MYSQLI_NUM))
      {
      $array[]=$row;
      } 

      for($x=0;$x<$row_num;$x++){
            $a = "item";
            $userid = $array[$x][0];
            $itemid = $a.strval($array[$x][1]);
            $b = $array[$x][2];
            $sql1 = "UPDATE recommend
            SET $itemid = $b
            WHERE userid = $userid";
            $result2 = mysqli_query($conn,$sql1);

      }
?>
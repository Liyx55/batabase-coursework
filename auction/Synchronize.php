<!-- 读取feedback
对每一行数据   首先得到userid(也就是recommend中的某一行)
先用array格式尝试输出userid和itemid以及score
array[x row][0]=UserId
array[x row][1]=itemid
array[x row][2]=score

动态修改recommend表的列数----暂时可以通过写死itemid数量来掠过 
这个列数我们暂定是10吧

然后试着写回recommend
$sql = "INSERT INTO `recommend`(`userid`, `itemid`, `score`,`message`,`reviewdate`) 
      VALUES ('$userId','$Item_id','$Score','$Message',NOW())";
关键的一步是   itemid=列数  比如第一个item 对应的recommend列就是[userid][1] -->

<?php 
// 需要注意数据库连接问题
//数出来   ---倒回去
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
      // $a = "item";
      // for($x=0;$x<$row_num;$x++){
      //       $array[$x][1] = $a.strval($array[$x][1]);//小心重复
      //       // $sql = "ALTER recommend ADD '$array[$x][1]' INT(11)";
      //       // $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));



      //       // echo "add succeed";
            


      //       // $sql2= "INSERT INTO recommend(userid, $array[$x][1]) 
      //       // VALUES ($array[$x][0],$array[$x][2])";
      //       // $run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
      // }

      // $mysql_query=("ALTER TABLE `recommend ` ADD `item10` int");
      // $run = mysqli_query($conn, $mysql_query);



      




      // $row_num 输出feedback验证
      for($x=0;$x<$row_num;$x++){
            echo $array[$x][0]."<br/>"; 
            // userid
            echo $array[$x][1]."<br/>"; 
            // itemid
            echo $array[$x][2]."<br/>"; 
            echo '...........'."<br/>";
            echo '傻逼代码';
            // score
            $a = "item";
            $userid = $array[$x][0];
            $itemid = $a.strval($array[$x][1]);
            $b = $array[$x][2];
            $sql1 = "UPDATE recommend
            SET $itemid = $b
            WHERE userid = $userid";
            $result2 = mysqli_query($conn,$sql1);

      }







      // $userid = 30;
      // $col_name = '6';
      // $sql1 = "UPDATE recommend
      // -- SET $col_name = $array[$x][2]
      // SET $col_name = 5
      // WHERE userid = $userid";
      // $result2 = mysqli_query($conn,$sql1);
      // UPDATE


      // $b = array();
      // $c = array();
      // $c[0] = 1;
      // $a = "item";
      // $b[0] = $a.strval($c[0]); 
      // $userid = 30;
      // $itemid = $b[0];
      // $sql1 = "UPDATE recommend
      // SET $itemid = 8888435
      // WHERE userid = $userid";
      // $result2 = mysqli_query($conn,$sql1);








      

      // // SELECT
      // $sql1 = "SELECT $col_name FROM recommend
      // where userid = $userid";
      // $result1 = mysqli_query($conn,$sql1);
      // $array1 = array();

      // while($row1=mysqli_fetch_array($result1,MYSQLI_NUM))
      // {
      // $array1[]=$row1;//$array[][]是一个二维数组
      // echo '操你妈的傻逼代码';
      // echo $row1[0];
      // } 
      // for($x=0;$x<mysqli_num_rows($result1);$x++){

      // //echo $array1[$x]."<br/>";
      // }
      // // echo $result1;

      // // $userid = 101;
      // // $col_name = 'b';
      // // $sql1 = "SELECT $col_name FROM recommend
      // // where userid = $userid";
      // // $result1 = mysqli_query($conn,$sql1);
      // // $array1 = array();
      // // while($row1=mysqli_fetch_array($result1,MYSQLI_NUM))
      // // {
      // //     $array1[]=$row1;//$array[][]是一个二维数组
      // //     echo $row1[0];
      // // } 
      // // for($x=0;$x<mysqli_num_rows($result1);$x++){
      // //     //echo $array1[$x]."<br/>";
      // // }
      // // // echo $result1;






?>
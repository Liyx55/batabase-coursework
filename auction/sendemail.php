<?php include_once("header1.php")?>
<?php require("utilities.php")?>
<?php
//$email=$_GET["mail"];
//$name=$_GET["username"];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailermaster/src/Exception.php';
require 'PHPMailermaster/src/PHPMailer.php';
require 'PHPMailermaster/src/SMTP.php';
include_once("database.php");
session_start();
$Item_id = $_SESSION["Item_Id"];// Get info from ?:
$userId = $_SESSION['UserId'];
$buyerid = $_SESSION['buyerid'];

$query = "SELECT * FROM bidding WHERE itemid =$Item_id";
$Result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($Result);
$sellerid = $row['userid'];
//$itemname = $row['itemname'];
echo $buyerid;
//echo $userId;


$sqlbuyeremail = "SELECT * FROM userinfo WHERE userid = $buyerid";
$result = mysqli_query($conn,$sqlbuyeremail);
$row2 = mysqli_fetch_array($result);
$buyeremail = $row2['email'];
$buyername = $row2['username'];
//echo $buyeremail;

$sqlselleremail = "SELECT * FROM userinfo WHERE userid = $sellerid";
$result = mysqli_query($conn,$sqlselleremail);
$row3 = mysqli_fetch_array($result);
$selleremail = $row3['email'];
$sellername = $row3['username'];
//$selleremail = '463727335@qq.com';
//echo $selleremail;
if($buyerid != null){

$test1 = "Someone else bidded the same item with higher bid than you.";
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //服务器配置
    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                        
    $mail->isSMTP();                             
    $mail->Host = 'smtp.gmail.com';               
    $mail->SMTPAuth = true;                     
    $mail->Username = 'bbcoursework@gmail.com';                
    $mail->Password = 'csmxmyedjlybaaao';            
    $mail->SMTPSecure = 'tls';   
    $mail->SMTPAutoTLS = false;            
    $mail->Port = 587;                            

    $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup'); 
    $mail->addAddress($buyeremail,$buyername); 
    //$mail->addAddress('ellen@example.com'); 
    $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup');
    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'Outbid';
    $mail->Body = $test1;
    $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';

    $mail->send();
}


    $test2 = "New bids on your items.";
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //服务器配置
    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                       
    $mail->isSMTP();                             
    $mail->Host = 'smtp.gmail.com';             
    $mail->SMTPAuth = true;                     
    $mail->Username = 'bbcoursework@gmail.com';             
    $mail->Password = 'csmxmyedjlybaaao';          
    $mail->SMTPSecure = 'tls';   
    $mail->SMTPAutoTLS = false;                
    $mail->Port = 587;                           

    $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup'); 
    $mail->addAddress($selleremail,$sellername);  
    //$mail->addAddress('ellen@example.com');  
    $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); 
    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'New bid';
    $mail->Body = $test2;
    $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';

    $mail->send();


$sqlwatchemail = "SELECT * FROM watchlist where itemid = $Item_id";
$resultwemail = mysqli_query($conn, $sqlwatchemail);
while($row1 = mysqli_fetch_assoc($resultwemail)){
    if ($resultwemail->num_rows > 0) {
        $watchid = $row1["userid"];
        $sqlwemail = "SELECT * FROM userinfo WHERE userid = $watchid";
        $wresult = mysqli_query($conn, $sqlwemail);
        $row4 = mysqli_fetch_array($wresult);
        $watchemail = $row4['email'];
        $watchname = $row4['username'];
        //echo $watchemail;

        $test3 = "There are new bids for the items you watching.";
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    
        //服务器配置
        $mail->CharSet ="UTF-8";                  
        $mail->SMTPDebug = 0;                        
        $mail->isSMTP();                          
        $mail->Host = 'smtp.gmail.com';               
        $mail->SMTPAuth = true;                    
        $mail->Username = 'bbcoursework@gmail.com';               
        $mail->Password = 'csmxmyedjlybaaao';            
        $mail->SMTPSecure = 'tls';   
        $mail->SMTPAutoTLS = false;                 
        $mail->Port = 587;                           
        $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup');  
        $mail->addAddress($watchemail,$watchname);  
        //$mail->addAddress('ellen@example.com');  
        $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); 
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'New bid';
        $mail->Body = $test3;
        $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';
    
        $mail->send();
    }
}


    header("refresh:0.1;url= mybids.php");

//echo '<script>window.close();</script>';

?>



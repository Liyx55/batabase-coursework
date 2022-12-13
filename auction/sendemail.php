<?php include_once("header1.php")?>
<?php require("utilities.php")?>
<?php
//$email=$_GET["mail"];
//$name=$_GET["username"];
include_once("database.php");
session_start();
$Item_id = $_SESSION["Item_Id"];// Get info from ?:
$userId = $_SESSION['UserId'];

$query = "SELECT * FROM bidding WHERE itemid =$Item_id";
$Result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($Result);
$buyerid = $row['buyer']; //current hightest price buyer's userid
$sellerid = $row['userid'];
//$itemname = $row['itemname'];


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

$test1 = "Someone else bidded the same item with higher bid than you."; //发送的邮件内容 html写的

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailermaster/src/Exception.php';
require 'PHPMailermaster/src/PHPMailer.php';
require 'PHPMailermaster/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    $mail->Host = 'smtp.gmail.com';                // SMTP服务器
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证
    $mail->Username = 'bbcoursework@gmail.com';                // SMTP 用户名  发件人的邮箱 即邮箱的用户名
    $mail->Password = 'csmxmyedjlybaaao';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
    $mail->SMTPSecure = 'tls';   
    $mail->SMTPAutoTLS = false;                 // 允许 TLS 或者ssl协议
    $mail->Port = 587;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

    $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup');  //发件人
    $mail->addAddress($buyeremail,$buyername);  // 收件人
    //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
    $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); //回复的时候回复给哪个邮箱 建议和发件人一致
    //Content
    $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
    $mail->Subject = 'Outbid';
    $mail->Body = $test1;
    $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';

    $mail->send();



    $test2 = "New bids on your items.";
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    $mail->Host = 'smtp.gmail.com';                // SMTP服务器
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证
    $mail->Username = 'bbcoursework@gmail.com';                // SMTP 用户名  发件人的邮箱 即邮箱的用户名
    $mail->Password = 'csmxmyedjlybaaao';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
    $mail->SMTPSecure = 'tls';   
    $mail->SMTPAutoTLS = false;                 // 允许 TLS 或者ssl协议
    $mail->Port = 587;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

    $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup');  //发件人
    $mail->addAddress($selleremail,$sellername);  // 收件人
    //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
    $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); //回复的时候回复给哪个邮箱 建议和发件人一致
    //Content
    $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
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
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.gmail.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = 'bbcoursework@gmail.com';                // SMTP 用户名  发件人的邮箱 即邮箱的用户名
        $mail->Password = 'csmxmyedjlybaaao';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = 'tls';   
        $mail->SMTPAutoTLS = false;                 // 允许 TLS 或者ssl协议
        $mail->Port = 587;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
    
        $mail->setFrom('bbcoursework@gmail.com', 'dbcwgroup');  //发件人
        $mail->addAddress($watchemail,$watchname);  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo('bbcoursework@gmail.com', 'dbcwgroup'); //回复的时候回复给哪个邮箱 建议和发件人一致
        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = 'New bid';
        $mail->Body = $test3;
        $mail->AltBody = 'your equipment does not support this email, please check in google chrome!';
    
        $mail->send();
    }
}


    header("refresh:0.1;url= mybids.php");

//echo '<script>window.close();</script>';

?>



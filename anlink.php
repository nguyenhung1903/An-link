<!-- 
$=========================================================$
@name Ẩn link
@version 0.0.1
@author Nguyễn Hưng
@facebook https://fb.com/NguyenHung1903
@description Hide my url :"3
@Date create 23/08/2018 
@comment Don't sell my products because it's free =))
$=========================================================$
-->
<html>
<head>
	<title>Ẩn Link</title>
<center>
<?php 
/*.htaccess: Rewrite ^hide/([a-zA-z0-9]+)$ anlink.php?url = $1*/

#connect mysql 
$server_username = "";
$server_password = "";
$server_host = "";
$database = '';
$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("không thể kết nối tới cơ sở dữ liệu");
mysqli_query($conn,"SET NAMES 'UTF8'");
# end connect mysql

function randomQR() {
	/*========================================
	  =     Xuất ra một mã ngẫu nhiên        =
	  ========================================
	*/

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $qr = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $qr[] = $alphabet[$n];
    }
    return implode($qr); 
}

if (isset($_GET['url'])){
	$url = $_GET['url'];
	$link_unhide = "";
	$sql = "SELECT * FROM url WHERE url_qr='$url'";
	$query = mysqli_query($conn,$sql);
	while ($data = mysqli_fetch_array($query)){
		$link_unhide = $data['url'];
	}
	if ($link_unhide == null){
		echo "<title>Link không tồn tại</title><p>Link không tồn tại</p>";
	} else
	echo '<title>Đang chuyển hướng...</title><META http-equiv="refresh" content="0;URL='.$link_unhide.'">';
}else echo '<title>Ẩn link</title><form action="" method="post" accept-charset="utf-8">
	<input type="url" name="anlink_input">
	<input type="submit" name="anlink_submit" value="ẩn link">
</form>';
if (isset($_POST['anlink_submit'])){
	$link = $_POST['anlink_input'];
	$url_qr = randomQR();
	$sql="INSERT INTO url(url_qr,url) VALUES ('".$url_qr."','".$link."')";
	mysqli_query($conn,$sql);
	echo '<input type="text" name="" value ="https://aftrue.me/hide/'.$url_qr.'">';
	/*Thay https://aftrue.me/hide thành url mà bạn muốn*/
}
?>
</head>
<!-- CSS -->
<style type="text/css" media="screen">
a{
    -webkit-transition: 0.3s;
}
a:link, a:visited {
    border: 2px solid white;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}
body{
    background-color: Black;
    margin-top:10%;
}
a:hover {
    transition: 0.3s;
    background-color: white;
    color:black;
}
a:active{
    background-color: #eeeeee;
    color:black;
}
input[type = url]{
    width: 540px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid white;
    background-color: Black;
    color: white;
}
input[type = text]{
    width: 620px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid white;
    background-color: Black;
    color: white;
}
input[type = submit]{
    width: 80px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid white;
    background-color: Black;
    color: white;
}
input[type = submit]:hover{
    transition: 0.3s;
    background-color: white;
    color:black;
}
p{
    color:white;
}
</style>
<!--/ CSS-->
</center>
</html>

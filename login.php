<?php
if("curl/7.77.0" == $_SERVER["HTTP_USER_AGENT"]){
echo "You can't request from CLI";
exit();
}
if(empty($_POST['csrf_token']) & empty($_POST['uname']) & empty($_POST['pass'])){
echo "<script>alert('CSRF Token Check Fail')</script>";
exit();
}
$servername = "localhost";
$username = "";
$password = "";

$conn = new mysqli($servername, $username, $password, 'csrf');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$ip = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']);
$uagent = mysqli_real_escape_string($conn, $_SERVER["HTTP_USER_AGENT"]);
$token = mysqli_real_escape_string($conn, $_POST['csrf_token']);
$sql = "SELECT * FROM csrf WHERE Ip = '" .$ip. "' AND uagent = '" .$uagent. "' AND token = '" .$token. "';";
$result = $conn->query($sql);
if($row = $result->fetch_array()){
$sql = "DELETE FROM csrf WHERE Ip = '" .$ip. "';";
$delete = $conn->query($sql);
if($delete){
if($_POST['uname'] == "cyberbullet" & $_POST['pass'] == "nyimalay"){
echo "Login Successed<br> #the_flag{6wjwbeys7s87y3gebeeeheheyey732uhzs}";
exit();
}else{
echo "<script>alert('Incorrect Username Or Password')</script>";
exit();
}
}else{
echo "<script>alert('CSRF Token Check Fail');</script>";
exit();
}
}else{
echo "<script>alert('CSRF Token Check Fail')</script>";
exit();
}

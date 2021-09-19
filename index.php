<?php
if("curl/7.77.0" == $_SERVER["HTTP_USER_AGENT"]){
echo "You can't request from CLI";
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
$sql = "SELECT * FROM csrf WHERE Ip = '" .$ip. "' AND uagent = '" .$uagent. "';";
$result = $conn->query($sql);
if($row = $result->fetch_array()){
$token = $row['2'];
}else{
$token = bin2hex(openssl_random_pseudo_bytes(16));
$sql = "INSERT INTO csrf VALUES ('" .$ip. "', '" .$uagent. "', '" .$token. "');";
$result = $conn->query($sql);
if($result){

}else{
echo "<script>alert('Something was wrong')</script>"; 
exit();
}
}
?>
<style>
/* Bordered form */
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
</style>
<form action="login.php" method="post">
  <div class="imgcontainer">
    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
  <center><h1>Chellenge By CyberBullet</h1></center></div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>

    <button type="submit">Login</button>
  </div>
</form>

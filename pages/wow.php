<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "Store";

$conn = new mysqli($servername, $username, $password,$db);

//  In order to set the cookie manually, uncomment this code
/*
$uidSql = "SELECT uid, password FROM Users WHERE email = 'test@gmail.com'";

$result = $conn->query($uidSql);
$user = $result->fetch_object();
$uid = $user->uid;
$hash = $user->password;
setcookie("uid", $uid, isset($_POST["fname"]) ? time() + 3600 : 0, '/');
*/

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

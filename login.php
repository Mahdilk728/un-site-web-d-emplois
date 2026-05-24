<?php

session_start();

include("config.php");

$email = $_POST['email'];
$password = $_POST['password'];

$res = $conn->query("
SELECT * FROM users
WHERE email='$email'
");

if($res->num_rows > 0){

$user = $res->fetch_assoc();

if(
password_verify(
$password,
$user['password']
)
){

$_SESSION['user']=$user;

header("Location:dashboard.php");

}else{

echo "Wrong password";

}

}else{

echo "User not found";

}

?>
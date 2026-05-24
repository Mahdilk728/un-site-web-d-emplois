<?php

include("config.php");

$nom = $_POST['nom'];
$email = $_POST['email'];

$password = password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$role = $_POST['role'];

$conn->query("
INSERT INTO users(
nom,
email,
password,
role
)

VALUES(
'$nom',
'$email',
'$password',
'$role'
)
");

header("Location:index.php");

?>
<?php
include('connection.php');

$password = $_POST['password'];
$username = $_POST['username'];
$hashed_password_new = password_hash($password, PASSWORD_BCRYPT);

$query = $mysql->prepare('UPDATE users SET `password`=$hashed_password_new WHERE `usernme`=$username');
$query->execute();

?>
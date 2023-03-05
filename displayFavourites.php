<?php
include('connection.php');


$user_id=$_GET['user_id'];

$query = $mysqli->prepare('select * from favourites where user_id=?');
$query->bind_param('i', $user_id);
$query->execute();



echo json_encode($response);
?>
<?php
include('connection.php');

$first_name = $_GET['first_name'];
$last_name= $_GET['last_name'];
$dob = $_GET['dob'];
$country = $_GET['country'];


$query = $mysqli->prepare('select first_name,last_name,dob,country from users');
$query->execute();


echo json_encode($response);
?>
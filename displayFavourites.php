<?php
include('connection.php');


$user_id=$_GET['user_id'];
$user_id=$_GET['product_id'];


$query = $mysqli->prepare('select * from favourites where user_id=?');
$query->bind_param('i', $user_id);
$query->execute();

$query = $mysqli->prepare('select * from products where product_id=?');
$query->bind_param('i', $product_id);
$query->execute();
 

$result = $query -> get_result();

while ($object = $result -> fetch_assoc()){
    $data = $object;
}

$response=["user"=>$data];
echo json_encode($response);


?>
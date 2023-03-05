<?php

include ('connection.php');
$item_id = $_POST['Id'];
$item_name = $_POST['Name'];
$item_price = $_POST['Price'];
$item_image = $_POST['Image'];
$item_description = $_POST['Description'];

$query = $con->prepare("UPDATE items SET `Name`=?, `Price`=?,`Image`=?,`Description`=? WHERE `Id`=?");
$query->bind_param('sissi',$item_name, $item_price,$item_image,$item_description, $item_id);
$query->execute();
$response = [
  "status" => "Item updated"
];
echo json_encode($response);

?>
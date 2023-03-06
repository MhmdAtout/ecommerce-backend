<?php

include ('connection.php');
$item_id = $_POST['Id'];
$query = $con->prepare("DELETE FROM items WHERE Id=?");
$query->bind_param('i', $item_id);
$query->execute();
$response = [
  "status" => "Item deleted"
];
echo json_encode($response);

?>

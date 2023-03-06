<?php

include('connection.php');

$query = $mysql -> prepare ('SELECT products.* , categories.type from `products` LEFT JOIN categories ON products.category_id = categories.category_id');
$query -> execute();
$result = $query -> get_result();

while($object = $result -> fetch_assoc()){
    $data[] = $object;
}

$response = [
    "products" => $data
];

echo json_encode($response);

?>
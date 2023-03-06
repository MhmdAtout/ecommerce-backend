<?php

include('connection.php');

$query = $mysql -> prepare ('SELECT * from `categories`');
$query -> execute();
$result = $query -> get_result();

while($object = $result -> fetch_assoc()){
    $data[] = $object;
}

$response = [
    "categories" => $data
];


echo json_encode($response);
?>
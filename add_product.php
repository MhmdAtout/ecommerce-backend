<?php

include("connection.php");

$name = $_POST["name"];
$brand = $_POST["brand"];
$price = $_POST["price"];

$query = $mysql -> prepare ("SELECT * FROM `products` WHERE `name` = ? and `brand` = ? and `price` = ?");
$query -> bind_param("ssi", $name, $brand, $price);
$query -> execute();
$result = $query -> get_result();

while($object = $result -> fetch_assoc()){
    $data[] = $object;
}

if(isset($data)){
    $response = [
        "status" => "Product already exists"
    ];
}else{
    $query = $mysql -> prepare ("INSERT INTO `products` (`name`, `brand`, `price`) VALUES (?, ?, ?)");
    $query -> bind_param("ssi", $name, $brand, $price);
    $query -> execute();
    $response = [
        "status" => "Product added"
    ];
}

echo json_encode($response);

?>
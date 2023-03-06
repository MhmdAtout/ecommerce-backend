<?php 

include("connection.php");

$user_id = $_POST["user_id"];
$phone_number = $_POST["phone_number"];
$country = $_POST["country"];
$city = $_POST["city"];
$street = $_POST["street"];

$query = $mysql -> prepare ("UPDATE users SET `phone_number` = ?, `country` = ?, `city` = ?, `street` = ? WHERE `user_id` = ?");
$query -> bind_param("ssssi", $phone_number, $country, $city, $street, $user_id);
if($query -> execute()){
    $response = [
        "status" => "User info updated"
    ];
};

echo json_encode($response);

?>
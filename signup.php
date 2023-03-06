<?php

include('connection.php');

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$dob = $_POST["dob"];
$country = $_POST["country"];
$city = $_POST["city"];
$street = $_POST["street"];

$hashed = hash("sha256", $password);

$query = $mysql -> prepare("SELECT * FROM `users` where username=? and email=? ");
$query -> bind_param("ss", $username, $email);
$query -> execute();
$result = $query -> get_result();

while($object = $result -> fetch_assoc()){
    $data[] = $object;
}

if(isset($data)){
    $response = [
        "status" => "Username or Password already associated with another account"
    ];
} else{
    $query = $mysql -> prepare ("INSERT INTO `users` (first_name, last_name, username, `password`, email, phone_number, dob, country, city, street) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query -> bind_param("ssssssssss", $first_name, $last_name, $username, $hashed, $email, $phone_number, $dob, $country, $city, $street);
    $query -> execute();
    $response = [
        "status" => "User added"
    ];
}

echo json_encode($response);

?>
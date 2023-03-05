<?php 

include("connection.php");

$user_id = $_POST["user_id"];
$password = $_POST["password"];

$hashed = hash("sha256", $password);

$query = $mysql -> prepare ("UPDATE users SET `password` = ? WHERE `user_id` = ?");
$query -> bind_param("si", $hashed, $user_id);
if($query -> execute()){
    $response = [
        "status" => "Password changed"
    ];
};

echo json_encode($response);

?>
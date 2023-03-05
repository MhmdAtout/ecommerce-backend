<?php

include("connection.php");

$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];

$query = $mysql -> prepare ("SELECT * FROM `favourites` WHERE `user_id` = ? AND `product_id` = ?");
$query -> bind_param("ii", $user_id, $product_id);
$query -> execute();
$result = $query -> get_result();

while ($object = $result -> fetch_assoc()){
    $data = $object;
}

if(isset($data)){
    $query = $mysql -> prepare ("DELETE FROM `favourites` WHERE `user_id` = ? AND `product_id` = ?");
    $query -> bind_param("ii", $user_id, $product_id);
    if($query -> execute()){
        $response = [
            "status" => "Removed from favourites"
        ];   
    };
}else{
    $query = $mysql -> prepare("INSERT INTO `favourites` (`user_id`, `product_id`) VALUES (?, ?)");
    $query -> bind_param("ii", $user_id, $product_id);

    if($query -> execute()){
        $response = [
            "status" => "Added to favourites"
        ];
    }else{
        $response = [
            "status" => "Removed from favourites"
        ];
    };
};

echo json_encode($response);

?>
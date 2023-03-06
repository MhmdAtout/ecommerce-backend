<?php
include('connection.php');


$user_id=$_GET['user_id'];
$user_id=$_GET['product_id'];


$query = $mysqli->prepare('select product_id from favourites where user_id=?');
$query->bind_param('i', $user_id);
$query->execute();
$result = $query -> get_result();

while ($object = $result -> fetch_assoc()){
    $data[] = $object;
}
if(isset($data)){
    for($i=0; $i<count($data);$i++){
        $query = $mysqli->prepare('select * from products where product_id=?');
        $query->bind_param('i', $data[i]);
        $query->execute();
        $response+=[
            "products"=>$data[i];
        ];
    }
}

// $response=["user"=>$data];
echo json_encode($response);


?>
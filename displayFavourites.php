<?php
include('connection.php');


$user_id=$_POST['user_id'];



$query = $mysql->prepare('select * from favourites f
                            join products p on p.product_id = f.product_id where user_id=?');
$query->bind_param('i', $user_id);
$query->execute();
$result = $query -> get_result();

while ($object = $result -> fetch_assoc()){
    $data[] = $object;
}
$response["products"]=$data;
// if(isset($data)){
//     for($i=0; $i<count($data);$i++){
//         $query = $mysqli->prepare('select * from products where product_id=?');
//         $query->bind_param('i', $data[i]);
//         $query->execute();
//         $response+=[
//             "products"=>$data[i];
//         ];
//     }
// }

// $response=["user"=>$data];
echo json_encode($response);


?>
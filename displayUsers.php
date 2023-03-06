<?php
include('connection.php');




$query = $mysql->prepare('select * from users');
$query->execute();


$result = $query -> get_result();

while ($object = $result -> fetch_assoc()){
    $data = $object;
}

$response=["user"=>$data];
echo json_encode($response);

?>
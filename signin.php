<?php

include('connection.php');

if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];

    $query = $mysql -> prepare("SELECT * FROM `users` Where user_id = ? ");
    $query -> bind_param("i", $user_id);
    $query -> execute();
    $result = $query->get_result();

    while($object = $result -> fetch_assoc()){
        $data = $object;
    }

    $response = [
        "user" => $data
    ];
}else{
    $credentials = $_POST["credentials"];
    // $username = $_POST["username"];
    // $email = $_POST["email"];

    $password = $_POST["password"];
    $hashed = hash("sha256", $password);

    $query = $mysql -> prepare("SELECT * FROM `admins` WHERE `username`=? or `email`=? AND `password`=?");
    $query -> bind_param("sss", $credentials, $credentials, $hashed);
    $query -> execute();
    $result = $query -> get_result();

    while($object = $result -> fetch_assoc()){
        $data = $object;
    }

    if(isset($data)){
        $response = [
            "id" => $data["admin_id"],
            "user_type" => "admin",
        ];
    }else{
        $query = $mysql -> prepare("SELECT * FROM `users` WHERE `username`=? or `email`=? AND `password`=?");
        $query -> bind_param("sss", $credentials, $credentials, $hashed);
        $query -> execute();
        $result = $query -> get_result();
    
        while($object = $result -> fetch_assoc()){
            $data = $object;
        }
    
        if(isset($data)){
                $response = [
                    "id" => $data["user_id"],
                    "username" => $data["username"],
                    "first_name" => $data["first_name"],
                    "last_name" => $data["last_name"],
                    "user_type" => "customer",
                ];
        }else{
            $response =[
                "message" => "Credentials are incorrect"
            ];
        };
    }

}

echo json_encode($response)

?>
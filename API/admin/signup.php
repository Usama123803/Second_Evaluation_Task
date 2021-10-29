<?php

//headers
header('Content-Type: Application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//get database connection
include_once '../config/database.php';

//get admin data
include_once '../Methods/admin.php';

//making database connection
$database = new Database();
$db = $database->connect();

//calling admin functions
$admin = new admin($db);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->name) && !empty($data->email) && !empty($data->password)){
        $admin->name = $data->name;
        $admin->email = $data->email;
        $admin->password = password_hash($data->password, PASSWORD_DEFAULT);

        if($admin->signup()){
            http_response_code(200);
            echo json_encode(array(
                "status" => 1,
                "message" => "User Registered Succesfully"
            ));
        }else{
            http_response_code(500);
            echo json_encode(array(
            "status" => 0,
            "message" => "Registration Failed"
            ));
        }

    }else{
        http_response_code(500);
        echo json_encode(array(
        "status" => 0,
        "message" => "All data needed"
        ));  
    }

}else{
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ));
}
<?php
    
    require 'dbconnection.php';

    header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
    
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    
     $user_id = $data->user_id;
     $user_name = $data->user_name;
     $user_age = $data->user_age;
     $user_gender = $data->user_gender;
     $user_phone = $data->user_phone;
	 $user_email = $data->user_email;
     $user_image = $data->user_image;
     $user_address= $data->user_address;
     $location_x_coordinate= $data->location_x_coordinate;
     $location_y_coordinate= $data->location_y_coordinate;
     $password= $data->password;
     $hash_password = crypt($password);
    
    echo json_encode($request_body);

    if(isset($data)){
        
    $sql ="INSERT INTO user_profile (user_id,user_name,user_age,user_gender,user_phone,user_email,user_image,user_address,location_x_coordinate,location_y_coordinate, password) 
    VALUES ('$user_id','$user_name','$user_age','$user_gender','$user_phone','$user_email','$user_image','$user_address','$location_x_coordinate','$location_y_coordinate','$hash_password')";

    $result = pg_query($conn,$sql);
    }
?>
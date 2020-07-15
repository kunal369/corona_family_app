<?php
    
    require 'dbconnection.php';

    header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
    
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    
     $family_member_id = $data->family_member_id;
     $family_group_id = $data->family_group_id;
     $user_id = $data->user_id;
     $user_isadmin = $data->user_isadmin;
     $created_on = $data->created_on;
	 $updated_on = $data->updated_on;
    
    echo json_encode($request_body);

    if(isset($data)){
        
    $sql ="INSERT INTO family_group_member (family_member_id,family_group_id,user_id,user_isadmin,created_on,updated_on) 
    VALUES ('$family_member_id','$family_group_id','$user_id','$user_isadmin','$created_on','$updated_on')";

    $result = pg_query($conn,$sql);
    }
?>
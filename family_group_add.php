<?php
    
    require 'dbconnection.php';

    header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
    
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    
     $family_group_id = $data->family_group_id;
     $group_createdby = $data->group_createdby;
     $group_name = $data->group_name;
     $group_image = $data->group_image;
     $created_on = $data->created_on;
	 $updated_on = $data->updated_on;
    
    echo json_encode($request_body);

    if(isset($data)){
        
    $sql ="INSERT INTO family_group (family_group_id,group_createdby,group_name,group_image,created_on,updated_on) 
    VALUES ('$family_group_id','$group_createdby','$group_name','$group_image','$created_on','$updated_on')";

    $result = pg_query($conn,$sql);
    }
?>
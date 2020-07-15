<?php
    
    require 'dbconnection.php';

    header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
    
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    
    $family_member_id = $data->family_member_id;
   json_encode($request_body);
  

   $sql="UPDATE family_group_member
   SET user_blocked = true
   WHERE family_member_id='$family_member_id'";

$ret = pg_query($conn, $sql);
if(!$ret) {
   echo pg_last_error($conn);
   exit;
} 
else{
   echo "User '$family_member_id' is blocked!";
}
pg_close($conn);
    
?>
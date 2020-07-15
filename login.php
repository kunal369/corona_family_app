<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once 'config/dbconnection.php';
include_once 'config/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->user_email = $data->user_email;
$email_exists = $user->emailExists();

// generate json web token
include_once 'config/core.php';
include_once 'libs/src/BeforeValidException.php';
include_once 'libs/src/ExpiredException.php';
include_once 'libs/src/SignatureInvalidException.php';
include_once 'libs/src/JWT.php';
use \Firebase\JWT\JWT;
 
// generate jwt will be here
// check if email exists and if password is correct
if($email_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "data" => array(
           "user_id" => $user->user_id,
           "user_name" => $user->user_name,
           "user_email" => $user->user_email
       )
    );
 
    // set response code
    http_response_code(200);
 
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
 
}
// login failed
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>
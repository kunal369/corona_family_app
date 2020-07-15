<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user_profile";
 
    // object properties
    public $user_id;
    public $user_name;
    public $user_age;
    public $user_gender;
    public $user_phone;
	public $user_email;
    public $user_image;
    public $user_address;
    public $location_x_coordinate;
    public $location_y_coordinate;
	public $password;
	
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create new user record
function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . " 
				SET
                user_id = :user_id,
                user_name = :user_name,
                user_age = :user_age,
                user_gender = :user_gender
				 user_phone = :user_phone,
                user_email = :user_email,
                user_image = :user_image,
                user_address = :user_address,
				location_x_coordinate = :location_x_coordinate,
                location_y_coordinate = :location_y_coordinate,
                password = :password" ;
				
	/*$query= "INSERT INTO user_profile (user_id, user_name, user_age, user_gender,user_phone, user_email, user_image, user_address,location_x_coordinate,location_y_coordinate,password)
        VALUES ('$user_id','$user_name','$user_age','$user_gender','$user_phone','$user_email','$user_image','$user_address','$location_x_coordinate','$location_y_coordinate','$password')";*/
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    //sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->user_name=htmlspecialchars(strip_tags($this->user_name));
    $this->user_age=htmlspecialchars(strip_tags($this->user_age));
    $this->user_gender=htmlspecialchars(strip_tags($this->user_gender));
	$this->user_phone=htmlspecialchars(strip_tags($this->user_phone));
    $this->user_email=htmlspecialchars(strip_tags($this->user_email));
    $this->user_image=htmlspecialchars(strip_tags($this->user_image));
	$this->user_address=htmlspecialchars(strip_tags($this->user_address));
    $this->location_x_coordinate=htmlspecialchars(strip_tags($this->location_x_coordinate));
    $this->location_y_coordinate=htmlspecialchars(strip_tags($this->location_y_coordinate));
    $this->password=htmlspecialchars(strip_tags($this->password));
 
 
    // bind the values
    $stmt->bindParam(':user_id', $this->user_id);
    $stmt->bindParam(':user_name', $this->user_name);
    $stmt->bindParam(':user_age', $this->user_age);
	$stmt->bindParam(':user_gender', $this->user_gender);
    $stmt->bindParam(':user_phone', $this->user_phone);
    $stmt->bindParam(':user_email', $this->user_email);
	$stmt->bindParam(':user_image', $this->user_image);
    $stmt->bindParam(':user_address', $this->user_address);
    $stmt->bindParam(':location_x_coordinate', $this->location_x_coordinate);
	$stmt->bindParam(':location_y_coordinate', $this->location_y_coordinate);
 
    // hash the password before saving to database
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
 


// check if given email exist in the database
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT user_name, password
            FROM " . $this->table_name . "
            WHERE user_email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->user_email=htmlspecialchars(strip_tags($this->user_email));
 
    // bind given email value
    $stmt->bindParam(1, $this->user_email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->user_name = $row['user_name'];
        $this->user_email = $row['user_email'];
        $this->password = $row['password'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}
 
// update() method will be here
}
?>
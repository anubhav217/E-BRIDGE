<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['subject'])) {

    $subject= $_POST['subject'];
    $description= $_POST['description'];
    $username= $_POST['username'];

    $base= $_REQUEST['image'];
    
    $buffer = base64_decode($base);

    $buffer = mysql_real_escape_string($buffer);

  // $subject="2-1 java";
 //  $description="What is Java";
// $file="C:\Users\Downloads/6.png";

 
    // include db connect class
    require_once 'db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `doubts`(subject,description,username,image) VALUES('$subject','$description','$username','$buffer')");
 

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Doubt successfully created.";
        
        echo json_encode($response);
 
  }else{
       $response["success"] = 2;
       $response["message"] = "Already exist";
        
       echo json_encode($response);  }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>

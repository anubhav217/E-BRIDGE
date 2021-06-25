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

  

  // $subject="2-1 java";
  // $description="Java faculty will not attend today";
 
 
    // include db connect class
    require_once 'db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO notification(subject,description,username) VALUES('$subject','$description','$username')");
 

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
        
        echo "success";
 
  }
  else
  {
  echo "Alreay exisit";
  }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
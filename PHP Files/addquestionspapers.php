<?php

//connect to the database
//mysql_connect ("","bloodconnect","blood@123") or die ('Cannot connect to MySQL: ' . mysql_error());
//mysql_select_db ("gavsham_blood") or die ('Cannot connect to the database: ' . mysql_error());

// check for required fields

if (isset($_POST['subject'])) {

    $subject=$_POST['subject'];
    $description=$_POST['description'];

    $base= $_REQUEST['image'];
    
    $buffer = base64_decode($base);

    $buffer = mysql_real_escape_string($buffer);
  
  
 // include db connect class
    require_once 'db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();

//$name="some";
//$file="C:\Users\Innoapps4\Downloads/spinn.png";


//query
$result = mysql_query("INSERT INTO `questions` (subject,description,image) VALUES('$subject','$description','$buffer')") or die ('Query is invalid: ' . mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["questionpapers"] = array();
 //$row = mysql_fetch_array($result);
   while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();

        $product["subject"]=$row["subject"];
        $product["description"]=$row["description"];
        $product["image"] = $row["image"];

        

       
        // push single product into final response array
        array_push($response["questionpapers"], $product);

   };
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["questionpapers"] = "Invalid details";
 
    // echo no users JSON
    echo json_encode($response);
}

}else{
echo "Invalid details";
}
?>
  <?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 

   // include db connect class
    require_once 'db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();

      // echoing JSON response
		 $result = mysql_query("SELECT * FROM doubts") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["doubts"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["subject"] = $row["subject"];
        $product["description"] = $row["description"];
        $product["time"] = $row["time"];
        $product["image"] =base64_encode( $row["image"]);

       
        // push single product into final response array
        array_push($response["doubts"], $product);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
}
		
   
    
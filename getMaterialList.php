<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();
$name = $_POST['list'];


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table

$query = "SELECT name, position+0 as BIT, url FROM material";
$result = mysql_query($query) or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    $response["material"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        $materials = array();
        $materials["name"] = $row["name"];
        $materials["url"] = $row["url"];
        $materials["mhash"] = $row["BIT"];

        // push single product into final response array
        array_push($response["material"], $materials);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
?>

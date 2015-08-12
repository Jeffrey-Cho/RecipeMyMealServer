<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();
$materialHash = (int)$_POST['mhash'];
$toolHash = (int)$_POST['thash'];

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$query = "SELECT name, img_url, mhash, thash, content FROM recipes";
$result = mysql_query($query) or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    $response["recipe"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // check hash value
        if(($row['mhash'] & $materialHash) == $materialHash &&
            ($row['thash'] & $toolHash) == $toolHash) {
                $recipe = array();
                $recipe["name"] = $row["name"];
                $recipe["img_url"] = $row["img_url"];
                $recipe["mhash"] = $row["mhash"];
                $recipe["thash"] = $row["thash"];
                $recipe["content"] = $row["content"];
                // push single product into final response arra
                array_push($response["recipe"], $recipe);
        }
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

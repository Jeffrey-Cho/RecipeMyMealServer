<?php
header("Content-Type: text/html; charset=UTF-8");
/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();
$name = $_GET['name'];
$searchName = utf8_decode($name);

//echo $name;
//echo $searchName;

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table

$query = "SELECT name, img_url, mhash, thash, content FROM recipes WHERE name like '%".$name."%'";

//echo $query;
//$query = "SELECT name, img_url, mhash, thash, content FROM recipes";
$result = mysql_query($query) or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["recipe"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $recipe = array();
        $recipe["name"] = $row["name"];
        $recipe["img_url"] = $row["img_url"];
        $recipe["mhash"] = $row["mhash"];
        $recipe["thash"] = $row["thash"];
        $recipe["content"] = $row["content"];

        // push single product into final response array
        array_push($response["recipe"], $recipe);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
    $response["encoding"] = mb_detect_encoding($name);
    $response["name"] = $name;

    // echo no users JSON
    echo json_encode($response);
}
?>

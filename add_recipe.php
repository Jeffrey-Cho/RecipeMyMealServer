<?php

/**
 * @author 
 * @copyright 2015
 */
 
$checkboxes = array();
$checkboxes = $_POST['checkedbox'];
$name = $_POST['recipe_name'];

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
 
 // $url should be an absolute url
function redirect($url){
    if (headers_sent()){
      die('<script type="text/javascript">window.location.href=\'' . $url . '\';</script>');
    }else{
      header('Location: ' . $url);
      die();
    }    
}

//function makeHash() {
//    global $checkboxes;
//    $resultHash = 1;
//    
//    foreach($checkboxes as $checkboxes=>$value) {
//        echo "checkbox value is ".$value."<br>";
//        $resultHash = $resultHash | $value;
//        echo "result is ".$resultHash."<br>";
//        unset($value); 
//    }
//    
//    echo "final result ".$resultHash;
//    return $resultHash;
//}

$resultHash=0;

echo $PHP_INT_MAX;

foreach ($checkboxes as $checkboxes=>$value) {
    echo "checkbox : ".$value."<br />";
    
    $resultHash = $resultHash | $value;
}

//echo $_POST["recipe_name"];

$query = "INSERT INTO recipes(name, mhash) values('".$name."',".$resultHash.")";

echo $query;

$result = mysql_query($query) or die(mysql_error());

redirect("./recipe_admin.php");
   
?>

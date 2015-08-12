<?php

/**
 * @author 
 * @copyright 2015
 */
 
$checkboxes = array();
$toolcheck = array();
$checkboxes = $_POST['checkedbox'];
$toolcheck = $_POST['toolcheck'];
$name = $_POST['recipe_name'];
$url=$_POST['url'];
$content = "This is sample content.";

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

$resultHash = 0;
$toolhash = 0;

foreach ($checkboxes as $checkboxes=>$value) {
    //echo "checkbox : ".$value."<br />";
     $resultHash = $resultHash | $value;
}

foreach ($toolcheck as $toolcheck=>$value) {
    //echo "checkbox : ".$value."<br />";
     $toolhash = $toolhash | $value;
}


//echo $_POST["recipe_name"];

$query = "INSERT INTO recipes(name, img_url, mhash, thash, content) values('".$name."','".$url."',".$resultHash.",".$toolhash.",'".$content."')";

//echo $query;

$result = mysql_query($query) or die(mysql_error());

redirect("./recipe_admin.php");
   
?>

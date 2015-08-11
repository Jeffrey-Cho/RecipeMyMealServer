<html>
<head>
<title>Recipe Admin page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

?>
<body>

<h1>Recipe Add page</h1>
<h5>Please check your material and add recipe name.</h5>

<br /><br />

<form id="add_recipe_form" action="add_recipe.php" method="post">

<?
// get all products from products table
$result = mysql_query("SELECT name, position+0 as BIT FROM material") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    
    $cnt = 0;
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cnt++;
        $product = array();
        $product["name"] = $row["name"];
        $product["BIT"] = $row["BIT"];
        echo "<input type='checkbox' name='";
        echo $row["name"];
        echo "' value='";
        echo $row["BIT"];
        echo "'>";
        echo $row["name"];
        echo "&nbsp;&nbsp;";
        if (!($cnt%10)) echo "<br>";
    }
    }

?>
<br /><br /><br />
Recipe Name: <input type="text" name="recipe_name" value=""/> <input type="submit" value="Add"/>
</form>

<br />
<h1>Current Recipe List</h1>

<?
$result = mysql_query("SELECT name, mhash, thash FROM recipes") or die(mysql_error());
?>
</body>
</html>

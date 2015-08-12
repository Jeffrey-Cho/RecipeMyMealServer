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

$all_material = array();

function rehash($mhash){
    
    global $all_material;
    $result_array = array();
    
    foreach ($all_material as $material) {
        if ($mhash & $material["BIT"] == $material["BIT"]) {
            push_arrary($result_array, $material);
        }
    }
    return $result_array;
}

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
        
        array_push($all_material, $product);
        
        echo "<input type='checkbox' name='";
        echo "checkedbox[]";
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

<table>
<tr><td>Name</td></tr>

<?

$query2 = "SELECT name FROM recipes";
$result2 = mysql_query($query2) or die(mysql_error());

if (mysql_num_rows($result2) > 0) {
    echo "fetch rows";
    while ($row2 = mysql_fetch_arrary($result2)) {
        echo "while statement";
        echo $row2["name"];
        
        $recipes = array();
//        $meterials = array();
        $recipes["name"] = $row2["name"];
//        $recipes["mhash"] = $row["mhash"];
//        $recipes["thash"] = $row["thash"];
//        
//        echo $row["name"];
//        echo $row["mhash"];
        
//        $meterials = rehash($row["mhash"]);
        
        echo "<tr><td>".$recipes["name"]."</td></tr>";
//        echo "<td>".$recipes["mhash"]."</td>";
//        echo "<td>";
//        foreach($meterials as $value) {
//            echo $value["name"].", ";
//        }
//        echo "</td></tr>";

    }
}

?>

</table>
</body>
</html>

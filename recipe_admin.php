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

<br />

<form id="add_recipe_form" action="add_recipe.php" method="post">

<?

$all_material = array();
$all_tools = array();

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


echo "<h3>Material list</h3>";
echo "<br>";

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


echo "<h3>Tool list</h3>";
echo "<br>";

$result = mysql_query("SELECT name, position+0 as BIT FROM tools") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    
    $cnt = 0;
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cnt++;
        $product = array();
        $product["name"] = $row["name"];
        $product["BIT"] = $row["BIT"];
        
        array_push($all_tools, $product);
        
        echo "<input type='checkbox' name='";
        echo "toolcheck[]";
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
Recipe Name: <input type="text" name="recipe_name" value=""/>&nbsp;&nbsp;Image URL<input type="text" name="url" id="url" value=""/> <input type="submit" value="Add"/>
</form>

<br />
<h1>Current Recipe List</h1>

<table>
<tr><td>Name</td><td width='50'>Image</td><td width='70'>Material Hash</td><td width='70'>Tool Hash</td><td width='100'>Materials</td></tr>

<?

$query = "SELECT name, img_url, mhash+0 as materialHash, thash+0 as toolHash, content FROM recipes";
$result = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    
    while ($row = mysql_fetch_array($result)) {
        $recipes = array();
        $meterials = array();
        $recipes['name'] = $row['name'];
        $recipes['mhash'] = $row['materialHash'];
        $recipes['thash'] = $row['toolHash'];
        $recipes['url'] = $row['img_url'];
        
        //$meterials = rehash($row['materialHash']);
        
        echo "<tr><td>".$recipes['name']."</td>";
        echo "<td><img src='".$recipes['url']."' width='30' height='30'></td>";
        echo "<td>".$recipes['mhash']."</td>";
        echo "<td>".$recipes['thash']."</td>";
        echo "<td>Test";
//        foreach($meterials as $value) {
//            echo $value['name'].", ";
//        }
        echo "</td></tr>";

    }
}

?>

</table>
</body>
</html>

<html>
<head>
<title>Material and Tools Admin page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

?>
<body>

<h1>Material Table</h1>
<h5>Please input material name and bit position number as integer. e.g. 2048 </h5>
<table>
<tr><td>Name</td><td>BIT position</td></tr>
<?
// get all products from products table
$result = mysql_query("SELECT name, position+0 as BIT FROM material") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["name"] = $row["name"];
        $product["BIT"] = $row["BIT"];
        echo "<tr><td>";
        echo $row["name"];
        echo "</td><td>";
        echo $row["BIT"];
        echo "</td></tr>";
    }
}
?>
</table><br /><br />
<form id="material-form" action="add_material.php" method="post">
Name: <input type="text" name="mname" id="mname" value="" />&nbsp;&nbsp;Bit number:<input type="text" name="mbit" id="mbit" value=""/><input type="submit" value="Add"/>
</form>

<br />

<h1>Tools Table</h1>
<h5>Please input material name and bit position number as integer. e.g. 2048 </h5>
<table>
<tr><td>Name</td><td>BIT position</td></tr>
<?
$result = mysql_query("SELECT name, position+0 as BIT FROM tools") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["name"] = $row["name"];
        $product["BIT"] = $row["BIT"];
        echo "<tr><td>";
        echo $row["name"];
        echo "</td><td>";
        echo $row["BIT"];
        echo "</td></tr>";
    }
    
}
?>

</table><br /><br />
<form id="material-form" action="add_tools.php" method="post">
Name: <input type="text" name="tname" id="tname" value="" />&nbsp;&nbsp;Bit number:<input type="text" name="tbit" id="tbit" value=""/><input type="submit" value="Add"/>
</form>

<br />

</body>
</html>
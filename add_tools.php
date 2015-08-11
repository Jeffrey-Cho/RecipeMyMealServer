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

// $url should be an absolute url
function redirect($url){
    if (headers_sent()){
      die('<script type="text/javascript">window.location.href=\'' . $url . '\';</script>');
    }else{
      header('Location: ' . $url);
      die();
    }    
}

echo $_POST['tname'];
echo $_POST['tbit'];

if (isset($_POST['tname']) && isset($_POST['tbit'])) {
    $query = "INSERT INTO tools(name, position) values('".$_POST['tname']."',".$_POST['tbit'].")";
    //echo $query;
    $result = mysql_query($query) or die(mysql_error()); 
    redirect("./material_tools_admin.php");
}
?>
<body>

</body>
</html>
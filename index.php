<html>
<head>
<title>Admin page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php

session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

echo "<p>Welcome. $user_name($user_id)!</p>";
//echo "<p><a href='logout.php'>Log out</a></p>";
?>
<br /><br />
<center>
<a href="recipe_admin.php">Recipe Management</a><br /><br /><br />
<a href="material_tools_admin.php">Material and Tool Management</a><br /><br /><br />
<a href="logout.php">Log out</a><br /><br />
</center>
</body>
</html>
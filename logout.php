<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
session_destroy();
?>
<meta http-equiv='refresh' content='0;url=index.php'>
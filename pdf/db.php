<?php
$username = "root";
$password = "";
$db = "receipt";



$link = mysql_connect("localhost", $username, $password);
mysql_select_db($db) or die(mysql_error());
?>
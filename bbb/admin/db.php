<?php
$username = "root";
$password = "";
$db = "conference";

$link = mysql_connect("localhost", $username, $password);
mysql_select_db($db) or die(mysql_error());
?>
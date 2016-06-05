<?php

$username = "root";
$password = "";
$db = "job_scrapperv1";
$host = "localhost";




$link = mysql_connect($host, $username, $password);
mysql_select_db($db) or die(mysql_error());
mysql_query("SET GLOBAL innodb_flush_log_at_trx_commit = 0");
?>

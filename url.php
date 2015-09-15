<?php

require ('db.php');
mysql_query("SET GLOBAL innodb_flush_log_at_trx_commit = 0");
$res=mysql_query("show variables");
while($row = mysql_fetch_assoc($res)){
	print_r($row);
}
?>
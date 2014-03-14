<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'disce';

$connection = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
if (!$connection || !mysql_select_db($mysql_db)) {
	die('Unable to connect to database: ' . mysql_error());
}
?>
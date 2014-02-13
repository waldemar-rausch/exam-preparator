<?php 
$link = mysql_connect('localhost', 'user', 'password');
if (!$link) {
	die('Verbindung schlug fehl: ' . mysql_error());
}
mysql_select_db('db',$link);
?>

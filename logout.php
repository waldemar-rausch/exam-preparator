<?php 
require_once 'session.php';
require_once 'db.php';
session_destroy();
mysql_close($link);
header("Location: /index.php");
?>
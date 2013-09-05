<?php 
session_start();
if (empty($_SESSION['user']) || empty($_SESSION['password']))
{
	die('Sie sind nicht berechtigt diese Seite zu betretten.');	
}

?>
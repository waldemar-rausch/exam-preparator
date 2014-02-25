<?php 
session_start();
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/Controller/ExamPrepartation.php';

if ($_SESSION['isAdmin']) {
	$controller = new ExamPrepartationController();
	$controller->index();
}
?>

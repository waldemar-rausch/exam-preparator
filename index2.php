<?php 
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/session.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/db.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/Controller/ExamPrepartation.php';

if ($_SESSION['isAdmin']) {
	$controller = new ExamPrepartationController();
	$controller->index();
}
?>
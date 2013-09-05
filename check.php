<?php 
session_start();

require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Controller/Exampreparation.php';


$controller = new Frontend_Controller_ExamPrepartation();
$controller->index();

require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/session.php';
?>

<?php
session_start();
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/session.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Controller/Exampreparation.php';
if ($_SESSION['isAdmin']) {
    $controller = new Frontend_Controller_ExamPreparation();
    $controller->index();
}
?>

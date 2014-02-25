<?php 
session_start();

require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Controller/Exampreparation.php';


$controller = new Frontend_Controller_ExamPreparation();
try{
    $controller->index();
} catch (Exception $e) {
    echo $e->getMessage();
    echo '<br /><a href="/myProject/index.php">Zurück zur Anmeldung.</a>';
    die;
}

require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/session.php';
?>

<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="de">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Controller/Exampreparation.php';


$controller = new Frontend_Controller_ExamPreparation();
try{
    $controller->check();
} catch (Exception $e) {
    echo $e->getMessage();
    echo '<br /><a href="/index.php">Zurück zur Anmeldung.</a>';
    die;
}

require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/session.php';
?>
</body>
</html>

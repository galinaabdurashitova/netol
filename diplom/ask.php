<?php 
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlController = new dbQueries();
$cats = $sqlController->getAllCategories();

$template = $twig->loadTemplate('ask.phtml');

if (!empty($_POST)) {
    if ($sqlController->insertQuestion($_POST['name'], $_POST['email'], $_POST['cat'], $_POST['text'])) {
        $template->display(['isSent' => 1, 'cats' => $cats]);
    } else {
        $template->display(['isSent' => 2, 'cats' => $cats]);
    }
} else {
    $template->display(['isSent' => 0, 'cats' => $cats]);
}
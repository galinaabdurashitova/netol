<?php 
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlQuestionController = new QuestionsQueries();
$sqlCategoriesController = new CategoriesQueries();
$categories = $sqlCategoriesController->getAllCategories();

$template = $twig->loadTemplate('ask.phtml');

if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['cat']) && !empty($_POST['text'])) {
        $sqlQuestionController->newQuestion($_POST['name'], $_POST['email'], $_POST['cat'], $_POST['text']);
        $template->display(['isSent' => Statuses::$sent, 'cats' => $categories]);
    } else {  
        $template->display(['isSent' => Statuses::$notAllData, 'cats' => $categories]);
    }
} else {
    $template->display(['isSent' => Statuses::$notSent, 'cats' => $categories]);
}
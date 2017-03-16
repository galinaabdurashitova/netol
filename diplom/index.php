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

$params = array();
foreach ($cats as $cat) {
    $questions = $sqlController->getQuestionsForCat($cat['id']);
    $cat['questions'] = $questions;
    $params['categories'][] = $cat;
}

$template = $twig->loadTemplate('index.phtml');
$template->display($params);




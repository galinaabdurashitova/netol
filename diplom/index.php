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

$question_data = array();
foreach ($categories as $category) {
    $questions = $sqlQuestionController->getQuestionsForCategory($category['id']);
    $category['questions'] = $questions;
    $question_data['categories'][] = $category;
}

$template = $twig->loadTemplate('index.phtml');
$template->display($question_data);




<?php
session_start();
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlAdminController = new AdminQueries();
$sqlQuestionController = new QuestionsQueries();
$sqlCategoriesController = new CategoriesQueries();
$change['true'] = False;
$isError = Statuses::$notSent;

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'newAdmin':
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $sqlAdminController->newAdmin($_POST['login'], $_POST['password']);
            }
            break;
            
        case 'deleteAdmin':
            if (!empty($_POST['adminID'])) {
                $sqlAdminController->deleteAdmin($_POST['adminID']);
            }
            break;
            
        case 'changePassword':
            if (!empty($_POST['adminID']) && !empty($_POST['newPassword'])) {
                $sqlAdminController->changeAdminPassword($_POST['adminID'], $_POST['newPassword']);
            }
            break;
            
        case 'newCategory':
            if (!empty($_POST['newCatName'])) {
                $sqlCategoriesController->newCategory($_POST['newCatName']);
            }
            break;
            
        case 'deleteCategory':
            if (!empty($_POST['categoryID'])) {
                $sqlCategoriesController->deleteCategory($_POST['categoryID']);
            }
            break;
            
        case 'deleteQuestion':
            if (!empty($_POST['questionID'])) {
                $sqlQuestionController->deleteQuestion($_POST['questionID']);
            }
            break;
            
        case 'hideQuestion':
            if (!empty($_POST['questionID'])) {
                $sqlQuestionController->hideQuestion($_POST['questionID']);
            }
            break;
            
        case 'showQuestion':
            if (!empty($_POST['questionID'])) {
                $sqlQuestionController->showQuestion($_POST['questionID']);    
            }
            break;
            
        case 'changeCategory':
            if (!empty($_POST['questionID']) && !empty($_POST['catID'])) {
                $sqlQuestionController->changeCategory($_POST['questionID'], $_POST['catID']);
            }
            break;
            
        case 'answerQuestion':
            if (!empty($_POST['questionID']) && !empty($_POST['answer']) && !empty($_POST['status'])) {
                $sqlQuestionController->answerQuestion($_POST['questionID'], $_POST['answer'], $_POST['status']);
            }
            break;
            
        case 'changeQuestion':
            if (!empty($_POST['questionID'])) {
                $change = $sqlQuestionController->changeQuestion($_POST['questionID']);
            }
            break;
            
        case 'confirmChangeQuestion':
            if (!empty($_POST['questionID']) && !empty($_POST['name']) && !empty($_POST['text']) && !empty($_POST['answer']) && !empty($_POST['cat'])) {
                $sqlQuestionController->confirmChangeQuestion($_POST['questionID'], $_POST['name'], $_POST['text'], $_POST['answer'], $_POST['cat']);
            }
            break;
        $isError = Status::$error;
    }
}

$admins = $sqlAdminController->getAllAdmins();
$cats = $sqlCategoriesController->getAllCategories();

$params = array();
foreach ($cats as $cat) {
    $allQuestions = $sqlQuestionController->answersCount($cat['id']);
    $naQuestions = $sqlQuestionController->nonansweredAnswersCount($cat['id']);
    $questions = $sqlQuestionController->getQuestionsForCategory($cat['id']);
    $cat['allQuestions'] = $allQuestions;
    $cat['na'] = $naQuestions;
    $cat['questions'] = $questions;
    $params['categories'][] = $cat;
}


if (!empty($_SESSION['isAdmin'])) {
    $template = $twig->loadTemplate('admin-interface.phtml');
    $template->display(['isError' => $isError, 'changing' => $change, 'admins' => $admins, 'categories' => $params['categories']]);
} else {
    $template = $twig->loadTemplate('no-admin-interface.phtml');
    $template->display([]);
}
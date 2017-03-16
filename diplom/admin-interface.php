<?php
session_start();
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlController = new dbQueries();
$change['true'] = False;

if (!empty($_POST)) {
    if (!empty($_REQUEST['newAdmin'])) {
        $sqlController->newAdmin($_POST['login'], $_POST['password']);
    }
    if (!empty($_REQUEST['deleteAdmin'])) {
        $sqlController->deleteAdmin($_POST['adminID']);
    }
    if (!empty($_REQUEST['changePassword'])) {
        $sqlController->changeAdminPassword($_POST['adminID'], $_POST['newPassword']);
    }
    if (!empty($_REQUEST['newCat'])) {
        $sqlController->newCategory($_POST['newCatName']);
    }
    if (!empty($_REQUEST['deleteCat'])) {
        $sqlController->deleteCategory($_POST['adminID']);
    }
    if (!empty($_REQUEST['deleteQuestion'])) {
        $sqlController->deleteQuestion($_POST['questionID']);
    }
    if (!empty($_REQUEST['hideQuestion'])) {
        $sqlController->hideQuestion($_POST['questionID']);
    }
    if (!empty($_REQUEST['showQuestion'])) {
        $sqlController->showQuestion($_POST['questionID']);
    }
    if (!empty($_REQUEST['changeCategory'])) {
        $sqlController->changeCategory($_POST['questionID'], $_POST['catID']);
    }
    if (!empty($_REQUEST['answerQuestion'])) {
        $sqlController->answerQuestion($_POST['questionID'], $_POST['answer'], $_POST['status']);
    }
    if (!empty($_REQUEST['changeQuestion'])) {
        $change = $sqlController->changeQuestion($_POST['questionID']);
    }
    if (!empty($_REQUEST['confirmChangeQuestion'])) {
        $sqlController->confirmChangeQuestion($_POST['questionID'], $_POST['name'], $_POST['text'], $_POST['answer'], $_POST['cat']);
    }
}

$admins = $sqlController->getAllAdmins();
$cats = $sqlController->getAllCategories();

$params = array();
foreach ($cats as $cat) {
    $allQuestions = $sqlController->answersCount($cat['id']);
    $naQuestions = $sqlController->nonansweredAnswersCount($cat['id']);
    $questions = $sqlController->getQuestionsForCat($cat['id']);
    $cat['allQuestions'] = $allQuestions;
    $cat['na'] = $naQuestions;
    $cat['questions'] = $questions;
    $params['categories'][] = $cat;
}


if (!empty($_SESSION['isAdmin'])) {
    $template = $twig->loadTemplate('admin-interface.phtml');
    $template->display(['changing' => $change, 'admins' => $admins, 'categories' => $params['categories']]);
} else {
    $template = $twig->loadTemplate('no-admin-interface.phtml');
    $template->display([]);
}
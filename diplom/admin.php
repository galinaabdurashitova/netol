<?php
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlAdminController = new AdminQueries();
$template = $twig->loadTemplate('admin.phtml');

if (!empty($_POST)) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $report = $sqlAdminController->enterAdmin($_POST['login'], $_POST['password']);
        if ($report === Statuses::$sent) {
        header('Location: admin-interface.php');
        } else {
            $template->display(['isEnter' => $report]);
        }
    } else {
        $template->display(['isEnter' => 'Введите все данные!']);
    }    
} else {
    $template->display(['isEnter' => Statuses::$notSent]);
}

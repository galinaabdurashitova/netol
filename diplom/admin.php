<?php
require 'functions.php';
require_once './Twig-1.32.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './tmp/cache',
));

$sqlController = new dbQueries();
$template = $twig->loadTemplate('admin.phtml');

if (!empty($_POST)) {
    $a = $sqlController->enterAdmin($_POST['login'], $_POST['password']);
    if ($a === 1) {
        header('Location: admin-interface.php');
    } else {
        $template->display(['isEnter' => $a]);
    }
} else {
    $template->display(['isEnter' => 0]);
}

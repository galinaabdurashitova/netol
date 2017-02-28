<?php
    require 'functions.php';
    
    if (!isPost()) {
        if (!empty($_POST['password'])) {
            if (adminLogin($_POST['login'], $_POST['password'])) {
                header('Location: admin.php');
                die;
            }
        } else {
            if (login($_POST['login'])) {
                header('Location: list.php');
                die;
            }   
        }
    }
?>
<!doctype HTML>
<html>
    <head></head>
    <body>
        <form method="post">
           Авторизуйтесь или войдите как гость<br>
            <label for="login">Логин: </label>
            <input id="login" name="login" value="<?= getParamPost('login') ?>"><br>
            <label for="password">Пароль: </label>
            <input id="password" name="password" type="password"><br>
            <input type="submit" value="Войти">
        </form>
    </body>
</html>

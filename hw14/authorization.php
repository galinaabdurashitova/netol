<?php
require 'functions.php';
$pdo = new PDO("mysql:host=;dbname=abdurashitova", "abdurashitova", "neto0800");

if (isset($_REQUEST['enter'])) {
    enter($pdo);
}

if (isset($_REQUEST['register'])) {
    register($pdo);
}

?>
<html>
<head>
</head>
<body>
  <b>Зарегистрируйтесь или войдите:</b>
  <br>
  <form action="" method="POST">
    <label for="login">Логин:</label>
    <input id="login" name="login">
    <br>
    <label for="password">Пароль:</label>
    <input id="password" name="password" type="password">
    <br>
    <input type="submit" name="enter" value="Вход">
    <input type="submit" name="register" value="Регистрация">
  </form>
</body>
</html>

<?php
require 'functions.php';

if (isFILES()) {
    $respond = checking_files();
    if ($respond['is_error'] === 1) {
        die($respond['message']);
    }
    header('Location: list.php');
}

if (!isAdmin()) {
    http_response_code(403);
    die('Нет доступа');
}
?>
<!doctype HTML>
<html>
  <head>
    <title>Форма загрузки</title>
  </head>
  <body>
   <? if (!empty($_SESSION['name'])): ?>
       Привет, <?= $_SESSION['name'] ?>!
   <? endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="test">Загрузите json файл с тестом!</label> <br>
      <input name="test" type="file"> <br><br>
      <button type="submit">Отправить</button>
    </form>
  <br><br>
  <a href="list.php">Список загруженных тестов</a>
  <br>
  <a href="logout.php">Выход</a>
  </body>
</html>

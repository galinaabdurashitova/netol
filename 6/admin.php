<?php
  require 'functions.php';

  if (isFILES()) {
    $respond = checking_files();
    if ($respond['is_error'] == 1) {
      die($respond['message']);
    }
  }
?>
<!doctype HTML>
<html>
  <head>
    <title>Форма загрузки</title>
  </head>
  <body>
  <? if (!isFILES()): ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="test">Загрузите json файл с тестом!</label> <br>
      <input name="test" type="file"> <br><br>
      <button type="submit">Отправить</button>
    </form>
  <? else: ?>
    <p>Ваш тест успешно загружен! <a href="admin.php">Хотите загрузить еще?</a></p>
  <? endif; ?>
  <br><br>
  <a href="list.php">Список загруженных тестов</a>
  </body>
</html>

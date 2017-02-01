<?php
  require 'functions.php';

  if (isFILES()) {
    header('Location: list.php');
  }
?>
<!doctype HTML>
<html>
  <head>
    <title>Форма загрузки</title>
  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="test">Загрузите json файл с тестом!</label> <br>
      <input name="test" type="file"> <br><br>
      <button type="submit">Отправить</button>
    </form>
  <br><br>
  <a href="list.php">Список загруженных тестов</a>
  </body>
</html>

<?php
    require 'functions.php';
    $test_names = scandir(__DIR__ . '/tests/');
?>
<!doctype HTML>
<html>
  <head>
    <title>Список тестов</title>
  </head>
  <body>
   <? if (!empty($_SESSION['name'])): ?>
       Привет, <?= $_SESSION['name'] ?>!
   <? endif; ?>
    <ul>
    <?php foreach($test_names as $test): ?>
      <?php if(substr($test, strpos($test, '.') + 1) === 'json'): ?>
        <li>
          <a href="test.php?test_name=<?= substr($test, 0, strpos($test, '.')) ?>">
            Тест <?= substr($test, 0, strpos($test, '.')) ?>
          </a>
          <?php if(isAdmin()): ?>
              <a style="color: red" href="delete.php?test=<?= $test ?>">Х</a>
          <?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
    </ul>
    <br>
    <a href="logout.php">Выход</a>
  </body>
</html>

<?php
  $test_names = scandir(__DIR__ . '/tests/');
?>
<!doctype HTML>
<html>
  <head>
    <title>Список тестов</title>
  </head>
  <body>
    <ul>
    <? foreach($test_names as $test): ?>
      <? if(substr($test, strpos($test, '.') + 1) === 'json'): ?>
        <li>
          <a href="test.php?test_name=<?= substr($test, 0, strpos($test, '.')) ?>">
            Тест <?= substr($test, 0, strpos($test, '.')) ?>
          </a>
        </li>
      <? endif; ?>
    <? endforeach; ?>
    </ul>
  </body>
</html>

<?php
  require 'functions.php';
  $json = file_get_contents(__DIR__ . '/tests/' . $_GET['test_name'] . '.json');
  $test_array = json_decode($json, true);
?>
<!doctype HTML>
<html>
  <head>
    <title>Тест <?= $_GET['test_name'] ?></title>
  </head>
  <body>
    <? if (isPOST()): ?>
      <form action="" method="POST">
        <? foreach($test_array as $test_questions): ?>
          <label for="<?= $test_questions['id'] ?>"><?= $test_questions['question'] ?></label> <br>
          <input id="<?= $test_questions['id'] ?>" name="<?= $test_questions['id'] ?>"> <br><br>
        <? endforeach; ?>
        <br>
        <button type="submit">Отправить</button>
      </form>
    <? else: ?>
      <? foreach($test_array as $test_questions): ?>
        <p><b>Вопрос <?= $test_questions['id'] ?></b> <br>
        Ваш ответ: <?= $_POST[$test_questions['id']] ?><br>
        <span style="background-color:
          <? if($_POST[$test_questions['id']] === $test_questions['answer']): ?>
            PaleGreen
          <? else: ?>
            LightCoral
          <? endif; ?>
          ">
        Правильный ответ: <?= $test_questions['answer'] ?></span></p>
      <? endforeach; ?>
      <a href="list.php">К списку тестов</a>
    <? endif; ?>
  </body>
</html>

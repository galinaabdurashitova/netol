<?php
  require 'functions.php';
  $path_to_file = __DIR__ . '/tests/' . $_GET['test_name'] . '.json';
  if (file_exists($path_to_file)) {
    $json = file_get_contents($path_to_file);
    $test_array = json_decode($json, true);
  } else {
    http_response_code(404);
    echo 'Cтраница не найдена!';
    exit(1);
  }

  $correct_answers = 0;
?>
<!doctype HTML>
<html>
  <head>
    <title>Тест <?= $_GET['test_name'] ?></title>
  </head>
  <body>
    <? if (isPOST()): ?>
      <form action="" method="POST">
        <label for="name">Ваше имя:</label> <br>
        <input id="name" name="name"> <br><br>
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
        <? if($_POST[$test_questions['id']] === $test_questions['answer']): ?>
          <span style="background-color: PaleGreen">
          <? $correct_answers++; ?>
        <? else: ?>
          <span style="background-color: LightCoral">
        <? endif; ?>
        Правильный ответ: <?= $test_questions['answer'] ?></span></p>
      <? endforeach; ?>
      <img src="card.php?name=<?= $_POST['name'] ?>&result=<?= (int) ($correct_answers / count($test_questions) * 100) ?>">
    <? endif; ?>
  </body>
</html>

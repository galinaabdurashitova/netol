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
    <?php if (isPOST()): ?>
      <form action="" method="POST">
        <?php foreach($test_array as $test_questions): ?>
          <label for="<?= $test_questions['id'] ?>"><?= $test_questions['question'] ?></label> <br>
          <input id="<?= $test_questions['id'] ?>" name="<?= $test_questions['id'] ?>"> <br><br>
        <?php endforeach; ?>
        <br>
        <button type="submit">Отправить</button>
      </form>
    <?php else: ?>
      <?php foreach($test_array as $test_questions): ?>
        <p><b>Вопрос <?= $test_questions['id'] ?></b> <br>
        Ваш ответ: <?= $_POST[$test_questions['id']] ?><br>
        <?php if($_POST[$test_questions['id']] === $test_questions['answer']): ?>
          <span style="background-color: PaleGreen">
          <?php $correct_answers++; ?>
        <?php else: ?>
          <span style="background-color: LightCoral">
        <?php endif; ?>
        Правильный ответ: <?= $test_questions['answer'] ?></span></p>
      <?php endforeach; ?>
      <img src="card.php?name=<?= $_SESSION['name'] ?>&result=<?= (int) ($correct_answers / count($test_questions) * 100) ?>">
    <?php endif; ?>
  </body>
</html>

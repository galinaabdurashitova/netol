<?php
  require 'functions.php';
  $comment1 = new Comment('Катя', 'Наше правительство как всегда занимается не тем');
  $comment2 = new Comment('Боря', 'Это был был мой друг, Андрюха!!!');
  $comment3 = new Comment('Лера', 'С ума сойти...');
  $comments = array($comment1, $comment2, $comment3);

  $news1 = new News('Кота отправили в космос', '12 октября', 'Ученые добились невозможного.');
  $news2 = new News('Сделали самый большой бутерброд', '13 ноября', 'Ученые добились невозможного.');
  $news3 = new News('Открыли Америку', '3 декабря', 'Ученые добились невозможного.');

  $newsArray = array($news1, $news2, $news3);
?>
<!doctype HTML>
<html>
  <head>
    <title>Новости</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <? foreach ($newsArray as $note): ?>
      <div class="news">
        <p><b>
        <?= $note->getDate() ?>:
        <?= $note->getHeader() ?>
        </b></p>
      <p>
        <?= $note->getContent() ?>
      </p>
      <p><i>Комментарии:</i></p>
      <? foreach ($note->getComments($comments) as $comment): ?>
        <div class="comment">
          <p>
            <?= $comment ?>
          </p>
        </div>
      <? endforeach; ?>
      </div>
    <? endforeach; ?>
  </body>
</html>

<?php
  require 'functions.php';
  $comment1 = new Comment('Катя', 'Наше правительство как всегда занимается не тем');
  $comment2 = new Comment('Боря', 'Это был был мой друг, Андрюха!!!');
  $comment3 = new Comment('Лера', 'С ума сойти...');
  $comments1 = array($comment1, $comment2, $comment3);

  $comment1 = new Comment('Катя', 'Я в это не верю');
  $comment2 = new Comment('Боря', 'Я тоже');
  $comment3 = new Comment('Лера', 'Не согласна со всеми');
  $comments2 = array($comment1, $comment2, $comment3);

  $comment1 = new Comment('Катя', 'Так себе новость');
  $comment2 = new Comment('Боря', 'Ну удивили');
  $comment3 = new Comment('Лера', 'Всякое бывает');
  $comments3 = array($comment1, $comment2, $comment3);


  $news1 = new News('Кота отправили в космос', '12 октября', 'Ученые добились невозможного.');
  $news1->addComments($comments1);
  $news2 = new News('Сделали самый большой бутерброд', '13 ноября', 'Ученые добились невозможного.');
  $news2->addComments($comments2);
  $news3 = new News('Открыли Америку', '3 декабря', 'Ученые добились невозможного.');
  $news3->addComments($comments3);
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
        <? foreach ($note->getComments() as $comm): ?>
          <div class="comment">
            <p>
              <b><?= $comm->getLogin() ?>:</b>
              <?= $comm->getContent() ?>
            </p>
          </div>
        <? endforeach; ?>
      </div>
    <? endforeach; ?>
  </body>
</html>

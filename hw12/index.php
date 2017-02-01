<?php
$pdo = new PDO("mysql:host=localhost;dbname=books", "root", "");

if (empty($_GET)) {
  $sql = "SELECT * FROM books";
} else {
  $sql = "SELECT * FROM books
          WHERE name LIKE \"%" . $_GET['name'] . "%\"
          AND author LIKE \"%" . $_GET['author'] . "%\"
          AND isbn LIKE \"%" . $_GET['isbn'] . "%\"";
}

?>

<html>
<head></head>
<body>
  <table style="border: 1px solid black">
    <caption><h2>Список книг</h2></caption>
    <tr style="font-weight: bold">
      <td>Название</td>
      <td>Автор</td>
      <td>Год</td>
      <td>ISBN</td>
      <td>Жанр</td>
    </tr>
    <? foreach ($pdo->query($sql) as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['year'] ?></td>
        <td><?= $row['isbn'] ?></td>
        <td><?= $row['genre'] ?></td>
      </tr>
    <? endforeach ?>
  </table>

  <h3>Найти нужное</h3>
  <form action="" method="GET">
    <label for="name">Название: </label>
    <input type="text" id="name" name="name" value="<?= $_GET['name']?>">
    <br><br>
    <label for="author">Автор: </label>
    <input type="text" id="author" name="author" value="<?= $_GET['author']?>">
    <br><br>
    <label for="isbn">ISBN: </label>
    <input type="text" id="isbn" name="isbn" value="<?= $_GET['isbn']?>">
    <br><br>
    <input type="submit" value="Найти">
  </form>
</body>
</html>

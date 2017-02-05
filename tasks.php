<?php
$pdo = new PDO("mysql:host=localhost;dbname=tasks", "root", "");

if (!empty($_POST)) {
  if (!empty($_POST['description'])) {
    $insertData = "INSERT INTO tasks (description, is_done, date_added)
                    VALUES (?, ?, ?)";
    $statement = $pdo->prepare($insertData);
    $taskArr = array($_POST['description'], 0, date('d.m.Y H:i'));
    $statement->execute($taskArr);
  }
}
if (!empty($_GET)) {
  if (!empty($_GET['delete'])) {
    $getSQL = "DELETE FROM tasks WHERE id=" . $_GET['delete'];
  }
  if (!empty($_GET['done'])) {
    $getSQL = "UPDATE tasks SET is_done = 1 WHERE id = " . $_GET['done'];
  }
  if (!empty($_GET['undone'])) {
    $getSQL = "UPDATE tasks SET is_done = 0 WHERE id = " . $_GET['undone'];
  }
  $pdo->prepare($getSQL)->execute();
  header('Location: tasks.php');
}

$sql = "SELECT * FROM tasks";

?>
<html>
  <head></head>
  <body>
    <h1>Список дел</h1>

    <form action="" method="POST">
      <label for="description">Введите дело: </label>
      <input id="description" name="description" type="text">
      <input type="submit" value="Добавить">
    </form>

    <table>
      <tr>
        <td>Выполнено</td>
        <td>Дело</td>
        <td>Дата добавления</td>
        <td></td>
        <td></td>
      </tr>
      <? foreach ($pdo->query($sql) as $row): ?>
        <tr>
          <td>
            <? if ($row['is_done'] != 0): ?>
              <span style="color: darkgreen;">Сделано!</span>
            <? else: ?>
              <span style="color: darkred;">Не сделано</span>
            <? endif; ?>
            </form>
          </td>
          <td>
            <?= $row['description'] ?>
          </td>
          <td><?= $row['date_added'] ?></td>
          <td>
            <? if ($row['is_done'] != 0): ?>
              <a href="tasks.php?undone=<?= $row['id'] ?>">Не выполнено</a>
            <? else: ?>
              <a href="tasks.php?done=<?= $row['id'] ?>">Выполнить</a>
            <? endif; ?>
          </td>
          <td><a href="tasks.php?delete=<?= $row['id'] ?>">Удалить</a></td>
        </tr>
      <? endforeach; ?>
    </table>
  </body>
</html>

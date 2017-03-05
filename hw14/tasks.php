<?php
require 'functions.php';
$pdo = new PDO("mysql:host=;dbname=abdurashitova", "abdurashitova", "neto0800");


if (isset($_REQUEST['taskInput'])) {
    addTask($_POST['description'], $_SESSION['id'], $pdo);
}

if (isset($_REQUEST['responsible'])) {
    $changeSQL = "UPDATE task SET assigned_user_id = ? WHERE id = ?";
    $statement = $pdo->prepare($changeSQL);
    $idArr = array($_POST['new_assigned_user'], $_POST['taskID']);
    $statement->execute($idArr);
}

if (!empty($_GET)) {
    upgradeTask($pdo);
}

$sql1 = <<<SQL
SELECT task.id, task.assigned_user_id, task.description, task.is_done, task.date_added, user.login
FROM task
CROSS JOIN user 
ON task.user_id = user.id 
WHERE task.user_id = ?
SQL;
$stm1 = $pdo->prepare($sql1);
$stm1->execute([$_SESSION['id']]);

$sql2 = <<<SQL
SELECT task.id, task.assigned_user_id, task.description, task.is_done, task.date_added, user.login
FROM task
CROSS JOIN user 
ON task.user_id = user.id 
WHERE task.assigned_user_id = ?
SQL;
$stm2 = $pdo->prepare($sql2);
$stm2->execute([$_SESSION['id']]);

$usersSQL = "SELECT * FROM user";

$assignedUserSQL = "SELECT login FROM user WHERE id = ?";
$stm3 = $pdo->prepare($assignedUserSQL);

?>
<html>
  <head></head>
  <body>
    <h1>Список дел от <?= $_SESSION['name'] ?></h1>

    <form action="" method="POST">
      <label for="description">Введите дело: </label>
      <input id="description" name="description" type="text">
      <input type="submit" name="taskInput" value="Добавить">
    </form>

    <table>
      <tr>
        <td>Автор</td>
        <td>Обязанный</td>
        <td>Выполнено</td>
        <td>Дело</td>
        <td>Дата добавления</td>
        <td>Переложить ответственность</td>
        <td></td>
        <td></td>
      </tr>
      <?php foreach ($stm1->fetchAll() as $row): ?>
        <tr>
          <td>
            <?= $row['login'] ?>
          </td>
          <td>
            <?php $stm3->execute([$row['assigned_user_id']]); 
              echo $stm3->fetchAll()[0]['login']; ?>
          </td>
          <td>
            <?php if ($row['is_done'] != 0): ?>
              <span style="color: darkgreen;">Сделано!</span>
            <?php else: ?>
              <span style="color: darkred;">Не сделано</span>
            <?php endif; ?>
          </td>
          <td>
            <?= $row['description'] ?>
          </td>
          <td><?= $row['date_added'] ?></td>
          <td>
             <form action="" method="POST">
               <select name="new_assigned_user">
                <?php foreach ($pdo->query($usersSQL) as $userData): ?>
                    <option value="<?= $userData['id'] ?>"><?= $userData['login'] ?></option>
                <?php endforeach; ?>
                </select>
                <input type="hidden" value="<?= $row['id'] ?>" name="taskID">
                <input type="submit" name="responsible" value="Сделать ответственым">
             </form>
          </td>
          <td>
            <?php if ($row['is_done'] != 0): ?>
              <a href="tasks.php?undone=<?= $row['id'] ?>">Не выполнено</a>
            <?php else: ?>
              <a href="tasks.php?done=<?= $row['id'] ?>">Выполнить</a>
            <?php endif; ?>
          </td>
          <td><a href="tasks.php?delete=<?= $row['id'] ?>">Удалить</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
    
    
    <h1>Список дел для <?= $_SESSION['name'] ?></h1>

    <table>
      <tr>
        <td>Автор</td>
        <td>Обязанный</td>
        <td>Выполнено</td>
        <td>Дело</td>
        <td>Дата добавления</td>
        <td></td>
      </tr>
      <?php foreach ($stm2->fetchAll() as $row): ?>
        <tr>
          <td>
            <?= $row['login'] ?>
          </td>
          <td>
            <?php $stm3->execute([$row['assigned_user_id']]); 
              echo $stm3->fetchAll()[0]['login']; ?>
          </td>
          <td>
            <?php if ($row['is_done'] != 0): ?>
              <span style="color: darkgreen;">Сделано!</span>
            <?php else: ?>
              <span style="color: darkred;">Не сделано</span>
            <?php endif; ?>
          </td>
          <td>
            <?= $row['description'] ?>
          </td>
          <td><?= $row['date_added'] ?></td>
          <td>
            <?php if ($row['is_done'] != 0): ?>
              <a href="tasks.php?undone=<?= $row['id'] ?>">Не выполнено</a>
            <?php else: ?>
              <a href="tasks.php?done=<?= $row['id'] ?>">Выполнить</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    
    <a href="logout.php">Выход</a>
  </body>
</html>

<?php
    include  'functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
</head>
<body>
    <table border="1">
        <?php foreach (get_records() as $record): ?>
            <tr>
                <td><?= $record['first_name'] . ' ' . $record['last_name'] ?></td>
                <td><?= $record['adress'] ?></td>
                <td><?= $record['phone_number'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
</body>
</html>

<?php
unlink(__DIR__ . '/tests/' . $_GET['test']);
header('Location: list.php');
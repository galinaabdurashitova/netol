<?php 
require 'functions.php';
$pdo = new PDO("mysql:host=;dbname=d", "root", "");

$catsSQL = 'SELECT * FROM categories';
$stm = $pdo->prepare($catsSQL);
$stm->execute();
$isFirst = True;

$questions = 'SELECT * FROM questions WHERE cat = ?';


?>


<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>FAQ</title>
</head>
<body>
<header>
	<h1>FAQ</h1>
</header>
<a href="admin.php">Администрирование</a><br><br>
<a href="ask.php">Задать вопрос</a>
<section class="cd-faq">
	<ul class="cd-faq-categories">
	    <?php foreach ($menu->fetchAll() as $row): ?>
            <li><a href="#<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
		<?php endforeach; ?>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
	    <?php foreach ($cats->fetchAll() as $row): ?>
            <ul id="<?= $row['id'] ?>" class="cd-faq-group">
                <li class="cd-faq-title"><h2><?= $row['name'] ?></h2></li>
	            <?php $questions->execute([$row['id']]);
                    foreach ($questions->fetchAll() as $question): ?>
	                <li>
                        <a class="cd-faq-trigger" href="#0"><?= $question['text'] ?></a>
                        <div class="cd-faq-content">
                            <p><?= $question['date'] ?>: <?= $question['name'] ?> (<?= $question['email'] ?>)</p>
                            <p><?= $question['answer'] ?></p>
                        </div> <!-- cd-faq-content -->
                    </li>
		        <?php endforeach; ?>
            </ul>
		<?php endforeach; ?>
	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
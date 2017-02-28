<?php
    require 'functions.php';
    header('Content-Type: image/png');
    renderCard($_GET['name'], $_GET['result']);

<?php

function isFILES() {
  return !empty($_FILES);
}


function isPOST() {
  return empty($_POST);
}


function checking_files() {
  $destination = __DIR__ . '/tests/' . $_FILES['test']['name'];
  if (substr($_FILES['test']['name'], strpos($_FILES['test']['name'], '.') + 1) != 'json') {
    return array('is_error' => 1, 'message' => 'Неверный формат файла');
  }
  $json = file_get_contents($_FILES['test']['tmp_name']);
  if (!json_decode($json, true)) {
    return array('is_error' => 1, 'message' => 'Неверный формат файла');
  }
  if (!move_uploaded_file($_FILES['test']['tmp_name'], $destination)) {
    return array('is_error' => 1, 'message' => 'Файл не удалось загрузить');
  }
  return array('is_error' => 0, 'message' => '');
}


function renderCard($text, $result)
{
    
    $im = imagecreatetruecolor(800, 600);
    $backColor = imagecolorallocate($im, 221, 224, 255);
    $textColor = imagecolorallocate($im, 15, 60, 129);
    $medalIm = imagecreatefrompng(__DIR__ . '/assets/medal-flat.png');
    $fontPath = __DIR__ . '/assets/Futurica.ttf';
    imagefill($im, 0, 0, $backColor);
    imagecopy($im, $medalIm, 250, 270, 0, 0, 256, 256);
    imagettftext($im, 60, 0, 250, 100, $textColor, $fontPath, $text . '!');
    imagettftext($im, 24, 0, 80, 170, $textColor, $fontPath, 'Поздравляем с прохождением теста!');
    imagettftext($im, 24, 0, 200, 240, $textColor, $fontPath, 'Твой результат: ' . $result . '%');
    imagepng($im);
    imagedestroy($im);
    imagedestroy($medalIm);
}


function checkAvailable()
{
    return true;
}

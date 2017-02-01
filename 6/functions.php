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

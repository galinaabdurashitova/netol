<?php
session_start();

function get_users_passwords($login, $password) {
    $user_names = scandir(__DIR__ . '/users/');
    foreach ($user_names as $user) {
        if (substr($user, 0, strpos($user, '.')) === $login) {
            $json = file_get_contents(__DIR__ . '/users/' . $user);
            $user_password = json_decode($json, true);
            if ($user_password['password'] === $password) {
                return true;
            } 
        } 
    }
    return false;
}


function adminLogin($login, $password)
{
    if (get_users_passwords($login, $password)) {
        $_SESSION['name'] = $login;
        $_SESSION['is_admin'] = true;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        return true;
    }
    return false;
}


function login($login)
{   
    if (!empty($login)) {
        $_SESSION['name'] = $login;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        return true;
    } else {
        return false;
    }
    
}


function isAdmin() {
    if (!empty($_SESSION['is_admin'])) {
        if ($_SESSION['is_admin'] === true) {
            return true;
        }
    }
    return false;
}


function isFILES() {
  return !empty($_FILES);
}


function isPOST() {
  return empty($_POST);
}


function getParamPost($name, $defaultValue = null) {
    return !empty($_POST[$name]) ? $_POST[$name] : $defaultValue;
}


function logout() {
    session_destroy();
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

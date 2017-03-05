<?php
session_start();


function login($login, $id)
{   
    $_SESSION['name'] = $login;
    $_SESSION['id'] = $id;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];    
}

function logout()
{
    session_destroy();
}

function isPost()
{
    return (!empty($_POST));
}

function enter($pdo)
{
    if (!isPost()) {
        echo 'Необходимо ввести данные!<br>';
    } else {
        $enterSQL = 'SELECT * FROM user WHERE login = ?';
        $statement = $pdo->prepare($enterSQL);
        $statement->execute([$_POST['login']]);
        $userData = $statement->fetch();
        if (empty($userData)) {
            echo 'Пользователя не существует' . $data['login'];
        } else {
            if ($_POST['password'] === $userData['password']) {
                login($_POST['login'], $userData['id']);
                header('Location: tasks.php');
            } else {
                echo 'Пароль неверный';   
            }
        }
    }
}

function register($pdo)
{
    if (!isPost()) {
        echo 'Необходимо ввести данные!<br>';
    } else {
        $enterSQL = 'SELECT * FROM user WHERE login = ?';
        $statement = $pdo->prepare($enterSQL);
        $statement->execute([$_POST['login']]);
        $userData = $statement->fetch();
        if (empty($userData)) {
            $registerSQL = 'INSERT INTO user (login, password) VALUES (?, ?)';
            $statement = $pdo->prepare($registerSQL);
            $data = array($_POST['login'], $_POST['password']);
            $statement->execute($data);
            $findIDsql = 'SELECT id FROM user WHERE login = ?';
            $statement = $pdo->prepare($findIDsql);
            $statement->execute([$_POST['login']]);
            $userData = $statement->fetch();
            login($_POST['login'], $userData['id']);
            header('Location: tasks.php');
        } else {
            echo 'Такой пользователь уже существует!<br>';
        }
    }
}

function addTask($description, $id, $pdo)
{
    $insertData = "INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id)
                    VALUES (?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($insertData);
    $taskArr = array($description, 0, date('d.m.Y H:i'), $id, $id);
    $statement->execute($taskArr);
}

function upgradeTask($pdo)
{
    if (!empty($_GET['delete'])) {
        $getSQL = "DELETE FROM task WHERE id = ?";
        $statement = $pdo->prepare($getSQL);
        $statement->execute([$_GET['delete']]);
    }
    if (!empty($_GET['done'])) {
        $getSQL = "UPDATE task SET is_done = 1 WHERE id = ?";
        $statement = $pdo->prepare($getSQL);
        $statement->execute([$_GET['done']]);
    }
    if (!empty($_GET['undone'])) {
        $getSQL = "UPDATE task SET is_done = 0 WHERE id = ?";
        $statement = $pdo->prepare($getSQL);
        $statement->execute([$_GET['undone']]);
    }
    header('Location: tasks.php');
}
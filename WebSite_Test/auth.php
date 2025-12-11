<?php
session_start();

// простое хранилище пользователей в JSON
$usersFile = 'users.json';
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$users = json_decode(file_get_contents($usersFile), true);

// получаем POST данные
$fname = trim($_POST['fname'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$action = $_POST['action'] ?? '';

if (!$fname || !$senha) {
    echo 'error';
    exit;
}

if ($action === 'register') {
    // проверяем, существует ли пользователь
    foreach ($users as $u) {
        if ($u['username'] === $fname) {
            echo 'exists';
            exit;
        }
    }

    // добавляем пользователя
    $users[] = [
        'username' => $fname,
        'password' => password_hash($senha, PASSWORD_DEFAULT)
    ];

    file_put_contents($usersFile, json_encode($users));
    echo 'ok';
    exit;
}

if ($action === 'login') {
    foreach ($users as $u) {
        if ($u['username'] === $fname && password_verify($senha, $u['password'])) {
            $_SESSION['user'] = $fname;
            echo 'ok';
            exit;
        }
    }
    echo 'error';
    exit;
}

echo 'error';

<?php
header('Content-Type: text/plain');

$file = 'password.php';
$users = [];

if(file_exists($file)){
    include($file); // подключаем массив $users
}

$fname = $_POST['fname'] ?? '';
$senha = $_POST['senha'] ?? '';
$action = $_POST['action'] ?? '';

if($fname === '' || $senha === ''){
    echo "error";
    exit;
}

if($action === 'register'){
    if(isset($users[$fname])){
        echo "exists"; // пользователь уже есть
        exit;
    }
    $users[$fname] = $senha;
    file_put_contents($file, "<?php\n\$users = " . var_export($users, true) . ";\n?>");
    echo "ok";
    exit;
}

if($action === 'login'){
    if(isset($users[$fname]) && $users[$fname] === $senha){
        echo "ok";
    } else {
        echo "error";
    }
    exit;
}

echo "error";
?>

<?php
session_start();

$file = __DIR__ . '/password.php';
$users = [];

// Загружаем существующих пользователей
if (file_exists($file)) {
    include($file);
    if (!isset($users) || !is_array($users)) {
        $users = [];
    }
} else {
    // Создаём пустой файл при необходимости
    file_put_contents($file, "<?php\n\$users = [];\n?>");
}

$fname = trim($_POST['fname'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$action = $_POST['action'] ?? '';

if ($fname === '' || $senha === '') {
    echo "error_empty";
    exit;
}

// --- Регистрация ---
if ($action === 'register') {
    if (isset($users[$fname])) {
        echo "exists";
        exit;
    }

    $users[$fname] = password_hash($senha, PASSWORD_DEFAULT);

    $data = "<?php\n\$users = " . var_export($users, true) . ";\n?>";
    $result = @file_put_contents($file, $data);

    if ($result === false) {
        // Диагностика
        echo "error_write: " . realpath($file) . "Falha ao escrever. Verifique as permissões.";
        exit;
    }

    echo "ok";
    exit;
}

// --- Вход ---
if ($action === 'login') {
    if (isset($users[$fname]) && password_verify($senha, $users[$fname])) {
        $_SESSION['user'] = $fname;
        echo "ok";
        exit;
    } else {
        echo "error_login";
        exit;
    }
}

echo "error_action";


if ($action === 'register') {
    if (isset($users[$fname])) {
        echo "exists";
        exit;
    }

    $users[$fname] = password_hash($senha, PASSWORD_DEFAULT);

    $data = "<?php\n\$users = " . var_export($users, true) . ";\n?>";
    $result = @file_put_contents($file, $data);

    if ($result === false) {
        echo "error_write: " . realpath($file) . "Falha ao escrever. Verifique as permissões.";
        exit;
    }

    // Автоматически логиним пользователя после регистрации
    $_SESSION['user'] = $fname;

    echo "ok";
    exit;
}



?>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Для простого примера — любой введенный логин проходит
    $_SESSION['user'] = $username;

    header("Location: index.php");
    exit;
}

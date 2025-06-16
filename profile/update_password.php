<?php


// Подключение к БД
require_once '../vendor/components/core.php';

// Проверяем авторизацию (если нужно)
if (!isset($_SESSION['user']['id'])) {
    die("Ошибка: доступ запрещён.");
}

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'], $_POST['value'])) {
    $field = $_POST['field'];
    $value = trim($_POST['value']);
    $userId = $_SESSION['user']['id']; // Берём ID из сессии


    // Подготовленный запрос
    $stmt = mysqli_prepare($link, "UPDATE users SET password = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $value, $userId);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: profile.php');
    } else {
        echo "Ошибка: " . mysqli_error($link);
    }
} else {
    echo "Ошибка: неверные данные.";
}

mysqli_close($link);
?>
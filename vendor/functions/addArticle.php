<?php
require_once '../components/core.php';

// Включим отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверяем, что запрос действительно POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем наличие обязательных полей
    if (!isset($_POST['title'], $_POST['description'])) {
        $_SESSION['error'] = "Не все обязательные поля заполнены";
        header("Location: ../../admin.php");
        exit;
    }

    // Получаем данные из формы
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $image = '';
    $created_at = date('Y-m-d H:i:s'); // Используем текущую дату и время

    // Обработка загружаемого изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/'; // Изменил путь (должен быть относительно корня сайта)
        
        // Создаем директорию, если её нет
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Генерируем уникальное имя файла
        $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $image = uniqid() . '.' . $fileExt;
        $uploadPath = $uploadDir . $image;
        
        // Проверяем тип файла через mime-тип
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
        finfo_close($finfo);
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowedTypes)) {
            $_SESSION['error'] = "Допустимы только файлы изображений (JPEG, PNG, GIF)";
            header("Location: ../../admin.php");
            exit;
        }
        
        // Перемещаем загруженный файл
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $_SESSION['error'] = "Ошибка при загрузке изображения";
            header("Location: ../../admin.php");
            exit;
        }
    }

    // Проверяем соединение с БД
    if (!$link) {
        $_SESSION['error'] = "Ошибка подключения к базе данных";
        header("Location: ../../admin.php");
        exit;
    }

    // Подготавливаем запрос
    $stmt = $link->prepare("INSERT INTO news (image, title, description, created_at) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Ошибка подготовки запроса: " . $link->error;
        header("Location: ../../admin.php");
        exit;
    }

    // Привязываем параметры и выполняем запрос
    $stmt->bind_param("ssss", $image, $title, $description, $created_at);
    if (!$stmt->execute()) {
        $_SESSION['error'] = "Ошибка выполнения запроса: " . $stmt->error;
        header("Location: ../../admin.php");
        exit;
    }

    // Проверяем результат
    if ($stmt->affected_rows > 0) {
        $_SESSION['message'] = "Статья успешно добавлена!";
    } else {
        $_SESSION['error'] = "Ошибка при добавлении статьи.";
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Неверный метод запроса.";
}

// Перенаправляем обратно в админку
header("Location: ../../admin.php");
exit;
?>
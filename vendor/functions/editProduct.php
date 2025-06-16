<?php
require_once "../components/core.php";

// Проверяем, были ли отправлены данные из формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Получаем и проверяем ID товара
    $product_id = (int)$_POST['id'];
    if ($product_id <= 0) {
        die("Неверный ID товара");
    }

    // Проверяем обязательные поля
    if (!isset($_POST['name'], $_POST['price'])) {
        die("Не все обязательные поля заполнены");
    }

    // Получаем и очищаем данные
    $new_name = $link->real_escape_string(trim($_POST['name']));
    $new_price = (float)$_POST['price'];

    // Подготавливаем SQL для обновления без изображения
    $sql = "UPDATE `products` SET `name` = ?, `price` = ?";
    $params = [$new_name, $new_price];
    $types = "sd";

    // Обработка загрузки нового изображения (если оно было загружено)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "../../uploads/";
        
        // Проверяем тип файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
        finfo_close($finfo);
        
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed_mimes)) {
            die("Недопустимый тип файла. Разрешены только JPG, JPEG, PNG и GIF.");
        }

        // Генерируем уникальное имя файла
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_image_name = uniqid() . '.' . $ext;
        $upload_file = $upload_dir . $new_image_name;

        // Загружаем файл
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            die("Ошибка при загрузке изображения.");
        }

        // Получаем текущее изображение для удаления
        $result = $link->query("SELECT `image` FROM `products` WHERE `id` = $product_id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $old_image = $row['image'];
            
            // Удаляем старое изображение
            if ($old_image && file_exists($upload_dir . $old_image)) {
                unlink($upload_dir . $old_image);
            }
        }

        // Добавляем изображение в запрос
        $sql .= ", `image` = ?";
        $params[] = $new_image_name;
        $types .= "s";
    }

    // Завершаем SQL запрос
    $sql .= " WHERE `id` = ?";
    $params[] = $product_id;
    $types .= "i";

    // Выполняем подготовленный запрос
    $stmt = $link->prepare($sql);
    $stmt->bind_param($types, ...$params);
    
    if ($stmt->execute()) {
        echo "Товар успешно обновлен.";
    } else {
        echo "Ошибка при обновлении товара: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Данные не были отправлены или отсутствует ID товара.";
}
?>
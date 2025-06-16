<?php
require_once "../components/core.php";

// Проверяем, был ли отправлен ID товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Удаляем товар из базы данных
    $sql = "DELETE FROM `products` WHERE `id` = $product_id";
    if ($link->query($sql)) {
        echo "Товар успешно удалён.";
    } else {
        echo "Ошибка при удалении товара: " . $link->error;
    }

    // Перенаправляем обратно на страницу удаления
    header("Location: ../../shop/market.php");
    exit();
} else {
    echo "Неверный запрос.";
}
?>
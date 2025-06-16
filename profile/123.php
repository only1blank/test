<?php
require_once 'vendor/components/core.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   


    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }

    $stmt = $link->prepare("INSERT INTO users (image) VALUES (?)");
    $stmt->bind_param("sss", $image);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Аватарка успешно добавлена!";
    } else {
        echo "Ошибка при добавлении статьи.";
    }

    $stmt->close();
}


header("Location: /profile.php");
exit;
?>
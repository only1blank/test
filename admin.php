<?php 
    require_once 'vendor/components/header.php';
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="adminpanel">
            <div class="adminpanel__block_addProduct">
                <h1>Добавление товара</h1>
                <form action="/vendor/functions/addProduct.php" method="post" enctype="multipart/form-data">
                <label for="image">Изображение</label>    
                    <input name="image" type="file">
                <label for="name">Название</label>
                    <input type="text" name="name" id="">
                <label for="price">Цена</label>
                    <input type="text" name="price" id="">
                <button>Добавить товар</button>
                </form>
            </div>
        </div> <br>
        <div class="redactor"><h1>Редактирование товара</h1>
    <form action="vendor/functions/editProduct.php" method="POST" enctype="multipart/form-data">
        <select name="id" id="product_id" required>
            <option value="">-- Выберите товар --</option>
            <?php
             $sql = "SELECT `id`, `name` FROM `products`";
$result = $link->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>Товары не найдены</option>";
            }
            ?>
        </select>
        <br>
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Цена:</label>
        <input type="number" step="0.01" id="price" name="price" required>
        <br>
        <label for="image">Изображение:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <br>
        <button type="submit">Обновить товар</button>
    </form> <br>
</div>

        <div class="delete"><h1>Удаление товара</h1>
    <form action="vendor/functions/delete_product.php" method="POST">
        <label for="product_id">Выберите товар для удаления:</label>
        <select name="product_id" id="product_id" required>
            <option value="">-- Выберите товар --</option>
            <?php
             $sql = "SELECT `id`, `name` FROM `products`";
$result = $link->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>Товары не найдены</option>";
            }
            ?>
        </select>
        <button type="submit">Удалить товар</button>
    </form>
</div> <br>
            <div class="add">
            <form action="../vendor/functions/addArticle.php" method="POST" enctype="multipart/form-data" class="article-form">
            <h2>Добавить новую статью</h2>
            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Текст статьи:</label>
            <textarea id="description" name="description" rows="10" required></textarea>

            <label for="image">Фото статьи:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Добавить статью</button>
        </form>
    </div>
           
        </div>
        <div class="footer">
        <div class="allfoot">
            <img src="../Allnews/logo4.png" style="width: 350px; height: 100px; margin:  0 auto;" alt="">
            <div class="icons">
                <li><a href="https://vk.com/hc_avangardomsk"> <img src="../Line-up/icons/vk.svg" alt=""></li></a>
                <li><a href="https://t.me/s/omskiyavangard"> <img src="../Line-up/icons/tg.svg" alt=""></a></li>
                <li><a href="https://www.youtube.com/@HCAvangardTV"> <img src="../Line-up/icons/youtube.svg" alt=""></a>
                </li>
                <li><a href="https://www.instagram.com/avangard_inside/?hl=ru"> <img src="../Line-up/icons/insta.svg"
                            alt=""></a></li>
                <li><a
                        href="https://apps.apple.com/us/app/%D1%85%D0%BA-%D0%B0%D0%B2%D0%B0%D0%BD%D0%B3%D0%B0%D1%80%D0%B4/id1426468334?l=ru&ls=1&utm_source=hawk&utm_medium=footer&utm_campaign=app">
                        <img src="../Line-up/icons/app-store.svg (1).svg" alt=""></a></li>
                <li><a
                        href="https://appgallery.huawei.com/app/C109037935?utm_source=hawk&utm_medium=footer&utm_campaign=app">
                        <img src="../Line-up/icons/app-huawei.svg.svg" alt=""></a></li>
                <li><a
                        href="https://play.google.com/store/apps/details?id=ru.hawk.app&utm_source=hawk&utm_medium=footer&utm_campaign=app">
                        <img src="../Line-up/icons/google.svg" alt=""></a></li>
            </div>
        </div>
    </div>
</body>
</html>
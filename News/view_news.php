<?php 
require_once '../vendor/components/header.php'
?>
<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Некорректный ID новости");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM news WHERE id = $id";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    die("Новость не найдена");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($row['title']) ?></title>
    <link href="news.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1><?= htmlspecialchars($row['title']) ?></h1>
    <img src="../uploads/<?php echo $row['image']; ?>" class="img-fluid my-4" alt="Изображение">
    <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
    <a href="news.php" class="btn btn-secondary position-fixed top-0 start-0 m-3 z-3" style="background-color: red;"> Назад к новостям</a>
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

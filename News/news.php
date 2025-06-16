<?php 
require '../vendor/components/header.php'; 


$query = "SELECT * FROM news ORDER BY id DESC";
$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../logo-app-new.png">
    <link rel="stylesheet" href="news.css">
    <title>Фан-клуб - ХК "Авангард"</title>
</head>

<body>

   
    <div class="container">
<div class="all-blocks">
    <div class="news">
    <div class="news__cards">
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="news__card_item">
            <div class="news__item_image">
<img src="../uploads/<?php echo $row['image']; ?>" alt="">
            </div>
            <div class="news__item_title">
<p><?php echo $row['title']; ?></p>
            </div>
            <div class="news__item_button">
                <a href="view_news.php?id=<?= $row['id'] ?>">Читать</a>
            </div>
        </div>
        <?php }
} ?>
    </div>
</div>
  
<div class="sidebar">
  
    
    <div class="sidebar__news">
        <article class="news-card">
            <a href="../Allnews/10news.html" class="news-card__link">
                <img src="../News/kyrianov.png" alt="Новость о легионерах в КХЛ" class="news-card__image">
                <h4 class="news-card__title">«Наша позиция — вернуться к пяти легионерам, так возрастет конкуренция в КХЛ»</h4>
            </a>
        </article>
        
        <article class="news-card">
            <a href="../Allnews/11news.html" class="news-card__link">
                <img src="../News/razin.png" alt="Новость о Разине и Магнитке" class="news-card__image">
                <h4 class="news-card__title">Разин — король упущенных побед. У «Магнитки» проблемы</h4>
            </a>
        </article>
        
        <article class="news-card">
            <a href="../Allnews/12news.html" class="news-card__link">
                <img src="../News/morozov.png" alt="Новость о Морозове" class="news-card__image">
                <h4 class="news-card__title">Алексей Морозов рассказал о плюсах увеличения числа легионеров в КХЛ</h4>
            </a>
        </article>
    </div>
</div>
    </div>
</div>
        
    <div class="footer">
        <div class="allfoot">
            <img src="../HC_Avangard_Logo.svg.png" style="width: 150px; height: 90px;  padding: 10px" alt="">
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
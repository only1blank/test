<?php 
require_once 'vendor/components/core.php';
$query = "SELECT * FROM news ORDER BY id DESC";
$result = mysqli_query($link, $query);

if ($_POST) {
    $result = $link->query("SELECT * FROM `users` WHERE `phone` = '{$_POST['phone']}' 
    AND `password` = '{$_POST['password']}'");
    if ($result->num_rows > 0) {
        foreach ($result as $key => $value) {
            $_SESSION['user']['id'] = $value['id'];
            $_SESSION['user']['role'] = $value['role_id'];
            header('Location: index.php');
        }
    } else {
        echo "<script>alert('Ошибка!');</script>";
    }
}

if ($_POST) {
    $link->query("INSERT INTO `users`(
         `name`, 
         `surname`,
          `email`, 
          `gender`, 
          `phone`, 
          `password`,
          `role_id`) 
    VALUES ('{$_POST['name']}',
    '{$_POST['surname']}',
    '{$_POST['email']}',
    '{$_POST['gender']}',
    '{$_POST['phone']}',
    '{$_POST['password']}',
    '1')");
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="glav.css">
    <link rel="icon" type="image/x-icon" href="../hawk.png">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Омский Авангард</title>
    <style>
.news-swiper {
    width: 100%;
    padding: 20px 0 40px;
}

.news-swiper .swiper-slide {
    width: 280px;
    height: auto;
    background: transparent;
}

.news-item {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.news-item img {
    width: 100%;
    height: 190px;
    object-fit: cover;
}

.news-item h3 {
    padding: 15px;
    font-size: 16px;
    margin: 0;
    flex-grow: 1;
}

.news-item p {
    padding: 0 15px 15px;
    margin: 0;
    color: #666;
    font-size: 14px;
}
.swiper{
    width: 1400px !important;
}
.swiper-button-prev, 
.swiper-button-next {
    color: #fff;
    background: rgba(0,0,0,0.5);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.swiper-button-prev::after, 
.swiper-button-next::after {
    font-size: 20px;
}

.swiper-pagination {
    bottom: 10px !important;
}

.swiper-pagination-bullet {
    background: #fff;
    opacity: 0.6;
}

.swiper-pagination-bullet-active {
    background: #d00;
    opacity: 1;
}
    </style>
</head>

<body>
    <div class="logo">
        <header>
            <li class="ava"><a href="../index.php"><img src="../logo.png" alt="" width="450PX"
                        height="100px"></a></li>
        </header>
    </div> <div class="head">
    <nav>
        <ul class="giper">
            <b>
                <li class="bilet"><a href="../login/login.php"> <img src="tickets.png" alt=""> Билеты</a></li>
                <li><a href="../historyclub/index.php">Клуб</a></li>
                <li><a href="../Line-up/sostav.php">Состав команды</a></li>
                <li><a href="../News/news.php">Новости</a></li>
                <li><a href="../Fanclub/fan.php">Фан-клуб</a></li>
                <li><a href="../media/media.php">Медиа</a></li>
                <li><a href="../Shop/market.php">Маркет</a></li>
                <li class="profile">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="../Profile/profile.php">
                            <img src="hawk.png" style="width: 20px; height: 20px;" alt="">
                            <i>Профиль</i>
                        </a>
                        <?php if ($_SESSION['user']['role'] == '2'): ?>
                            <a href="../admin.php" style="margin-left: 100px;">admin panel</a>
                        <?php endif; ?>
                        <a href="../vendor/functions/logout.php" style="margin-left: 20px;">Выйти</a> 
                    <?php else: ?>
                        <button id="openAuthModal">
                            <img src="hawk.png" style="width: 20px; height: 20px;" alt="">
                            Регистрация/Авторизация
                        </button>
                    <?php endif; ?>
                </li>
            </b>
        </ul>
    </nav>
</div>
    <div class="container">
 <!-- Модальное окно авторизации -->
<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="login">
            <img class="aye" src="../logo-app-new.png" alt="Логотип">
            <h1>Авторизуйтесь или зарегистрируйтесь на сайте</h1>
            <form action="" method="post">
                <div class="right_bl4">
                    <input type="text" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
                    <input maxlength="16" placeholder="Пароль" type="password" name="password">
                </div>
                <div class="vopros">
                    <button type="submit">Войти</button>
                </div>
                <p class="required-field">(* - обязательные поля для ввода)</p>
                <div class="reg">
                    <a id="openRegFromAuth">
                        <p id="registr" style="cursor: pointer; ">Регистрация</p>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Модальное окно регистрации -->
<div id="regModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="login">
            <img class="aye" src="../logo-app-new.png" alt="Логотип">
            <form action="" method="post">
                <h1>РЕГИСТРАЦИЯ</h1>
                <div class="right_bl4">
                    <input type="text" name="name" maxlength="16" placeholder="Имя*" id="name">
                    <input type="text" name="surname" maxlength="16" placeholder="Фамилия*" id="surname">
                    <input type="email" name="email" maxlength="16" placeholder="Ваш e-mail*" id="mail">
                    <select name="gender">
                        <option value="" disabled selected>Выберите ваш пол</option>
                        <option value="man">Мужской</option>
                        <option value="woman">Женский</option>
                        <option value="idk">Затрудняюсь ответить</option>
                    </select>
                    <input type="text" name="phone" id="regPhone" placeholder="+7 (___) ___-__-__">
                    <input maxlength="16" placeholder="Пароль*" type="password" name="password">
                </div>
                <div class="vopros">
                    <button type="submit">Зарегистрироваться</button>
                </div>
                <p class="required-field">(* - обязательные поля для ввода)</p>
                <div class="reg">
                    <a id="openAuthFromReg">
                        <p id="registr" style="cursor: pointer;">Уже есть аккаунт?</p>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
        <div class="wrapper">
            <div id="wrap">
           

                <div class="gdrive">
                    <li> <a href="https://gdrive-arena.ru/"><img src="gdrv-arena_omsk-_-night-1edit-min.jpg" alt=""
                                style="width: 900px; height: 600px; margin-left: 1px; "> </a> </li>
                    <li style="width: 395.11px; display: flex; justify-content: flex-end; "> <a
                            href="../Кубок Гагарина/kybok.html">
                            <img src="stena2.png" alt="" style="height: 600px; "></a></li>
                </div>
                <div class="banner">
                    <img src="moloko.png" alt="">
                    <img src="gdrive.png" alt="">
                    <img src="fonbet.png" alt="">
                    <img src="VIPZONE.png" alt="">
                </div>
                <div class="news">
                    Последние Новости
                </div>

               
 <!-- Slider main container -->
<div class="swiper news-swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="swiper-slide">
                    <div class="news-item">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <h3><a class="news__title_item" href="News/view_news.php?id=<?= $row['id'] ?>"><?php echo htmlspecialchars($row['title']); ?></a></h3>
                        <p><?php echo htmlspecialchars($row['created_at']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    
    <!-- Navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    
    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>
                <div class="button_news">
                    <a href="../News/news.php"> <button id="newnews">ВСЕ НОВОСТИ</button></a>
                </div>


                <div class="photo">
                    Последние фото
                </div>
                <div class="allphoto">
                    <div class="lastphoto">
                        <img src="../111.png" style="width: 280px; height: 190px;" alt="">
                        <h1> Авангард - Локомотив 0:2
                            Вокруг матча</h1>
                        <p>
                            30 марта 2024 - 111 фото
                        </p>
                    </div>
                    <div class="lastphoto">
                        <img src="../124.png" style="width: 280px; height: 190px;" alt="">
                        <h1>30.03.2024. Авангард - Локомотив 0:2</h1>
                        <p>
                            30 марта 2024 - 124 фото
                        </p>
                    </div>
                    <div class="lastphoto">
                        <img src="../52.png" style="width: 280px; height: 190px;" alt="">
                        <h1>28.03.2024. Локомотив - Авангард 2:3</h1>
                        <p>
                            29 марта 2024 - 52 фото
                        </p>
                    </div>
                    <div class="lastphoto">
                        <img src="../22.png" style="width: 280px; height: 190px;" alt="">
                        <h1>Раскатка Авангарда перед 6 матчем с Локомотивом</h1>
                        <p>
                            28 марта 2024 - 22 фото
                        </p>
                    </div>
                </div>
                <div class="button_photo">
                    <button id="newphoto">БОЛЬШЕ ФОТО</button>
                </div>

                <div class="photo">
                    Лучшие игроки
                </div>

                <div class="players">
                    <div class="scorers">
                        <img src="../score.png" style="width: 280px; height: 190px;" alt="">
                        <div class="vt1">
                            <p>Владимир <br> Ткачев</p>
                            <p>11</p>
                        </div>
                        <div class="vt">
                            <p>Семён <br> Чистяков</p>
                            <p>7</p>
                        </div>
                        <div class="vt">
                            <p>Райан<br> Спунер</p>
                            <p>6</p>
                        </div>
                        <div class="vt">
                            <p>Томаш<br> Юрчо</p>
                            <p>5</p>
                        </div>
                    </div>
                    <div class="scorers">
                        <img src="../goals1.png" style="width: 280px; height: 190px;" alt="">
                        <div class="vt1">
                            <p>Томаш<br> Юрчо</p>
                            <p>3</p>
                        </div>
                        <div class="vt">
                            <p>Семён <br> Чистяков</p>
                            <p>3</p>
                        </div>
                        <div class="vt">
                            <p>Михаил <br> Гуляев</p>
                            <p>2</p>
                        </div>
                        <div class="vt">
                            <p>Николай <br> Прохоркин</p>
                            <p>2</p>
                        </div>
                    </div>

                    <div class="scorers">
                        <img src="../assists.png" style="width: 280px; height: 190px;" alt="">
                        <div class="vt1">
                            <p>Райан<br> Спунер</p>
                            <p>5</p>
                        </div>
                        <div class="vt">
                            <p>Дамир <br> Жафяров</p>
                            <p>4</p>
                        </div>
                        <div class="vt">
                            <p>Дамир <br> Шарипзянов</p>
                            <p>4</p>
                        </div>
                        <div class="vt">
                            <p>Семён <br> Чистяков</p>
                            <p>4</p>
                        </div>
                    </div>
                    <div class="scorers">
                        <img src="../plus.png" style="width: 280px; height: 190px;" alt="">
                        <div class="vt1">Семён <br> Чистяков</p>
                            <p>3</p>
                        </div>
                        <div class="vt">Иван <br> Николишин</p>
                            <p>2</p>
                        </div>
                        <div class="vt">
                            <p>Дамир <br> Жафяров</p>
                            <p>1</p>
                        </div>
                        <div class="vt">Иван <br> Игумнов</p>
                            <p>1</p>
                        </div>
                    </div>
                </div>
                <div class="button_score">
                    <a href="#"> <button id="allscore">СТАТИСТИКА <br> ИГРОКОВ</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="allfoot">
            <img src="../Line-up/icons/foothawk.svg" style="width: 1229px; height: 80px; margin:  0 auto;" alt="">
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs'
  
  var newsSwiper = new Swiper('.news-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      }
    }
  });
   const options = {
            bottom: '32px', // Позиция кнопки (снизу)
            right: '32px', // Позиция кнопки (справа)
            left: 'unset', // Отключаем левую позицию
            time: '0.7s', // Длительность анимации
            mixColor: '#fff', 
            backgroundColor: '#fff',  
            buttonColorDark: '#100f2c',  
            buttonColorLight: '#fff',
            saveInCookies: true, // Сохранять выбор в куки
            label: '🌓', // Иконка кнопки
            autoMatchOsTheme: true // Автовыбор темы ОС
        };
        
        const darkmode = new Darkmode(options);
        darkmode.showWidget();

</script>
<script>
$(document).ready(function(){
    // Инициализация масок для телефона
    $('#phone, #regPhone').mask('+7 (999) 999-99-99');
    
    // Открытие модального окна авторизации
    $('#openAuthModal').click(function() {
        $('#authModal').fadeIn();
    });
    
    // Открытие модального окна регистрации из авторизации
    $('#openRegFromAuth').click(function() {
        $('#authModal').fadeOut();
        $('#regModal').fadeIn();
    });
    
    // Открытие модального окна авторизации из регистрации
    $('#openAuthFromReg').click(function() {
        $('#regModal').fadeOut();
        $('#authModal').fadeIn();
    });
    
    // Закрытие модальных окон при клике на крестик
    $('.close-btn').click(function() {
        $(this).closest('.modal').fadeOut();
    });
    
    // Закрытие модальных окон при клике вне их
    $(window).click(function(event) {
        if ($(event.target).is('.modal')) {
            $('.modal').fadeOut();
        }
    });
    
    // Предотвращение закрытия при клике внутри модального окна
    $('.modal-content').click(function(event) {
        event.stopPropagation();
    });
});
</script>
<script src="glav.js"></script>

</html>
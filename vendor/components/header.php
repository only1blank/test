<?php
require_once 'core.php'

?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=photki.0">
  <link rel="icon" type="image/x-icon" href="../logo-app-new.png">
  <link rel="stylesheet" href="market.css">
  <link rel="stylesheet" href="news.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>

</head>

<body>
<div class="header">
    <div class="header__logo">
        <a href="../index.php" class="header__logo-link">
            <img src="../logo.png" alt="Логотип ХК Авангард" class="header__logo-image" width="450" height="100">
        </a>
    </div>
    
    <div class="container-header">
        <div class="navigation">
            <nav class="navigation__menu">
                <ul class="navigation__list">
                    <li class="navigation__item navigation__item--tickets">
                        <a href="../login/login.php" class="navigation__link">
                            <img src="../tickets.png" alt="" class="navigation__icon">
                            Билеты
                        </a>
                    </li>
                    <li class="navigation__item">
                        <a href="../historyclub/index.php" class="navigation__link">О клубе</a>
                    </li>
                    <li class="navigation__item">
                        <a href="../Line-up/sostav.php" class="navigation__link">Состав команды</a>
                    </li>
                    <li class="navigation__item">
                        <a href="../News/news.php" class="navigation__link">Новости</a>
                    </li>
                    <li class="navigation__item">
                        <a href="../Fanclub/fan.php" class="navigation__link">Фан-клуб</a>
                    </li>
                    <li class="navigation__item">
                        <a href="../media/media.php" class="navigation__link">Медиа</a>
                    </li>
                    <li class="navigation__item">
                        <a href="../Shop/market.php" class="navigation__link">Маркет</a>
                    </li>
                    <li class="navigation__item navigation__item--profile">
                        <?php if (isset($_SESSION['user'])): ?>
                            <div class="profile">
                              <ul><li><img src="../hawk.png" alt="Профиль" class="profile__image">
                                <a href="../Profile/profile.php" class="profile__link">
                                    
                                    <span class="profile__text">Профиль</span></li></ul>
                                </a>
                                
                                <?php if ($_SESSION['user']['role'] == '2'): ?>
                                    <a href="../admin.php" class="profile__admin-link">admin panel</a>
                                <?php endif; ?>
                                <a href="../vendor/functions/logout.php" class="profile__logout-link">Выйти</a>
                            </div>
                        <?php else: ?>
                            <a href="../login/login.php" class="auth-link">
                                <img src="../hawk.png" alt="Авторизация" class="auth-link__image">
                                <span class="auth-link__text">Регистрация/Авторизация</span>
                            </a>
                        <?php endif; ?>
                       
        
    </div>
  <script>
        // Инициализация Darkmode.js
        const options = {
            bottom: '32px', // Позиция кнопки (снизу)
            right: '32px', // Позиция кнопки (справа)
            left: 'unset', // Отключаем левую позицию
            time: '0.5s', // Длительность анимации
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
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
    .darkmode--activated {
    background: #0d0d0d;

}

.darkmode--activated h1 {
 
}

.head {
  background-color: #f1f2f3;
  color: #000000;
  padding: 20px 0;
  font-family: 'Courier New', Courier, monospace;
  align-items: center;
  text-align: center;
  display: flex;
justify-content: center;
 isolation: isolate;
}

body {
transition: background 0.3s ease;
}
header {
  background-color: #484647;
  color: #fff;
  text-align: center;
  text-decoration: none;
  list-style: none;
  max-width: 100%;
   isolation: isolate;
}



nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  
}

nav ul li {
  display: flex;
    align-items: center;
}

nav ul li a {
  color: #000000;
  text-decoration: none;
  padding: 10px;
  position: relative;
   isolation: isolate;
}

nav ul li a:hover::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 100%;
  height: 2px;
  background-color: red;
   isolation: isolate;
}

nav ul li img {
  width: 15px;
  height: 15px;
}
.profile__image{
  display: flex;
  align-items: center;
}
.profile{
  display: flex;
  align-items: center;
}
    /* Блок header */
    .header {
  background-color: #484647;
        padding: 15px 0;
         isolation: isolate;
    }
    
    .header__logo {
        text-align: center;
        margin-bottom: 15px;
    }
    
    .header__logo-image {
        max-width: 100%;
        height: auto;
    }
    
    /* Блок navigation */
    .navigation__menu {
        display: flex;
        justify-content: center;
    }
    
    .navigation__list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 20px;
    }
    
    .navigation__item {
        position: relative;
    }
    
    .navigation__link {
        color: white;
        text-decoration: none;
       font-family: "Montserrat", sans-serif;
       font-weight: 5 00;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        transition: color 0.3s;
    }
    
    .navigation__link:hover {
        color: #f0f0f0;
    }
    
    .navigation__icon {
        margin-right: 8px;
        width: 20px;
        height: 20px;
    }
    
    /* Блок profile */
    .profile {
        display: flex;
        align-items: center;
        gap: 15px;
        font-family: "Montserrat", sans-serif;
       font-weight: 500;
    }
    
    .profile__image {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }
    
    .profile__link,
    .profile__admin-link,
    .profile__logout-link {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .profile__link:hover,
    .profile__admin-link:hover,
    .profile__logout-link:hover {
        color: #f0f0f0;
    }
    
    /* Блок auth-link */
    .auth-link {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
    }
    
    .auth-link__image {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }
    
    /* Модификаторы */
    .navigation__item--tickets {
        background-color: #d32f2f;
        border-radius: 4px;
    }
    
    .navigation__item--profile {
        margin-left: auto;
    }
    
    @media (max-width: 1200px) {
        .navigation__list {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .navigation__item--profile {
            margin-left: 0;
            width: 100%;
            text-align: center;
        }
    }
</style>
<?php
require_once '../vendor/components/core.php';



if ($_POST) {
    $result = $link->query("SELECT * FROM `users` WHERE `phone` = '{$_POST['phone']}' 
    AND `password` = '{$_POST['password']}'");
    if ($result->num_rows > 0) {
        foreach ($result as $key => $value) {
            $_SESSION['user']['id'] = $value['id'];
            $_SESSION['user']['role'] = $value['role_id'];
            header('Location: ../index.php');
        }
    } else {
        echo "<script>alert('Ошибка!');</script>";
    }
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" type="image/x-icon" href="../hawk.png">
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Вход</title>
</head>

<body>
    <div class="logo">
        <header>
            <li class="ava"><a href="../index.php"><img src="../logo.png" alt="" width="450PX"
                        height="95px"></a></li>
        </header>
    </div>

    <div class="vhod">
        <form action="" method="post">
            <div class="login">
                <img class="aye" src="../logo-app-new.png" alt="">
                <h1>Для того, чтобы сделать заказ вам
                    необходимо авторизоваться или
                    зарегистрироваться на сайте</h1>
                <div class="right_bl4">
                    <input type="text" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
                    <input maxlength="16" placeholder="Пароль" type="password" name="password">
                </div>
                <div class="vopros">
                    <button>Войти</button>
                </div>
                <p style="padding: 10px; color: white;">(* - обязательные поля для ввода)</p>
                <div class="reg">
                    <a href="../Vosstanovlenie/vosst.html">
                        <p id="no_pass">Забыли пароль?</p>
                    </a>
                    <a href="../registration/register.php">
                        <p id="registr">Регистрация</p>
                    </a>

                </div>
            </div>
        </form>
    </div>

<script>
$(document).ready(function(){
    $('#phone').mask('+7 (999) 999-99-99');
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

    
</body>

</html>
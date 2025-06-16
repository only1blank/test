<?php
require_once '../vendor/components/core.php';

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
    header('Location: ../Login/login.php');
}

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="icon" type="image/x-icon" href="../hawk.png">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Регистрация</title>
</head>

<body>
    <div class="logo">
        <header>
            <li class="ava"><a href="../index.php"><img src="../logo.png" alt="" width="450PX"
                        height="95px"></a></li>
        </header>
    </div>
    <div class="vhod">

        <div class="login">
            <img class="aye" src="../logo-app-new.png" alt="">
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
                    <input type="text" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
                    <input maxlength="16" placeholder="Пароль*" type="password" name="password">

                </div>
                <div class="vopros">
                    <button>Войти</button>
                </div>
            </form>

            <p style="padding: 10px; color: white;">(* - обязательные поля для ввода)</p>
            <div class="reg">
                <a href="../Login/login.php">
                    <p id="registr">Уже есть аккаунт?</p>
                </a>

            </div>
        </div>
    </div>
    <div class="footer">
  <div class="allfoot">
    <img src="../Line-up/icons/foothawk.svg" style="width: 1229px; height: 80px; margin:  0 auto;" alt="">
    <div class="icons">
      <li><a href="https://vk.com/hc_avangardomsk"> <img src="../Line-up/icons/vk.svg" alt=""></li></a>
      <li><a href="https://t.me/s/omskiyavangard"> <img src="../Line-up/icons/tg.svg" alt=""></a></li>
      <li><a href="https://www.youtube.com/@HCAvangardTV"> <img src="../Line-up/icons/youtube.svg" alt=""></a></li>
      <li><a href="https://www.instagram.com/avangard_inside/?hl=ru"> <img src="../Line-up/icons/insta.svg"
            alt=""></a></li>
      <li><a
          href="https://apps.apple.com/us/app/%D1%85%D0%BA-%D0%B0%D0%B2%D0%B0%D0%BD%D0%B3%D0%B0%D1%80%D0%B4/id1426468334?l=ru&ls=1&utm_source=hawk&utm_medium=footer&utm_campaign=app">
          <img src="../Line-up/icons/app-store.svg (1).svg" alt=""></a></li>
      <li><a href="https://appgallery.huawei.com/app/C109037935?utm_source=hawk&utm_medium=footer&utm_campaign=app">
          <img src="../Line-up/icons/app-huawei.svg.svg" alt=""></a></li>
      <li><a
          href="https://play.google.com/store/apps/details?id=ru.hawk.app&utm_source=hawk&utm_medium=footer&utm_campaign=app">
          <img src="../Line-up/icons/google.svg" alt=""></a></li>
    </div>
  </div>
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
<?php
require_once '../vendor/components/header.php';
require_once '../vendor/components/core.php';
$sql = "SELECT * FROM `products`";
$result = $link->query($sql);


?>



<div class="conta">

      <ul class="giper">
       
        <div class="busket">
          <button class="cart" id="cart">
            <img class="cart__image" src="./image 16.png" alt="Cart" srcset="" />
            <P> <i> КОРЗИНА </i> </P>
            <div class="cart__num" id="cart_num"></div>
          </button>
          <div class="popup">
            <div class="popup__container" id="popup_container">
              <div class="popup__item">
                <h1 class="popup__title">Оформление заказа</h1>
              </div>
              <div class="popup__item" id="popup_product_list">
                <div class="popup__product">
                  <div class="popup__product-wrap">
                    <img src="" alt="" class="popup__product-image" />
                    <h2 class="popup__product-title">

                    </h2>
                  </div>
                  <div class="popup__product-wrap">
                    <div class="popup__product-price"></div>
                    <button class="popup__product-delete">&#10006;</button>
                  </div>
                </div>
              </div>
              <div class="popup__item">
                <div class="popup__cost">
                  <h2 class="popup__cost-title">Итого</h2>
                  <output class="popup__cost-value" id="popup_cost"></output>
                </div>
              </div>
            </div>
            <button class="popup__close" id="popup_close">&#10006;</button>
          </div>
          
        </div>
      </ul>

  <div class="preview">
    <img src="preview.png" alt="">
  </div>
  <div class="block">

  </div>
  <div class="inner">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    ?>
        <div class="card">
          <img src="../../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <div class="title-card"><?php echo htmlspecialchars($row['name']); ?></div>
          <div class="price-card">Цена: <?php echo htmlspecialchars($row['price']); ?> руб.</div>
          <button class="buy-card">Добавить в корзину</button>
        </div>
    <?php
      }
    } else {
      echo "Товары не найдены.";
    }
    ?>
  </div>
</div>
<div class="container">
  <div class="back">
    <a href="../News/news.html">
      <button id="backup">ПОСМОТРЕТЬ ЕЩЕ</button>
    </a>
  </div>
  <div class="vk">
    <img src="../Line-up/icons/vk.svg" alt="">
  </div>
  <h1>Покажи себя в "Авангарде"!</h1>

  <div class="photki2">
    <div class="photki">
      <div class="ph"><img src="image 12.png" alt=""></div>
      <div class="ph"><img src="image 21.png" alt=""></div>
      <div class="ph"><img src="Link  954adc508bc1f0fde8c897d17ea2f7bd.jpg.png" alt=""></div>
      <div class="ph"><img src="Link  fa791a5344628a5e31233a3066cc1b49.jpg.png" alt=""></div>
      <div class="ph"><img src="Link 3dfd47ce1cce4c7bd4dd9a637f8d25af.jpg.png" alt=""></div>
      <div class="ph"><img src="Link 6cc82a04dc74b2d11a5908bfbc59ec68.jpg.png" alt=""></div>
    </div>
  </div>

  <div class="back">
    <a href="../Новости/news.html">
      <button id="backup">ПОСМОТРЕТЬ ВСЕ ФОТО</button>
    </a>
  </div>
</div>


<div class="preview2">
  <img src="image 11.svg" alt="">
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
</body>

</html>
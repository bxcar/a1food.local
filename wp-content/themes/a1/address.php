<?php
/* Template Name: address-mobile */
require_once 'header_mobile.php';
if(!is_user_logged_in()) {
    $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <script>
        window.location.href="/login-mobile?redirect=<?= $current_link; ?>";
    </script>
<?php } ?>
    <script>
        $('.header-in-common').remove();
    </script>
<style>
    .header-in-common {
        display: none;
    }

    .main.container {
        padding-bottom: 30px;
    }

    .container {
        width: 100%;
    }
</style>
    <header class="header-in" style="margin-bottom: 7px; margin-left: 0">
        <div class="header-in__inner-wrapper">
            <a href="/m" class="header-in__back"><img src="<?= get_template_directory_uri(); ?>/img/header-in-back.svg"></a>
            <span class="header-in__title">Добавить адрес</span>
        </div>
    </header>
    <span class="address__title">Мы возим еду только в пределах<br>зоны доставки, чтобы она была<br> максимально свежей</span>

    <div class="address__form-wrapper">
        <!--<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A811e43364244823ad05b88ab5a68bccea0563d12872bbb2b14edf88640a228fb&amp;source=constructor" width="100%" height="288" frameborder="0"></iframe>-->
        <div id="map" class="animated-background" style="width: 100%; height: 288px; pointer-events:none;"></div>

        <form action="#" method="post" class="address__form">
            <span class="address__form-delivery-city animated-background">Доставка товаров осуществляется<br>только по г.Омск</span>
            <div class="address__form-inner-wrapper">
                <input type="text" name="street" placeholder="Улица" required class="animated-background">
            </div>
            <div class="address__form-inner-wrapper">
                <input type="text" name="house" placeholder="Дом" required class="animated-background">
                <input type="text" name="entrance" placeholder="Подъезд" class="animated-background">
            </div>
            <div class="address__form-inner-wrapper">
                <input type="text" name="floor" placeholder="Этаж" class="animated-background">
                <input type="text" name="apartment" placeholder="Квартира / офис" class="animated-background">
            </div>
            <div class="address__form-inner-wrapper">
                <textarea name="comment" placeholder="Комментарий к доставке" class="animated-background"></textarea>
            </div>
            <button type="submit" class="animated-background">Добавить адрес</button>
        </form>
    </div>

</div>

<?php
include 'js/address-js.php';
require_once 'footer_mobile.php';

<?php
/* Template Name: address-desk */
get_header();

if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php }

?>

<style>
    .ymaps-2-1-78-balloon-panel {
        display: none !important;
    }
</style>

<div class="address__form-wrapper">
    <!--<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A811e43364244823ad05b88ab5a68bccea0563d12872bbb2b14edf88640a228fb&amp;source=constructor" width="100%" height="288" frameborder="0"></iframe>-->
    <div id="map" class="animated-background" style="width: 100%; height: 288px; pointer-events:none;"></div>

    <form action="#" method="post" class="address__form">
        <span class="address__form-delivery-city animated-background">Доставка товаров осуществляется только по г.Омск</span>
        <div class="address__form-inner-wrapper">
            <input type="text" name="street" placeholder="Улица" required class="animated-background">
        </div>
        <div class="address__form-inner-wrapper">
            <input type="text" name="house" placeholder="Дом" required class="animated-background">
            <input type="text" name="entrance" placeholder="Подъезд" class="animated-background">
            <input type="text" name="floor" placeholder="Этаж" class="animated-background">
            <input type="text" name="apartment" placeholder="Квартира / офис" class="animated-background">
        </div>
        <div class="address__form-inner-wrapper">
            <textarea maxlength="99" name="comment" placeholder="Комментарий к доставке" class="animated-background"></textarea>
        </div>
        <button type="submit" class="animated-background">Добавить адрес</button>
    </form>
</div>

</div>

<?php
include 'js/address-js.php';
get_footer() ?>

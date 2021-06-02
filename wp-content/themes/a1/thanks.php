<?php
/* Template Name: thanks-mobile */
require_once 'header_mobile.php';
if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login-mobile";
    </script>
<?php } ?>
<style>
    .header-in-common {
        display: none;
    }
</style>
    <header class="header-in">
        <div class="header-in__inner-wrapper">
            <a href="/m" class="header-in__back"><img src="<?= get_template_directory_uri(); ?>/img/header-in-back.svg"></a>
            <span class="header-in__title">Оплата</span>
        </div>
        <img class="header-in__logo" style="max-width: 79px;" src="<?= get_field('logo_field', 'option') ?>">
    </header>


    <div class="cart-button-wrapper">
        <a href="/orders-mobile" class="cart-button cart-button-2" style="text-decoration: none;">
            <div class="cart-button-left">
                <span>Отследить заказ</span>
            </div>
        </a>
    </div>
</div>
<div class="payment3">
    <img style="max-width: 93px;" src="<?= get_field('logo_field', 'option') ?>" class="payment3__logo">
    <h1 class="payment3__title">Спасибо, что выбрали нас!</h1>
    <span class="payment3__text1">Ваш заказ принят.</span>
    <span class="payment3__text2">Статус заказа Вы можете<br>отслеживать в личном кабинете</span>
</div>

    <script>
        window.history.replaceState(null, null, window.location.pathname);
    </script>
<?php
require_once 'footer_mobile.php';

<?php
/* Template Name: thanks-desk */
get_header();

if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php }

?>

    <div class="tanks-container">
        <span class="tanks__title">Спасибо!</span>
        <span class="tanks__subtitle">Ваш заказ уже в пути</span>
        <a href="/orders" class="thanks-button">Отследить заказ</a>
    </div>



</div>

<?php get_footer() ?>

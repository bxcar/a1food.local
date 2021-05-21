<?php
/* Template Name: thanks-desk */
get_header();

if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php die(); } ?>

<?php
include 'custom_files_dm/thanks_inc.php';
?>

<script>
    if(window.mobileAndTabletCheck()) {
        window.location.href = "/thanks-mobile";
    }
</script>

    <div class="tanks-container">
        <span class="tanks__title animated-background">Спасибо, что выбрали нас!</span>
        <span class="tanks__subtitle animated-background" style="margin-bottom: 15px;">Ваш заказ принят.</span>
        <span class="tanks__subtitle animated-background">Статус заказа Вы можете<br>отслеживать в личном кабинете.</span>
        <a href="/orders" class="thanks-button animated-background">Отследить заказ</a>
    </div>

<script>
    window.history.replaceState(null, null, window.location.pathname);
</script>



</div>

<?php get_footer() ?>

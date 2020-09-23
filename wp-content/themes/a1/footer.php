<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a1
 */

?>

<div class="footer">
    <div class="footer__container">
        <div class="footer__wrapper1">
            <img src="<?= get_template_directory_uri(); ?>/img/logo.svg">
            <span>(с) Все права защищены</span>
            <span>Построено в MOS-DIGITAL</span>
        </div>
        <div class="footer__wrapper2">
            <a href="#"><?php include "img/feedback.svg" ?> обратная связь</a>
            <a href="#"><?php include "img/agreement.svg" ?> пользовательское соглашение</a>
        </div>
    </div>
</div>
<!--footer scripts start-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/common.js"></script>
<script>
    $("#phone").mask("(999) 999-99-99");
    $("#phone-cabinet").mask("+7 (999) 999-99-99");
    $("#birth-date").mask("99.99.9999");
</script>
<!--footer scripts end-->
<?php wp_footer(); ?>
</body>
</html>

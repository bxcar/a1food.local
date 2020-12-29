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

<div class="overlay"></div>
<div class="footer animated-background">
    <div class="footer__container">
        <div class="footer__wrapper1">
            <img src="<?= get_template_directory_uri(); ?>/img/logo.svg">
            <span>(с) Все права защищены</span>
            <span>Построено в MOS-DIGITAL</span>
        </div>
        <div class="footer__wrapper2">
            <a class="contact-popup-button" href="#"><?php include "img/feedback.svg" ?> обратная связь</a>
            <a href="#"><?php include "img/agreement.svg" ?> пользовательское соглашение</a>
        </div>
    </div>
</div>
<!--footer scripts start-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/common.js"></script>
<script>
    $.fn.selectRange = function (start, end) {
        if (end === undefined) {
            end = start;
        }
        return this.each(function () {
            if ('selectionStart' in this) {
                this.selectionStart = start;
                this.selectionEnd = end;
            } else if (this.setSelectionRange) {
                this.setSelectionRange(start, end);
            } else if (this.createTextRange) {
                var range = this.createTextRange();
                range.collapse(true);
                range.moveEnd('character', end);
                range.moveStart('character', start);
                range.select();
            }
        });
    };

    function hasNumber(myString) {
        return /\d/.test(myString);
    }

    $("#phone").mask("(999) 999-99-99").on('click', function () {
        if (!hasNumber($(this).val())) {
            $(this).selectRange(1);
        }
    });
    // .mask('999-999-9999', { autoclear: false, 'placeholder': '' });
    $("#phone-cabinet").mask("+7 (999) 999-99-99");
    $("#birth-date").mask("99.99.9999");

    $('#slider').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: <?= get_field('slider_interval', 'options') ?>,
        autoplayHoverPause: true,
        items: 1
    });
</script>
<!--footer scripts end-->
<?php
include "custom_files_dm/calculate_total_price_with_delivery.php";
?>
<script>
    var cart_formatted_value = '<?= number_format(((int)$cart_total_price + (int)$delivery), 0, '.', ' ') ?>';
    var cart_formatted_value_without_delivery = '<?= number_format(((int)$cart_total_price), 0, '.', ' ') ?>';
    $('.header__cart-button span').text(cart_formatted_value_without_delivery + ' ₽');
    $('.checkout-cards-right-price span:last-child').text(cart_formatted_value + ' ₽');
</script>
<script>
    $('.product-item-price-wrapper').on('click', function (e) {
        e.preventDefault();
        var data_id = $(this).data('id');
        /*$('.hiddenDiv').load($(this).attr('href')).html('');
        console.log('hello');*/

        var $this = $(this);

        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/add_to_cart.php',
            dataType: 'json',
            data:
                {
                    'product_id': $(this).attr('data-id')
                },
            success: function (data) {//success callback
                // console.log('success');
                $this.find('.product-item-amount').css('display', 'flex');
                var items_amount = $this.find('.product-item-amount').text();
                if (!items_amount) {
                    items_amount = 0;
                }
                $this.find('.product-item-amount').text(parseInt(items_amount) + 1);
                //$('.header__cart-button span').text((data.cart_total + <?//= (int)$delivery_current_time_price ?>//) + ' ₽');
                $('.header__cart-button span').text((data.cart_total) + ' ₽');
                $('.cart-button-desktop-right span').text((data.cart_total + <?= (int)$delivery_current_time_price ?>) + ' ₽');
                if (<?= get_the_ID(); ?> == 73
            )
                {
                    if ($('.cart-products__item[data-id="' + data_id + '"]').length) {
                        $('.cart-products__item[data-id="' + data_id + '"]').find('.more').trigger("click");
                    } else {
                        location.reload();
                    }

                }

            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $(".payment2__owl-carousel-cards").owlCarousel({
        items: 1,
    });
</script>
<?php print_r(WC()->cart->total); ?>
<?php wp_footer(); ?>
<?php
if (get_field('page_popup')['logic'] && !isset($_SESSION["page_popup_" . get_the_ID()])) {
    $_SESSION["page_popup_" . get_the_ID()] = 1; ?>
    <a class="slider__item sl-popup page-popup">
        <div class="slider__item-left">
            <span class="slider__title"><?= get_field('page_popup')['message'] ?></span>
            <span class="slider__text"><?= get_field('page_popup')['desc'] ?></span>
        </div>
        <div class="slider__item-right">
            <img src="<?= get_field('page_popup')['img'] ?>" class="slider__img">
        </div>
        <img class="sl-popup__close" src="<?= get_template_directory_uri(); ?>/img/close-popup.svg" alt="close">
    </a>
    <div class="overlay-sl-popup page-popup"></div>
<?php }
?>
<?php
date_default_timezone_set('Asia/Omsk');
$day_footer = date('w', strtotime(date('m/d/Y', time())));
$hour_footer = date('G', time());
$delivery_current_time_price_footer = get_field('delivery_price_by_hours', 'option')['body'][$day_footer][$hour_footer]['c'];

if (get_field('popup_non_working_hours', 'option')['logic'] && !isset($_SESSION["popup_non_working_hours"]) && !$delivery_current_time_price_footer) {
    $_SESSION["popup_non_working_hours"] = 1; ?>
    <a class="slider__item sl-popup hours-popup">
        <div class="slider__item-left">
            <span class="slider__title"><?= get_field('popup_non_working_hours', 'option')['message'] ?></span>
            <span class="slider__text"><?= get_field('popup_non_working_hours', 'option')['desc'] ?></span>
        </div>
        <div class="slider__item-right">
            <img src="<?= get_field('popup_non_working_hours', 'option')['img'] ?>" class="slider__img">
        </div>
        <img class="sl-popup__close" src="<?= get_template_directory_uri(); ?>/img/close-popup.svg" alt="close">
    </a>
    <div class="overlay-sl-popup hours-popup"></div>
<?php }
?>

<form class="contact-popup">
    <span class="contact-popup__title">Связаться<br>с нами</span>
    <?php if (is_user_logged_in()) {
        if (get_field('user_name_field', 'user_' . get_current_user_id())) { ?>
            <div class="contact-popup__item1">
                <span class="contact-popup__item1-title"><img src="<?= get_template_directory_uri(); ?>/img/contact-user-icon.png">Привет, <?= get_field('user_name_field', 'user_' . get_current_user_id()) ?></span>
                <span class="contact-popup__item1-phone"><?= get_field('user_phone_field', 'user_' . get_current_user_id()) ?></span>
            </div>
        <?php }
    } ?>
    <div class="contact-popup__item2-wrapper">
        <div class="contact-popup__item2">
            <div class="contact-popup__item2-left">
                <span class="contact-popup__item2-title"><img
                            src="<?= get_template_directory_uri(); ?>/img/contact-msg-icon.png"><span><?= get_field('contact_sections', 'option')[0]['section'] ?></span></span>
            </div>
            <div class="contact-popup__item2-right">
                <img src="<?= get_template_directory_uri(); ?>/img/contact-dropdown-icon.png">
            </div>
        </div>
        <div class="contact-popup__item2-subfields">
            <?php if (get_field('contact_sections', 'option')) {
                foreach (get_field('contact_sections', 'option') as $item) { ?>
                    <span class="contact-popup__item2-subfield"
                          data-email="<?= $item['email'] ?>"><?= $item['section'] ?></span>
                <?php }
            } ?>
        </div>
    </div>
    <div class="contact-popup__feedback">
        <img src="<?= get_template_directory_uri(); ?>/img/contact-msg-icon.png"
             class="contact-popup__feedback-abs-img">
        <textarea name="feedback" placeholder="Ваше сообщение"></textarea>
        <div class="contact-popup__feedback-bottom">
            <span class="contact-popup__feedback-bottom-file-name"></span>
            <img src="<?= get_template_directory_uri(); ?>/img/contact-empty-img-icon.png" alt="#">
            <span class="contact-popup__feedback-file"><img
                        src="<?= get_template_directory_uri(); ?>/img/contact-file-icon.png"
                        alt="#">Прикрепить файл</span>
        </div>
    </div>
    <input name="email" type="hidden" value="<?= get_field('contact_sections', 'option')[0]['email'] ?>">
    <input type="file" name="file" style="display: none;">
    <button type="submit">Отправить</button>
    <img src="<?= get_template_directory_uri(); ?>/img/order-close.svg" class="contact-popup-close">
</form>
</body>
</html>

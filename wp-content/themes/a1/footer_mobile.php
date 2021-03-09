<div class="overlay"></div>
<div class="burger-menu">
    <div class="burger-menu__header">
        <img src="<?= get_template_directory_uri(); ?>/img/burger-close.svg" class="burger-menu__close">
        <a href="/"><img src="<?= get_template_directory_uri(); ?>/img/burger-logo.svg" class="burder-menu__logo"></a>
    </div>
    <div class="burger-menu__content">
        <?php if(is_user_logged_in()) { ?>
            <a href="/cabinet-mobile" class="burger-menu__content-item burger-menu__content-item-first">
                    <span><img src="<?= get_template_directory_uri(); ?>/img/user-burger-menu-icon.svg">Привет, <?php if(get_field('user_name_field', 'user_' . get_current_user_id())){
                            echo get_field('user_name_field', 'user_' . get_current_user_id());
                        } else {
                            echo 'посетитель';
                        } ?></span>
                <span class="burger-menu__content-item-phone"><?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?></span>
            </a>
        <?php } ?>
        <a href="#" class="burger-menu__content-item">
            <span><img src="<?= get_template_directory_uri(); ?>/img/location-icon.svg">г. Омск</span>
        </a>
        <a href="/offer-mobile" class="burger-menu__content-item">
            <span><img src="<?= get_template_directory_uri(); ?>/img/user-agreement-icon.svg">Пользовательское соглашение</span>
        </a>
    </div>
    <div class="burger-menu__button-wrapper">
        <a href="https://mos-digital.com/" target="_blank" class="burger-menu_mos"><?php include "img/crown-mob.svg" ?><span>Построено в MOS-DIGITAL</span></a>
        <a href="#" class="burger-menu__button contact-popup-button">Обратная связь</a>
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
    <?php if(get_the_ID() != '357') { ?>
    $('.cart-button-right span').text(cart_formatted_value_without_delivery + ' ₽');
    <?php } ?>
    $('.checkout-cards-right-price span:last-child').text(cart_formatted_value + ' ₽');
</script>
<script>
    $('.product-item-price-wrapper').on('click', function (e) {
        e.preventDefault();
        var data_id = $(this).data('id');

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
                $('.cart-button-right span').text((data.cart_total) + ' ₽');
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
<!--footer scripts end-->
<?php wp_footer(); ?>
<form class="contact-popup" enctype="multipart/form-data" action="#">
    <span class="contact-popup__title">Связаться<br>с нами</span>
    <span class="tanks__subtitle" style="display: none;">Ваше сообщение отправлено</span>
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
                            src="<?= get_template_directory_uri(); ?>/img/contact-msg-icon.png"><span>Тема обращения</span></span>
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
        <textarea required name="feedback" placeholder="Ваше сообщение"></textarea>
        <div class="contact-popup__feedback-bottom">
            <span class="contact-popup__feedback-bottom-file-name"></span>
            <img src="<?= get_template_directory_uri(); ?>/img/contact-empty-img-icon.png" alt="#">
            <span class="contact-popup__feedback-file"><img
                        src="<?= get_template_directory_uri(); ?>/img/contact-file-icon.png"
                        alt="#">Прикрепить файл</span>
        </div>
    </div>
    <input type="file" name="file" style="display: none;">

    <input type="hidden" name="email" value="">
    <input type="hidden" name="user_section" value="">
    <input type="hidden" name="user_name" value="<?= get_field('user_name_field', 'user_' . get_current_user_id()); ?>">
    <input type="hidden" name="user_phone" value="<?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?>">

    <button type="submit">Отправить</button>
    <img src="<?= get_template_directory_uri(); ?>/img/order-close.svg" class="contact-popup-close">
</form>
</body>
</html>

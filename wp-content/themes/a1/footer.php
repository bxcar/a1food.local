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
<script src="<?= get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/common.js"></script>
<script>
    $("#phone").mask("(999) 999-99-99");
    $("#phone-cabinet").mask("+7 (999) 999-99-99");
    $("#birth-date").mask("99.99.9999");
</script>
<!--footer scripts end-->
<?php
$cart_total_price =  WC()->cart->cart_contents_total;

date_default_timezone_set('Asia/Omsk');
$day = date('w', strtotime(date('m/d/Y', time())));
$hour = date('G', time());

if($day == 1) {
    $day = 0;
} else if($day == 2) {
    $day = 1;
} else if($day == 3) {
    $day = 2;
} else if($day == 4) {
    $day = 3;
} else if($day == 5) {
    $day = 4;
} else if($day == 6) {
    $day = 5;
} else if($day == 0) {
    $day = 6;
}

if($hour < 12) {
    $hour = 12;
}

$delivery_current_time_price = get_field('delivery_price_by_hours', 'option')['body'][$day][$hour]['c'];

$delivery = 0;
if(($cart_total_price < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
    $delivery = (int)$delivery_current_time_price;
}

if($cart_total_price == 0) {
    $delivery = 0;
}
?>
<script>
    var cart_formatted_value = '<?= number_format(((int)$cart_total_price + (int)$delivery), 0, '.', ' ') ?>';
    $('.header__cart-button span').text(cart_formatted_value + ' ₽');
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
                if(!items_amount) {
                    items_amount = 0;
                }
                $this.find('.product-item-amount').text(parseInt(items_amount) + 1);
                $('.header__cart-button span').text((data.cart_total + <?= (int)$delivery_current_time_price ?>) + ' ₽');
                $('.cart-button-desktop-right span').text((data.cart_total + <?= (int)$delivery_current_time_price ?>) + ' ₽');
                if(<?= get_the_ID(); ?> == 73) {
                    if($('.cart-products__item[data-id="' + data_id + '"]').length) {
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
<?php wp_footer(); ?>
</body>
</html>

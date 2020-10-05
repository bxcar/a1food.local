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

$delivery = 0;
if($cart_total_price < get_field('free_delivery_min_price', 'option')) {
    $delivery = (int)get_field('delivery_price', 'option');
}
?>
<script>
    $('.header__cart-button span').text('<?= (int)$cart_total_price + (int)$delivery ?> ₽');
</script>
<script>
    $('.product-item-price-wrapper').on('click', function (e) {
        e.preventDefault();
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
                $('.header__cart-button span').text(data.cart_total + ' ₽');
                $('.cart-button-desktop-right span').text(data.cart_total + ' ₽');
            },
            error: function (data) {
                console.log(data);
            }
        });
    })

    $(".payment2__owl-carousel-cards").owlCarousel({
        items: 1,
    });
</script>
<?php wp_footer(); ?>
</body>
</html>

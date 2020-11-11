<?php
/* Template Name: thanks-desk */
get_header();

if(isset($_GET['order_id'])) {
    WC()->cart->empty_cart();
    $order_id = $_GET['order_id'];

    $current_number_of_orders =  get_field('number_of_orders', 'user_' . get_current_user_id());
    $new_number_of_orders = $current_number_of_orders + 1;
    if($new_number_of_orders <= 9) {
        $new_number_of_orders = '0' . $new_number_of_orders;
    }
    update_field('number_of_orders', $new_number_of_orders, 'user_' . get_current_user_id());
    update_field('order_number_for_current_customer', $new_number_of_orders, $order_id);
}

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

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
<?php } ?>

<?php
/*$order_id = 233;
$order = wc_get_order( $order_id );
$order_data = $order->get_data();
$user_id = $order->get_user_id();

$user_name = get_field('user_name_field', 'user_' . $user_id);
$user_email = get_field('user_email_field', 'user_' . $user_id);
$user_phone = get_field('user_phone_field', 'user_' . $user_id);
$order_address = $order_data['billing']['address_1'];
$order_date = get_post_meta( $order_id, '_billing_date', true);
$order_time = get_post_meta( $order_id, '_billing_time', true);

foreach ($order->get_items() as $item_key => $item ):
    $item_data    = $item->get_data();
    $product_name = $item_data['name'];
    $quantity     = $item_data['quantity'];
endforeach;*/

?>

    <div class="tanks-container">
        <span class="tanks__title">Спасибо!</span>
        <span class="tanks__subtitle">Ваш заказ уже в пути</span>
        <a href="/orders" class="thanks-button">Отследить заказ</a>
    </div>



</div>

<?php get_footer() ?>

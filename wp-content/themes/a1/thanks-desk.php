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
$order_id = 236;
$order = wc_get_order( $order_id );
$order_data = $order->get_data();
$user_id = $order->get_user_id();

$user_name = get_field('user_name_field', 'user_' . $user_id);
$user_email = get_field('user_email_field', 'user_' . $user_id);
$user_phone = get_field('user_phone_field', 'user_' . $user_id);
$order_street = '';
$order_home = '';
$order_pod = '';
$order_et = '';
$order_apart = '';
$order_date = get_post_meta( $order_id, '_billing_date', true);
$order_time = get_post_meta( $order_id, '_billing_time', true);
$order_date_and_time = $order_date . ' ' . $order_time;
//$order_address = $order_data['billing']['address_1'];

$products_array = array();
$products_quantity_array = array();
foreach ($order->get_items() as $item_key => $item ):
    $item_data    = $item->get_data();
    $products_array[] = $item->get_product_id();
//    $product_name = $item_data['name'];
    $products_quantity_array[] = $item_data['quantity'];
endforeach;

print_r($order_date_and_time);

/*$url = 'https://app.frontpad.ru/api/index.php?new_order';
$data = array(
    'secret' => 'EBrSYtTE4nT9aih9y6KQyRG7Q96AZkanQr6zKQ4B4HB5TH5dEDS2fnYYkQh94hnEBh49ZSBQr4G8BAa54TS88BShd3f69zAAFnAr635iSBff2haR5SN3ft9ihfefEEG8T7nQZf2EG6KydK97sNZA6YKb4SiyhTs5RFFBNs5fiEDrbBkya8Y7Tt9K9i6h5iaHSG8s24B9t5nztBSyABrfYrTYBN6t274FD32nRkk9eDzA4bTrE9Akne8QT4',
    'product' => $products_array,
    'product_kol' => $products_quantity_array,
);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);*/

?>

    <div class="tanks-container">
        <span class="tanks__title">Спасибо!</span>
        <span class="tanks__subtitle">Ваш заказ уже в пути</span>
        <a href="/orders" class="thanks-button">Отследить заказ</a>
    </div>



</div>

<?php get_footer() ?>

<?php
/* Template Name: thanks-desk */
get_header();

if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php }

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

    $order = wc_get_order( $order_id );
    //update status to initial
    $order->update_status('pending');

    $order_data = $order->get_data();
    $user_id = $order->get_user_id();

    $user_name = get_field('user_name_field', 'user_' . $user_id);
    $user_email = get_field('user_email_field', 'user_' . $user_id);
    $user_phone = get_field('user_phone_field', 'user_' . $user_id);
    $order_street = get_post_meta( $order_id, '_billing_street', true);
    $order_home = get_post_meta( $order_id, '_billing_home', true);
    $order_pod = get_post_meta( $order_id, '_billing_pod', true);
    $order_et = get_post_meta( $order_id, '_billing_et', true);
    $order_apart = get_post_meta( $order_id, '_billing_apart',  true);
    $order_date = get_post_meta( $order_id, '_billing_date', true);
    $order_time = get_post_meta( $order_id, '_billing_time', true);
    $order_date_and_time = $order_date . ' ' . $order_time;
    $promo_code = '';

    foreach( $order->get_coupon_codes() as $coupon_code ) {
        $coupon = new WC_Coupon($coupon_code);
        $promo_code = $coupon->get_code();
    }

    $products_array = array();
    $products_quantity_array = array();
    $products_prices_array = array();
    foreach ($order->get_items() as $item_key => $item ):
        $item_data = $item->get_data();
        $product = $item->get_product();
        $products_array[] = $item->get_product_id();
        $products_quantity_array[] = $item_data['quantity'];
        $products_prices_array[] = $product->get_price();
    endforeach;

    $products_array[] = 7777;
    $products_quantity_array[] = 1;
    $products_prices_array[] = $order_data['shipping_total'];

    $order_statuses_array = array(1,4,10,11);

    $data = array(
        'secret' => 'EBrSYtTE4nT9aih9y6KQyRG7Q96AZkanQr6zKQ4B4HB5TH5dEDS2fnYYkQh94hnEBh49ZSBQr4G8BAa54TS88BShd3f69zAAFnAr635iSBff2haR5SN3ft9ihfefEEG8T7nQZf2EG6KydK97sNZA6YKb4SiyhTs5RFFBNs5fiEDrbBkya8Y7Tt9K9i6h5iaHSG8s24B9t5nztBSyABrfYrTYBN6t274FD32nRkk9eDzA4bTrE9Akne8QT4',
        'product' => $products_array,
        'product_kol' => $products_quantity_array,
        'product_price' => $products_prices_array,
        'hook_status' => $order_statuses_array,
    );

    if($user_name) {
        $data['name'] = $user_name;
    }

    if($user_email) {
        $data['mail'] = $user_email;
    }

    if($user_phone) {
        $data['phone'] = $user_phone;
    }

    if($order_street) {
        $data['street'] = $order_street;
    }

    if($order_home) {
        $data['home'] = $order_home;
    }

    if($order_pod) {
        $data['pod'] = $order_pod ;
    }

    if($order_et) {
        $data['et'] = $order_et;
    }

    if($order_apart) {
        $data['apart'] = $order_apart;
    }

    if($order_date_and_time) {
        $data['datetime'] = $order_date_and_time;
    }

    $data['pay'] = 2;

    if($promo_code) {
        $data['certificate'] = $promo_code;
    }


    $url = 'https://app.frontpad.ru/api/index.php?new_order';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response);

//    print_r($response);

    update_field('order_id_frontpad', $response->order_id, $order_id);
}

?>

    <div class="tanks-container">
        <span class="tanks__title animated-background">Спасибо!</span>
        <span class="tanks__subtitle animated-background">Ваш заказ уже в пути</span>
        <a href="/orders" class="thanks-button animated-background">Отследить заказ</a>
    </div>

<script>
    window.history.replaceState(null, null, window.location.pathname);
</script>



</div>

<?php get_footer() ?>

<?php
require_once("../../../../wp-load.php");


date_default_timezone_set('Asia/Omsk');
$day = date('w', strtotime(date('m/d/Y', time())));
$hour = date('G', time());

$day = getDayNumberForTable($day);

if($hour < 12) {
    $hour = 12;
}

$delivery_current_time_price = get_field('delivery_price_by_hours', 'option')['body'][$day][$hour]['c'];
$delivery_current_time_price = getDeliveryPriceNonWorkingHours($delivery_current_time_price, $day);

$coupon_code = $_POST['coupon'];

$coupon = new WC_Coupon( $coupon_code );
if($coupon->is_valid()) {
    $coupon = 'valid';
    WC()->cart->add_discount( sanitize_text_field( $coupon_code ));
    $cart_total = (int)WC()->cart->cart_contents_total;
    $cart_total_without_delivery = $cart_total;
    $delivery = 0;
    if(($cart_total < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
        $delivery = (int)$delivery_current_time_price;
    }
    $cart_total = (int)WC()->cart->cart_contents_total + $delivery;
} else {
    $coupon = 'invalid';
    $cart_total = (int)WC()->cart->cart_contents_total;
    $cart_total_without_delivery = $cart_total;
    $delivery = 0;
    if(($cart_total < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
        $delivery = (int)$delivery_current_time_price;
    }
    $cart_total = (int)WC()->cart->cart_contents_total + $delivery;
}


echo json_encode(
    [
        'coupon' =>  $coupon,
        'cart_total' =>  $cart_total,
        'cart_total_without_delivery' =>  $cart_total_without_delivery,
    ]
);


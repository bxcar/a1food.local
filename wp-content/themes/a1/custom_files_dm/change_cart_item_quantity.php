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

global $woocommerce;
$cart_item_key = $_POST['cart_item_key'];
$quantity = $_POST['quantity'];
$woocommerce->cart->set_quantity($cart_item_key, $quantity);
$cart_total = (int)WC()->cart->cart_contents_total;
$cart_total_without_delivery = $cart_total;
$delivery = 0;
if(($cart_total < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
    $delivery = (int)$delivery_current_time_price;
}

$cart_total = $cart_total + $delivery;
//$cart_total = number_format($cart_total, 0, '.', ' ');

echo json_encode(
    [
        'success' => 'true',
        'cart_total' => $cart_total,
        'cart_total_without_delivery' => $cart_total_without_delivery
    ]
);

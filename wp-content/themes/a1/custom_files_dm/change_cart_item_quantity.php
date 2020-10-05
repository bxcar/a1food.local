<?php
require_once("../../../../wp-load.php");

global $woocommerce;
$cart_item_key = $_POST['cart_item_key'];
$quantity = $_POST['quantity'];
$woocommerce->cart->set_quantity($cart_item_key, $quantity);
$cart_total = (int)WC()->cart->cart_contents_total;
$cart_total_without_delivery = $cart_total;
$delivery = 0;
if($cart_total < get_field('free_delivery_min_price', 'option')) {
    $delivery = (int)get_field('delivery_price', 'option');
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

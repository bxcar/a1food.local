<?php
require_once("../../../../wp-load.php");


$coupon_code = $_POST['coupon'];

$coupon = new WC_Coupon( $coupon_code );
if($coupon->is_valid()) {
    $coupon = 'valid';
    WC()->cart->add_discount( sanitize_text_field( $coupon_code ));
    $cart_total = (int)WC()->cart->cart_contents_total;
    $cart_total_without_delivery = $cart_total;
    $delivery = 0;
    if($cart_total < get_field('free_delivery_min_price', 'option')) {
        $delivery = (int)get_field('delivery_price', 'option');
    }
    $cart_total = (int)WC()->cart->cart_contents_total + $delivery;
} else {
    $coupon = 'invalid';
}


echo json_encode(
    [
        'coupon' =>  $coupon,
        'cart_total' =>  $cart_total,
        'cart_total_without_delivery' =>  $cart_total_without_delivery,
    ]
);


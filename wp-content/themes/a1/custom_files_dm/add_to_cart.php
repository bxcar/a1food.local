<?php
require_once("../../../../wp-load.php");

$product_id = $_POST['product_id'];
WC()->cart->add_to_cart( $product_id );
$cart_total = (int)WC()->cart->cart_contents_total;

echo json_encode(
    [
        'cart_total' => $cart_total
    ]
);

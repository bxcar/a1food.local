<?php
require_once("../../../../wp-load.php");

$product_id = $_POST['product_id'];
WC()->cart->add_to_cart( $product_id );

echo json_encode(
    [
        'success' => 'true'
    ]
);

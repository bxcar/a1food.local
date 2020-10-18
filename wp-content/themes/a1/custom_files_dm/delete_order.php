<?php
require_once("../../../../wp-load.php");

$order_id = $_POST['order_id'];

wp_delete_post($order_id,true);

echo json_encode(
    [
        'data' => 'success'
    ]
);

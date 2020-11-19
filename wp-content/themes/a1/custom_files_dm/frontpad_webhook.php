<?php
require_once("../../../../wp-load.php");

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$order_id = $data->order_id;
$status = $data->status;

if($status == 1) {
    $status = 'processing';
} else if($status == 4) {
    $status = 'on-hold';
} else if($status == 10) {
    $status = 'completed';
} else {
    $status = 'cancelled';
}

// WP_Query arguments
$args = array (
    'post_type' => 'shop_order',
    'posts_per_page' => -1,
    'post_status' => 'any',
    'meta_query'             => array(
        array(
            'key'       => 'order_id_frontpad',
            'value'     => $order_id,
        ),
    ),
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $order = wc_get_order( get_the_ID() );
        $order->update_status($status);
    }
}

// Restore original Post Data
wp_reset_postdata();

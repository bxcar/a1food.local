<?php
require_once("../../../../wp-load.php");

// WP_Query arguments
$args = array (
    'post_type' => 'shop_order',
    'posts_per_page' => -1,
    'post_status' => 'any',
    'meta_key' => '_customer_user',
    'meta_value' => get_current_user_id(),
);

// The Query
$query = new WP_Query( $args );

$order_statuses = array();

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();

        $order_status = get_order_status_title(wc_get_order(get_the_ID())->get_status());

        $order_statuses[wc_get_order(get_the_ID())->get_id()] = $order_status;
    }
}

// Restore original Post Data
wp_reset_postdata();

echo json_encode(
    [
        'orders_statuses' =>  $order_statuses
    ]
);


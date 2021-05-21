<?php
$loop = new WP_Query(array(
        'post_type' => 'shop_order',
        'post_status' => array_keys(wc_get_order_statuses()),
        'posts_per_page' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => get_current_user_id(),
    ));

// The Wordpress post loop
if ($loop->have_posts()):
    while ($loop->have_posts()) : $loop->the_post();
        $order_id = $loop->post->ID;
        $order = wc_get_order($order_id);
        $order_data = $order->get_data();
        if(!get_field('order_number_for_current_customer', $order_data['id'])) {
            // echo 'order_id: ' . $order_id;
            wp_delete_post($order_id,true);

        }

    endwhile;

    wp_reset_postdata();

endif;
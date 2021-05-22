<?php
require_once("../../../../wp-load.php");

$search_query = $_POST['search_query'];

$posts_array = array();

$loop = new WP_Query( array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    's' => $search_query
));

$amount_of_posts = $loop->found_posts;

$i = 0;

if ($loop->have_posts()) {
    while ($loop->have_posts()) {
        $loop->the_post();

        $posts_array[$i]['id'] = get_the_ID();
        $posts_array[$i]['title'] = get_the_title();
        $posts_array[$i]['desc'] = get_the_content();
        $posts_array[$i]['img'] = get_the_post_thumbnail_url();

        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
        if (get_post_meta(get_the_ID(), '_sale_price', true)) {

            $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);
            $product_item_price_crossed_out = '<span class="product-item-price-crossed-out">'.get_post_meta(get_the_ID(), '_regular_price', true).' ₽</span>';

         } else {
            $sale_price = $regular_price;
            $product_item_price_crossed_out = '<span style="visibility: hidden; opacity: 0; height: 0;" class="product-item-price-crossed-out">'.get_post_meta(get_the_ID(), '_regular_price', true).' ₽</span>';
        }

        $posts_array[$i]['product_item_price_crossed_out'] = $product_item_price_crossed_out;
        $posts_array[$i]['sale_price'] = $sale_price;

        if (0 < woo_is_in_cart(get_the_ID())) {
            $product_item_amount = '<span class="product-item-amount">'.woo_is_in_cart(get_the_ID()).'</span>';
         } else {
            $product_item_amount = '<span class="product-item-amount" style="display: none;"></span>';
         }

        $posts_array[$i]['product_item_amount'] = $product_item_amount;

        if (get_field('popap')) {
            $posts_array[$i]['popap'] = get_field('popap');
        }

        $i++;
    }
}

echo json_encode(
    [
        'posts_array' => $posts_array,
        'amount_of_posts' => $amount_of_posts
    ]
);

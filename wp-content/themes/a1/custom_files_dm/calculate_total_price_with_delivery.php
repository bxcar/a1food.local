<?php
$cart_total_price =  WC()->cart->cart_contents_total;

date_default_timezone_set('Asia/Omsk');
$day = date('w', strtotime(date('m/d/Y', time())));
$hour = date('G', time());

$day = getDayNumberForTable($day);

if($hour < 12) {
    $hour = 12;
}

$delivery_current_time_price = get_field('delivery_price_by_hours', 'option')['body'][$day][$hour]['c'];
$delivery_current_time_price = getDeliveryPriceNonWorkingHours($delivery_current_time_price, $day);

$delivery = 0;
if(($cart_total_price < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
    $delivery = (int)$delivery_current_time_price;
}

if($cart_total_price == 0) {
    $delivery = 0;
}

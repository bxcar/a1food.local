<?php
/* Template Name: orders-desk */
get_header();
?>

    <div class="cabinet__title-wrapper">
        <h1 class="cabinet__title">Личный кабинет</h1>
    </div>

    <div class="cabinet__top-buttons">
        <a href="/cabinet" class="cabinet__top-buttons-profile inactive"><?php include "img/cabinet-profile-icon.svg"?>Профиль</a>
        <a href="/orders" class="cabinet__top-buttons-orders"><?php include "img/cabinet-cart-icon.svg"?>Заказы</a>
    </div>

<?php
$loop = new WP_Query( array(
    'post_type'         => 'shop_order',
    'post_status'       =>  array_keys( wc_get_order_statuses() ),
    'posts_per_page'    => -1,
) );

// The Wordpress post loop
if ( $loop->have_posts() ):
    while ( $loop->have_posts() ) : $loop->the_post();

// The order ID
        $order_id = $loop->post->ID;
        $order = wc_get_order( $order_id );
        $order_data = $order->get_data();

        $user_phone = get_field('user_phone_field', 'user_' . get_current_user_id());
        $user_phone = preg_replace('/[^0-9]/', '', $user_phone);
        $user_phone = substr($user_phone, 1);
        $order_number = $user_phone . '-' . $order_data['id'];
        $order_address = $order_data['billing']['address_1'];


        $date_number = $order_data['date_created']->date('j', time());
        $date_month =  get_month_title($order_data['date_created']->date('m', time()));
        $date_year = $order_data['date_created']->date('Y', time());
        $order_date = $date_number . ' ' . $date_month . ' ' . $date_year . ' г.';


        $order_status = get_order_status_title($order_data['status']);
        $order_total = (int)$order_data['total'];

        print_r($order_number . '<br>' . $order_address . '<br>' . $order_date . '<br>' . $order_status . '<br>' . $order_total);

    endwhile;

    wp_reset_postdata();

endif;
?>

    <div class="orders">
        <div class="orders__item order-success">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?= get_template_directory_uri(); ?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <div class="orders__item-bottom-line-inner-wrapper">
                    <span class="orders__item-date">25 мая 2020 г.</span>
                    <span class="orders__item-check"><img src="<?= get_template_directory_uri(); ?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                </div>
                <span class="orders__item-status green">Доставлен</span>
            </div>
            <div class="orders__item-rating">
                <span class="orders__item-rating-title">Оцените заказ</span>
                <div class="orders__item-rating-stars">
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                </div>
            </div>
            <form action="#" method="post" class="orders__item-feedback">
                <textarea name="feedback" placeholder="Вы можете оставить отзыв"></textarea>
                <img src="<?= get_template_directory_uri(); ?>/img/feedback-icon.svg" class="orders__item-feedback-icon">
                <div class="orders__item-feedback-file-wrapper">
                    <label class="orders__item-feedback-file-image" for="file"><img src="<?= get_template_directory_uri(); ?>/img/input-file-img.svg"></label>
                    <input type="file" name="file" id="file">
                </div>
            </form>
        </div>
        <div class="orders__item">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?= get_template_directory_uri(); ?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <div class="orders__item-bottom-line-inner-wrapper">
                    <span class="orders__item-date">25 мая 2020 г.</span>
                    <span class="orders__item-check"><img src="<?= get_template_directory_uri(); ?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                </div>
                <span class="orders__item-status yellow">Доставляется</span>
            </div>
        </div>
        <div class="orders__item">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?= get_template_directory_uri(); ?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <div class="orders__item-bottom-line-inner-wrapper">
                    <span class="orders__item-date">25 мая 2020 г.</span>
                    <span class="orders__item-check"><img src="<?= get_template_directory_uri(); ?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                </div>
                <span class="orders__item-status red">Отменен</span>
            </div>
        </div>
    </div>
</div>
<div class="orders__get-check-popup">
    <span class="orders__get-check-popup-title">Отправка<br>кассового чека</span>
    <form action="#" method="post" class="orders__get-check-popup-form">
        <div class="orders__get-check-popup-form-email-wrapper">
            <input type="email" name="email" id="email" placeholder="Укажите e-mail">
            <img src="<?= get_template_directory_uri(); ?>/img/email-popup-icon.svg" class="orders__get-check-popup-email-image">
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>
<div class="overlay"></div>

<?php get_footer() ?>

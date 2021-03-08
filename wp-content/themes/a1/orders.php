<?php
/* Template Name: orders-mobile */
require_once 'header_mobile.php';
if(!is_user_logged_in()) {
    $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <script>
        window.location.href="/login-mobile?redirect=<?= $current_link; ?>";
    </script>
<?php } ?>
<style>
    .header-in {
        max-width: none;
    }

    .main.container {
        padding-bottom: 30px;
    }
</style>

    <div class="cabinet__top-buttons">
        <a href="/cabinet-mobile" class="cabinet__top-buttons-profile inactive animated-background"><?php include "img/cabinet-profile-icon.svg"?>Профиль</a>
        <a href="" class="cabinet__top-buttons-orders animated-background"><?php include "img/cabinet-cart-icon.svg"?>Заказы</a>
    </div>

    <!--<div class="orders">
        <div class="orders__item order-success animated-background">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?/*= get_template_directory_uri(); */?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="<?/*= get_template_directory_uri(); */?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status green">Доставлен</span>
            </div>
            <div class="orders__item-rating">
                <span class="orders__item-rating-title">Оцените заказ</span>
                <div class="orders__item-rating-stars">
                    <span><?php /*include "img/star-icon.svg"*/?></span>
                    <span><?php /*include "img/star-icon.svg"*/?></span>
                    <span><?php /*include "img/star-icon.svg"*/?></span>
                    <span><?php /*include "img/star-icon.svg"*/?></span>
                    <span><?php /*include "img/star-icon.svg"*/?></span>
                </div>
            </div>
            <form action="#" method="post" class="orders__item-feedback">
                <textarea name="feedback" placeholder="Вы можете оставить отзыв"></textarea>
                <img src="<?/*= get_template_directory_uri(); */?>/img/feedback-icon.svg" class="orders__item-feedback-icon">
                <div class="orders__item-feedback-file-wrapper">
                    <label class="orders__item-feedback-file-image" for="file"><img src="<?/*= get_template_directory_uri(); */?>/img/input-file-img.svg"></label>
                    <input type="file" name="file" id="file">
                </div>
            </form>
        </div>
        <div class="orders__item animated-background">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?/*= get_template_directory_uri(); */?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="<?/*= get_template_directory_uri(); */?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status yellow">Доставляется</span>
            </div>
        </div>
        <div class="orders__item animated-background">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="<?/*= get_template_directory_uri(); */?>/img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="<?/*= get_template_directory_uri(); */?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status red">Отменен</span>
            </div>
        </div>
    </div>-->
    <div class="orders">
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

// The order ID
                $order_id = $loop->post->ID;
                $order = wc_get_order($order_id);
                $order_data = $order->get_data();

                $user_phone = get_field('user_phone_field', 'user_' . get_current_user_id());
                $user_phone = preg_replace('/[^0-9]/', '', $user_phone);
                $user_phone = substr($user_phone, 1);
                $order_number = $user_phone . '-' . get_field('order_number_for_current_customer', $order_data['id']);
                $order_address = $order_data['billing']['address_1'];


                $date_number = $order_data['date_created']->date('j', time());
                $date_month = get_month_title($order_data['date_created']->date('m', time()));
                $date_year = $order_data['date_created']->date('Y', time());
                $order_date = $date_number . ' ' . $date_month . ' ' . $date_year . ' г.';


                $order_status = get_order_status_title($order_data['status']);
                $order_total = (int)$order_data['total'];

//        print_r($order_number . '<br>' . $order_address . '<br>' . $order_date . '<br>' . $order_status . '<br>' . $order_total . '<br>'); ?>

                <div id="<?= get_the_ID(); ?>" class="orders__item <?php if($order_status == 'Доставлен') { echo 'order-success';} ?> animated-background">
                    <div class="orders__item-top-line">
                        <span class="orders__item-number">Заказ #<?= $order_number ?></span>
                        <div class="orders__item-top-line-right">
                            <span class="orders__item-price"><?= $order_total ?> ₽</span>
                            <img data-order-id="<?= $order_id ?>" class="orders__item-close"
                                 src="<?= get_template_directory_uri(); ?>/img/order-close.svg">
                        </div>
                    </div>
                    <span class="orders__item-address"><?= $order_address ?>
                <?php foreach ($order->get_items() as $item_key => $item ) {
                    $item_name    = $item->get_name(); // Name of the product
                    $quantity     = $item->get_quantity();

                    echo $item_name . ' x ' . $quantity . 'шт.<br>';
                } ?></span>
                    <div class="orders__item-bottom-line">
                        <div class="orders__item-bottom-line-inner-wrapper">
                            <span class="orders__item-date"><?= $order_date ?></span>
                            <!--<span class="orders__item-check"><img
                                    src="<?/*= get_template_directory_uri(); */?>/img/get-check-icon.svg"><span>Получить чек</span></span>-->
                        </div>
                        <?php if ($order_status == 'Принят') { ?>
                            <span class="orders__item-status blue">Принят</span>
                        <?php } else if ($order_status == 'Готовится') { ?>
                            <span class="orders__item-status yellow">Готовится</span>
                        <?php } else if ($order_status == 'Доставляется') { ?>
                            <span class="orders__item-status yellow">Доставляется</span>
                        <?php } else if ($order_status == 'Доставлен') { ?>
                            <span class="orders__item-status green">Доставлен</span>
                        <?php } else { ?>
                            <span class="orders__item-status red">Отменен</span>
                        <?php } ?>

                    </div>
                    <?php if ($order_status == 'Доставлен' || true) {
                        if(get_field('client_feedback_stars')) { ?>
                            <div class="orders__item-rating">
                                <span class="orders__item-rating-title">Ваш отзыв</span>
                                <div class="orders__item-rating-stars chosen">
                                    <?php
                                    for ($i = 0; $i < get_field('client_feedback_stars'); $i++) { ?>
                                        <span><?php include "img/star-icon.svg" ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if(get_field('client_feedback_text')) { ?>
                                <span class="orders__item-address" style="margin-top: 10px;margin-bottom: 0;"><?= get_field('client_feedback_text') ?></span>
                            <?php } ?>
                            <?php if(get_field('client_feedback_file')) { ?>
                                <span class="orders__item-rating-title">Прикрепленный файл:</span>
                                <img src="<?= get_field('client_feedback_file') ?>" class="orders__item-address" style="margin-top: 10px;margin-bottom: 0; border-radius: 8px; width: 100px; height: 80px; object-fit: cover;">
                            <?php } ?>
                        <?php } else { ?>
                            <div class="orders__item-rating">
                                <span class="orders__item-rating-title">Оцените заказ</span>
                                <div class="orders__item-rating-stars not-chosen">
                                    <span data-star="1"><?php include "img/star-icon.svg" ?></span>
                                    <span data-star="2"><?php include "img/star-icon.svg" ?></span>
                                    <span data-star="3"><?php include "img/star-icon.svg" ?></span>
                                    <span data-star="4"><?php include "img/star-icon.svg" ?></span>
                                    <span data-star="5"><?php include "img/star-icon.svg" ?></span>
                                </div>
                            </div>
                            <form action="#" method="post" class="orders__item-feedback" id="orders__item-feedback" enctype="multipart/form-data">
<!--                                <img style="display:none;" src="" class="orders__item-feedback-img" alt="review-img">-->
                                <input type="hidden" name="stars">
                                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                                <textarea name="feedback" placeholder="Вы можете оставить отзыв"></textarea>
                                <img src="<?= get_template_directory_uri(); ?>/img/feedback-icon.svg"
                                     class="orders__item-feedback-icon">
                                <div class="orders__item-feedback-file-wrapper">
                                    <label class="orders__item-feedback-file-image" for="file"><img
                                                src="<?= get_template_directory_uri(); ?>/img/input-file-img.svg"></label>
                                    <input type="file" name="file" id="file">
                                </div>
                                <span class="orders__item-rating-title" style="display: flex; justify-content: flex-end; margin-top: 10px;">Разрешенные для загрузки форматы файлов: jpg, jpeg, png</span>
                                <input type="submit" value="Отправить" style="margin-left: auto;border: none;outline: none;margin-top: 10px;height: 40px;cursor: pointer;" class="cabinet__top-buttons-orders">
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>

            <?php endwhile;

            wp_reset_postdata();

        endif;
        ?>
    </div>
</div>
<div class="orders__get-check-popup">
    <span class="orders__get-check-popup-title">Отправка кассового чека</span>
    <form action="#" method="post" class="orders__get-check-popup-form">
        <div class="orders__get-check-popup-form-email-wrapper">
            <input type="email" name="email" id="email" placeholder="Укажите e-mail">
            <img src="<?= get_template_directory_uri(); ?>/img/email-popup-icon.svg" class="orders__get-check-popup-email-image">
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>
<div class="overlay"></div>
<?php
include 'js/orders-js.php';
require_once 'footer_mobile.php';

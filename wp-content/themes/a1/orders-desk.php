<?php
/* Template Name: orders-desk */
get_header();
if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php }

?>

<div class="cabinet__title-wrapper animated-background">
    <h1 class="cabinet__title">Личный кабинет</h1>
</div>

<div class="cabinet__top-buttons">
    <a href="/cabinet" class="cabinet__top-buttons-profile inactive animated-background"><?php include "img/cabinet-profile-icon.svg" ?>
        Профиль</a>
    <a href="/orders" class="cabinet__top-buttons-orders animated-background"><?php include "img/cabinet-cart-icon.svg" ?>Заказы</a>
</div>

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

            <div class="orders__item order-success animated-background">
                <div class="orders__item-top-line">
                    <span class="orders__item-number">Заказ #<?= $order_number ?></span>
                    <div class="orders__item-top-line-right">
                        <span class="orders__item-price"><?= $order_total ?> ₽</span>
                        <img data-order-id="<?= $order_id ?>" class="orders__item-close"
                             src="<?= get_template_directory_uri(); ?>/img/order-close.svg">
                    </div>
                </div>
                <span class="orders__item-address"><?= $order_address ?><br><br>
                <?php foreach ($order->get_items() as $item_key => $item ) {
                    $item_name    = $item->get_name(); // Name of the product
                    $quantity     = $item->get_quantity();

                    echo $item_name . ' x ' . $quantity . 'шт.<br>';
                } ?></span>
                <div class="orders__item-bottom-line">
                    <div class="orders__item-bottom-line-inner-wrapper">
                        <span class="orders__item-date"><?= $order_date ?></span>
                        <span class="orders__item-check"><img
                                    src="<?= get_template_directory_uri(); ?>/img/get-check-icon.svg"><span>Получить чек</span></span>
                    </div>
                    <?php if ($order_status == 'Принят') { ?>
                        <span class="orders__item-status blue">Принят</span>
                    <?php } else if ($order_status == 'Доставляется') { ?>
                        <span class="orders__item-status yellow">Доставляется</span>
                    <?php } else if ($order_status == 'Доставлен') { ?>
                        <span class="orders__item-status green">Доставлен</span>
                    <?php } else { ?>
                        <span class="orders__item-status red">Отменен</span>
                    <?php } ?>

                </div>
                <?php if ($order_status == 'Доставлен') {
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
    <span class="orders__get-check-popup-title">Отправка<br>кассового чека</span>
    <form action="#" method="post" class="orders__get-check-popup-form">
        <div class="orders__get-check-popup-form-email-wrapper">
            <input type="email" name="email" id="email" placeholder="Укажите e-mail">
            <img src="<?= get_template_directory_uri(); ?>/img/email-popup-icon.svg"
                 class="orders__get-check-popup-email-image">
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>
<div class="overlay"></div>

<script>
    $('.orders__item-close').on('click', function (e) {
        $(this).parent().parent().parent().remove();

        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/delete_order.php',
            dataType: 'json',
            data:
                {
                    'order_id': $(this).data('order-id'),
                },
            success: function (data) {//success callback
                console.log(data);
            },
            error: function (data) {
                console.log('error');
            }
        });
    });
</script>

<?php get_footer() ?>

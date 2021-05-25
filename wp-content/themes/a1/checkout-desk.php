<?php
/* Template Name: checkout-desk */
get_header();
if(!is_user_logged_in()) {
    $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <script>
        window.location.href="/login?redirect=<?= $current_link; ?>";
    </script>
<?php } ?>
<style>
    .main > .woocommerce {
        display: none;
    }
</style>
<?php
the_content();
?>

    <div class="cabinet__title-wrapper animated-background">
        <h1 class="cabinet__title">Оформление заказа</h1>
    </div>

    <form method="post" class="delivery-form" id="delivery-form">
        <?php if(!get_field('user_email_field', 'user_' . get_current_user_id())) { ?>
            <!--<span class="email-alert animated-background">Для оформления заказа укажите свой email в <a href="/cabinet">личном кабинете</a></span>-->
            <span class="delivery-address__title animated-background">Введите ваш e-mail (обязательное поле)</span>
            <input class="temporary-email-field" type="email" id="temporary-email-field" placeholder="example@example.com">
        <?php } ?>
        <div class="delivery-form__address">
            <span class="delivery-address__title animated-background">Выберите адрес доставки</span>
            <?php
            $i = 1;
            if(get_field('user_addresses_list_field', 'user_' . get_current_user_id())) {
                foreach (get_field('user_addresses_list_field', 'user_' . get_current_user_id()) as $item) { ?>
                    <input class="delivery-form__address-input animated-background <?php if($i == 1) {echo 'active'; } ?>" type="text" name="address-<?= $i; ?>" id="address-<?= $i; ?>" placeholder="ул. Фрунзе 38, офис 401" value="<?= 'ул. ' . $item['street'] . ' ' . $item['building'] ?>
<?php if ($item['entrance']) {
                        echo ', под. ' . $item['entrance'];
                    }
                    if ($item['floor']) {
                        echo ', эт. ' . $item['floor'];
                    }
                    if ($item['apartment']) {
                        echo ', кв./офис ' . $item['apartment'];
                    }
                    if ($item['comment']) {
                        echo ' (' . $item['comment'] . ')';
                    }
                    ?>" readonly data-street="<?= $item['street'] ?>" data-home="<?= $item['building'] ?>" data-pod="<?= $item['entrance'] ?>" data-et="<?= $item['floor'] ?>" data-apart="<?= $item['apartment'] ?>" data-comment="<?= $item['comment'] ?>">
                <?php $i++; }
            } else { ?>
<!--                <a style="width: 200px;" href="/address?checkout=true" class="cabinet__profile-form-add-address animated-background">Добавить адрес</a>-->
            <?php }
            ?>
            <a style="width: 200px;" href="/address?checkout=true" class="cabinet__profile-form-add-address animated-background">Добавить адрес</a>
        </div>
        <div class="delivery-form__date-time-wrapper">
            <div class="delivery-form__date">
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field animated-background">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-data-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Дата доставки</span>
                            <?php
                            date_default_timezone_set('Asia/Omsk');
                            $current_hour = date('H', time());

                            $date_number = date('j', time());
                            $date_number_tomorrow = date('j', time() + 86400);
                            $date_month = date('m', time());
                            $date_month_tomorrow = date('m', time() + 86400);
                            $day = date('w', strtotime(date('m/d/Y', time())));
                            $day_tomorrow = date('w', strtotime(date('m/d/Y', time() + 86400)));
                            $day = getDay($day);
                            $day_tomorrow = getDay($day_tomorrow);
                            $date_month = getMonth($date_month);
                            $date_month_tomorrow = getMonth($date_month_tomorrow);

                            if($current_hour >= 23) { ?>
                                <span class="delivery-form__date-main-field-text"><span class="plain-text">Завтра</span> <span class="plain-date"><?= $day_tomorrow . ' ' . $date_number_tomorrow . ' ' . $date_month_tomorrow ?></span></span>
                            <?php } else { ?>
                                <span class="delivery-form__date-main-field-text"><span class="plain-text">Сегодня</span> <span class="plain-date"><?= $day . ' ' . $date_number . ' ' . $date_month ?></span></span>
                            <?php }
                            ?>
                        </div>
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-bottom-icon.svg" class="delivery-form__date-main-field-right-img">
                    </div>

                    <div class="delivery-form__date-subfields">
                        <?php
                        date_default_timezone_set('Asia/Omsk');
                        $time_plus = 0;
                        for($i = 0; $i < 7; $i++) {
                            $date_number = date('j', time() + $time_plus);
                            $date_month = date('m', time() + $time_plus);
                            $day = date('w', strtotime(date('m/d/Y', time() + $time_plus)));
                            $day = getDay($day);
                            $date_month = getMonth($date_month);

                            if($i == 0) {
                                $date_echo = '<span class="plain-text">Сегодня</span> <span class="plain-date">' . $day . ' ' . $date_number . ' ' . $date_month . '</span>';
                            } else if($i == 1) {
                                $date_echo = '<span class="plain-text">Завтра</span> <span class="plain-date">' . $day . ' ' . $date_number . ' ' . $date_month . '</span>';
                            } else {
                                $date_echo = $day . ' ' . $date_number . ' ' . $date_month;
                            }

                            if(!($i == 0 && $current_hour >= 23)) { ?>
                                <span class="delivery-form__date-subfield" data-date="<?= date('Y-m-d', time() + $time_plus) ?>"><?= $date_echo ?></span>
                            <?php }

                             $time_plus += 86400; }
                        ?>
                    </div>
                </div>
            </div>
            <div class="delivery-form__time">
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field animated-background">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-time-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Время доставки</span>
                            <span class="delivery-form__date-main-field-text"><span class="plain-text">Ближайшее</span>
                            	<?php if(get_field('text_asap_time', 'option')) { ?>
                            		<span class="delivery-form__date-main-field-text-desc"><?= get_field('text_asap_time', 'option'); ?></span>
                        		<?php } ?>
                            </span>
                        </div>
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-bottom-icon.svg" class="delivery-form__date-main-field-right-img">
                    </div>
                    <div class="delivery-form__date-subfields">
                        <?php
                        $hour = date('H', time()+7200);
                        $min = date('i', time()+7200);
                        if($hour < 12) {
                            $hour = 12;
                            $minute = '00';
                        } else {
                            if ($min<=30) {
                                $minute = '30';
                            } else {
                                $minute = '00';
                                $hour++;
                            }
                        }

//                        $full_time_line_for_js_in_the_bottom = $hour . ':'. $minute . ':' . '00';
                        $full_time_line_for_js_in_the_bottom = date('H', time()) . ':'. date('i', time()) . ':' . '00';

                        ?>
                        <!--<span class="delivery-form__date-subfield" data-time="<?php /*echo "$hour:$minute:00" */?>">Ближайшее</span>-->
                        <span class="delivery-form__date-subfield" data-time="<?php echo date('H', time()) . ":" . date('i', time()) . ":00" ?>"><span class="plain-text">Ближайшее</span>
                    		<?php if(get_field('text_asap_time', 'option')) { ?>
                        		<span class="delivery-form__date-main-field-text-desc"><?= get_field('text_asap_time', 'option'); ?></span>
                    		<?php } ?>
                		</span>
                        <span class="delivery-form__date-subfield" data-time="<?php echo "$hour:$minute:00" ?>"><?php echo "$hour:$minute" ?></span>
                        <?php
                        if($minute == '30') {
                            $minute = '00';
                            $minute2 = '30';
                            $hour += 0.5;
                        } else {
                            $minute = '30';
                            $minute2 = '00';
                        }

                        $i = 0;
                        while($hour < 23) {
                            if($i % 2 == 0) {
                                $minute_current = $minute;
                            } else {
                                $minute_current = $minute2;
                            }

                            $hour += 0.5;
                            $hour_current =(int)$hour;
                            ?>
                            <span class="delivery-form__date-subfield"  data-time="<?php echo "$hour_current:$minute_current:00" ?>"><?php echo "$hour_current:$minute_current" ?></span>
                        <?php $i++; } ?>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit">
    </form>

    <div class="checkout-cards">
        <div class="checkout-cards-left">
            <div class="checkout-cards-right-price animated-background">
                <span>Итого к оплате:</span>
                <span>1 095 ₽</span>
            </div>
        </div>
        <div class="checkout-cards-right">
            <div class="checkout-cards-right__apple-pay animated-background">
                <span>Оплата в один клик:</span>
                <img src="<?= get_template_directory_uri(); ?>/img/apple-pay-logo-desk.svg">
            </div>
        </div>
    </div>
    <div class="checkout-desk-bottom">
        <?php if(get_field('user_email_field', 'user_' . get_current_user_id())) { ?>

        <?php } ?>
        <span class="checkout-desk-bottom-submit checkout-submit animated-background" onclick="ym(77765119, 'reachGoal', 'click_pay'); return true;">Оплатить</span>
        <span class="checkout-desk-bottom-text animated-background">А1 доставляет только<br>предоплаченные заказы</span>
    </div>
</div>

<?php
include 'js/checkout-js.php';
get_footer() ?>

<?php
/* Template Name: checkout-mobile */
require_once 'header_mobile.php';
if(!is_user_logged_in()) {
    $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <script>
        window.location.href="/login-mobile?redirect=<?= $current_link; ?>";
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

    <form method="post" class="delivery-form" id="delivery-form">
        <?php if(!get_field('user_email_field', 'user_' . get_current_user_id())) { ?>
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
                    ?>" readonly data-street="<?= $item['street'] ?>" data-home="<?= $item['building'] ?>" data-pod="<?= $item['entrance'] ?>" data-et="<?= $item['floor'] ?>" data-apart="<?= $item['apartment'] ?>">
                    <?php $i++; }
            } ?>
            <a href="/address-mobile?checkout=true" class="cabinet__profile-form-add-address animated-background">Добавить адрес</a>
        </div>

        <div class="delivery-form__date-time-wrapper">
            <div class="delivery-form__date">
                <span class="delivery-form__date__title">Дата доставки</span>
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field animated-background">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-data-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <?php
                            date_default_timezone_set('Asia/Omsk');
                            $current_hour = date('H', time());
                            if($current_hour >= 23) { ?>
                                <span class="delivery-form__date-main-field-text">Завтра</span>
                            <?php } else { ?>
                                <span class="delivery-form__date-main-field-text">Сегодня</span>
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
                            if($day == 1) {
                                $day = 'Пн';
                            } else if($day == 2) {
                                $day = 'Вт';
                            } else if($day == 3) {
                                $day = 'Ср';
                            } else if($day == 4) {
                                $day = 'Чт';
                            } else if($day == 5) {
                                $day = 'Пт';
                            } else if($day == 6) {
                                $day = 'Сб';
                            } else if($day == 0) {
                                $day = 'Вс';
                            }

                            if($date_month == 1) {
                                $date_month = 'января';
                            } else if($date_month == 2) {
                                $date_month = 'февраля';
                            } else if($date_month == 3) {
                                $date_month = 'марта';
                            } else if($date_month == 4) {
                                $date_month = 'апреля';
                            } else if($date_month == 5) {
                                $date_month = 'мая';
                            } else if($date_month == 6) {
                                $date_month = 'июня';
                            } else if($date_month == 7) {
                                $date_month = 'июля';
                            } else if($date_month == 8) {
                                $date_month = 'августа';
                            } else if($date_month == 9) {
                                $date_month = 'сентября';
                            } else if($date_month == 10) {
                                $date_month = 'октября';
                            } else if($date_month == 11) {
                                $date_month = 'ноября';
                            } else if($date_month == 12) {
                                $date_month = 'декабря';
                            }

                            if($i == 0) {
                                $date_echo = 'Сегодня';
                            } else if($i == 1) {
                                $date_echo = 'Завтра';
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
                <span class="delivery-form__date__title">Время доставки</span>
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field animated-background">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-time-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date-main-field-text">Ближайшее</span>
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
                        <span class="delivery-form__date-subfield" data-time="<?php echo date('H', time()) . ":" . date('i', time()) . ":00" ?>">Ближайшее</span>
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

    <div class="checkout-notice">
        <span class="checkout-notice__title">Примечание</span>
        <span class="checkout-notice__text">A1ЕДА доставляет только<br>предоплаченные заказы</span>
    </div>

    <div class="cart-button-wrapper">
        <div class="cart-button cart-button-2 checkout-submit">
            <div class="cart-button-left">
                <span>Оплатить заказ</span>
            </div>
        </div>
    </div>
</div>
<?php
include 'js/checkout-js.php';
require_once 'footer_mobile.php';

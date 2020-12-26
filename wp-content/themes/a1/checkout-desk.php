<?php
/* Template Name: checkout-desk */
get_header();
if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login?order=true";
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
                    ?>" readonly data-street="<?= $item['street'] ?>" data-home="<?= $item['building'] ?>" data-pod="<?= $item['entrance'] ?>" data-et="<?= $item['floor'] ?>" data-apart="<?= $item['apartment'] ?>">
                <?php $i++; }
            } else { ?>
                <a style="width: 200px;" href="/address?checkout=true" class="cabinet__profile-form-add-address animated-background">Добавить адрес</a>
            <?php }
            ?>
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
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field animated-background">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-time-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Время доставки</span>
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

                        $full_time_line_for_js_in_the_bottom = $hour . ':'. $minute . ':' . '00';

                        ?>
                        <span class="delivery-form__date-subfield" data-time="<?php echo "$hour:$minute:00" ?>">Ближайшее</span>
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
            <form method="post" class="payment__card">
                <span class="payment__card-number-title">Номер карты:</span>
                <div class="payment__card-example-numbers">
                    <input type="number" name="card_number_1" placeholder="5469" maxlength="4"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    <input type="number" name="card_number_2" placeholder="5469" maxlength="4"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    <input type="number" name="card_number_3" placeholder="5469" maxlength="4"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    <input type="number" name="card_number_4" placeholder="5469" maxlength="4"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="payment__card-terms">
                    <span class="payment__card-terms-title">Срок действия:</span>
                    <div class="payment__card-terms-values-wrapper">
                        <input name="term_value_month" type="number" class="payment__card-terms-value" placeholder="12"
                               maxlength="2"
                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        <span class="payment__card-terms-slash">/</span>
                        <input name="term_value_year" type="number" class="payment__card-terms-value" placeholder="21"
                               maxlength="2"
                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                </div>
                <span class="payment__card-holder-label">Имя:</span>
                <input type="text" placeholder="IVANOV IVAN IVANOVICH" name="card_holder_name"
                       class="payment__card-holder-name">
                <div class="payment__card-bottom-block">
                    <div class="payment__card-bottom-block-1">
                        <span>Принимаем к оплате:</span>
                        <div>
                            <img src="<?= get_template_directory_uri(); ?>/img/visa-icon.svg">
                            <img src="<?= get_template_directory_uri(); ?>/img/mastercard-icon.svg">
                            <img src="<?= get_template_directory_uri(); ?>/img/mir-icon.svg">
                        </div>
                    </div>
                    <div class="payment__card-bottom-block-2">
                        <span>CVC/CVV:</span>
                        <input type="number" name="cvv" placeholder="***" maxlength="3"
                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                </div>
                <div class="payment__card-save-card">
                    <label class="payment__card-save-card-container">Сохранить карту
                        <input type="checkbox" checked="checked" name="save_card">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </form>
            <span class="card_error"></span>
        </div>
        <div class="checkout-cards-right">
            <div class="payment2__owl-carousel-cards">
                <div class="payment2__owl-carousel-card-1">
                    <div class="payment2__owl-carousel-card-1-block-1">
                        <img src="<?= get_template_directory_uri(); ?>/img/visa-big-icon.svg">
                        <img src="<?= get_template_directory_uri(); ?>/img/check-yellow.svg">
                    </div>
                    <div class="payment2__owl-carousel-card-1-block-2">
                        <span>**** **** **** 1951</span>
                    </div>
                    <div class="payment2__owl-carousel-card-1-block-3">
                        <span>Сбербанк</span>
                    </div>
                </div>
                <div class="payment2__owl-carousel-card-1">
                    <div class="payment2__owl-carousel-card-1-block-1">
                        <img src="<?= get_template_directory_uri(); ?>/img/visa-big-icon.svg">
                        <img src="<?= get_template_directory_uri(); ?>/img/check-yellow.svg">
                    </div>
                    <div class="payment2__owl-carousel-card-1-block-2">
                        <span>**** **** **** 1951</span>
                    </div>
                    <div class="payment2__owl-carousel-card-1-block-3">
                        <span>Сбербанк</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout-desk-bottom">
        <?php if(get_field('user_email_field', 'user_' . get_current_user_id())) { ?>

        <?php } ?>
        <span class="checkout-desk-bottom-submit animated-background">Оплатить</span>
        <span class="checkout-desk-bottom-text animated-background">А1 доставляет только<br>предоплаченные заказы</span>
    </div>
</div>
<script>
    $('.checkout-desk-bottom-submit').on('click', function (e) {
        e.preventDefault();
        $('form.woocommerce-checkout').submit();
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $('#temporary-email-field').on('input', function() {
        if (validateEmail($(this).val())) {
            $(this).css('border', '2px solid #3F9B48');

            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/custom_files_dm/add_email.php',
                dataType: 'json',
                data:
                    {
                        'contact-email': $(this).val(),
                    },
                success: function (data) {//success callback
                    console.log(data);
                },
                error: function (data) {
                    console.log('error');
                }
            });

        } else {
            $(this).css('border', '2px solid #FF0303');
        }
    });

    // $('#billing_address_1').attr('value', $('#address-1').attr('value'));
    $('#billing_city').attr('value', 'Омск');
    $('#billing_street').attr('value', $('#address-1').data('street'));
    $('#billing_home').attr('value', $('#address-1').data('home'));
    if($('#address-1').data('pod')) {
        $('#billing_pod').attr('value', $('#address-1').data('pod'));
    }
    if($('#address-1').data('et')) {
        $('#billing_et').attr('value', $('#address-1').data('et'));
    }
    if($('#address-1').data('apart')) {
        $('#billing_apart').attr('value', $('#address-1').data('apart'));
    }

    $('.delivery-form__address-input').on('click', function (e) {
        // $('#billing_address_1').attr('value', $(this).attr('value'));
        $('#billing_street').attr('value', $(this).data('street'));
        $('#billing_home').attr('value', $(this).data('home'));
        if($(this).data('pod')) {
            $('#billing_pod').attr('value', $(this).data('pod'));
        }
        if($(this).data('et')) {
            $('#billing_et').attr('value', $(this).data('et'));
        }
        if($(this).data('apart')) {
            $('#billing_apart').attr('value', $(this).data('apart'));
        }
    });

    <?php if(get_field('user_name_field', 'user_' . get_current_user_id())) { ?>
    $('#billing_first_name').attr('value', '<?= get_field('user_name_field', 'user_' . get_current_user_id()); ?>');
    <?php } else { ?>
    $('#billing_first_name').attr('value', 'Имя не задано');
    <?php } ?>

    $('#billing_phone').attr('value', '<?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?>');
    $('#billing_date').attr('value', '<?php
        if($current_hour >= 23) {
            echo date('Y-m-d', time()+3600);
        } else {
            echo date('Y-m-d', time());
        } ?>');
    $('#billing_time').attr('value', '<?= $full_time_line_for_js_in_the_bottom ?>');

</script>
<?php get_footer() ?>

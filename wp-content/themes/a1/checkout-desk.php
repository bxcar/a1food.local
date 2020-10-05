<?php
/* Template Name: checkout-desk */
get_header();
//the_content();
?>

    <div class="cabinet__title-wrapper">
        <h1 class="cabinet__title">Оформление заказа</h1>
    </div>

    <form action="#" method="post" class="delivery-form" id="delivery-form">
        <div class="delivery-form__address">
            <span class="delivery-address__title">Выберите адрес доставки</span>
            <input type="text" name="address" id="address" placeholder="ул. Фрунзе 38, офис 401">
        </div>
        <div class="delivery-form__date-time-wrapper">
            <div class="delivery-form__date">
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field">
                        <img src="<?= get_template_directory_uri(); ?>/img/checkout-data-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Дата доставки</span>
                            <span class="delivery-form__date-main-field-text">Сегодня</span>
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
                            ?>
                            <span class="delivery-form__date-subfield" data-date="<?= date('d/m/Y', time() + $time_plus) ?>"><?= $date_echo ?></span>
                        <?php $time_plus += 86400; }
                        ?>
                    </div>
                </div>
            </div>
            <div class="delivery-form__time">
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field">
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

                        ?>
                        <span class="delivery-form__date-subfield" data-time="<?php echo "$hour:$minute" ?>">Ближайшее</span>
                        <span class="delivery-form__date-subfield" data-time="<?php echo "$hour:$minute" ?>"><?php echo "$hour:$minute" ?></span>
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
                            <span class="delivery-form__date-subfield"  data-time="<?php echo "$hour_current:$minute_current" ?>"><?php echo "$hour_current:$minute_current" ?></span>
                        <?php $i++; } ?>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit">
    </form>

    <div class="checkout-cards">
        <div class="checkout-cards-left">
            <div class="checkout-cards-right-price">
                <span>Итого к оплате:</span>
                <span>1 095 ₽</span>
            </div>
            <form action="#" method="post" class="payment__card">
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
                <!--<div class="payment__card-save-card">
                    <label class="payment__card-save-card-container">Сохранить карту
                        <input type="checkbox" checked="checked" name="save_card">
                        <span class="checkmark"></span>
                    </label>
                </div>-->
            </form>
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
        <span class="checkout-desk-bottom-submit">Оплатить</span>
        <span class="checkout-desk-bottom-text">А1 доставляет только<br>предоплаченные заказы</span>
    </div>
</div>
<script>
    /*var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    console.log(today);*/
</script>
<?php get_footer() ?>

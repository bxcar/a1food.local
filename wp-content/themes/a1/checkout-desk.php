<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Оформление заказа - A1</title>

    <!--header styles start-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
    <link rel="stylesheet" href="css/main-desk.css">
    <!--header styles end-->
</head>
<body>
<div class="main container">
    <header class="header">
        <div class="header_inner_wrapper">
            <!--            <img class="header__menu-button" src="img/burger-menu-icon.svg">-->
            <img class="header__logo" src="img/logo.svg">
        </div>
        <div class="header__login-and-cart-wrapper">
            <div class="header__login-button">
                <img class="header__login-img" src="img/user-icon.svg">
                <span class="header__login-text">Войти</span>
            </div>
            <a href="#" class="header__cart-button">
                <img src="img/cart-icon.svg">
                <span>1095 ₽</span>
            </a>
        </div>
        <!--<div class="header__login-button" style="width: 170px;">
            <img class="header__login-img" src="img/user-icon.svg">
            <span class="header__login-text">+7 (515) 525-66-55</span>
        </div>-->
    </header>

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
                        <img src="img/checkout-data-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Дата доставки</span>
                            <span class="delivery-form__date-main-field-text">Сегодня</span>
                        </div>
                        <img src="img/checkout-bottom-icon.svg" class="delivery-form__date-main-field-right-img">
                    </div>
                    <div class="delivery-form__date-subfields">
                        <span class="delivery-form__date-subfield">Сегодня</span>
                        <span class="delivery-form__date-subfield">Завтра</span>
                        <span class="delivery-form__date-subfield">Ср 21 июня</span>
                        <span class="delivery-form__date-subfield">Чт 22 июня</span>
                        <span class="delivery-form__date-subfield">Пт 23 июня</span>
                        <span class="delivery-form__date-subfield">Сб 24 июня</span>
                        <span class="delivery-form__date-subfield">Вс 25 июня</span>
                    </div>
                </div>
            </div>
            <div class="delivery-form__time">
                <div class="delivery-form__date-fields-wrapper">
                    <div class="delivery-form__date-main-field">
                        <img src="img/checkout-time-icon.svg" class="delivery-form__date-main-field-left-img">
                        <div class="delivery-form__date-main-field-inner-wrapper">
                            <span class="delivery-form__date__title">Время доставки</span>
                            <span class="delivery-form__date-main-field-text">Ближайшее</span>
                        </div>
                        <img src="img/checkout-bottom-icon.svg" class="delivery-form__date-main-field-right-img">
                    </div>
                    <div class="delivery-form__date-subfields">
                        <span class="delivery-form__date-subfield">Ближайшее</span>
                        <span class="delivery-form__date-subfield">15:00</span>
                        <span class="delivery-form__date-subfield">16:00</span>
                        <span class="delivery-form__date-subfield">17:00</span>
                        <span class="delivery-form__date-subfield">18:00</span>
                        <span class="delivery-form__date-subfield">19:00</span>
                        <span class="delivery-form__date-subfield">20:00</span>
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
                            <img src="img/visa-icon.svg">
                            <img src="img/mastercard-icon.svg">
                            <img src="img/mir-icon.svg">
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
                        <img src="img/visa-big-icon.svg">
                        <img src="img/check-yellow.svg">
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
                        <img src="img/visa-big-icon.svg">
                        <img src="img/check-yellow.svg">
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
    <!--footer scripts start-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/common.js"></script>
    <script>
        $(".payment2__owl-carousel-cards").owlCarousel({
            items: 1,
        });
    </script>
    <!--footer scripts end-->
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Оплата2 - A1</title>

    <!--header styles start-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
    <link rel="stylesheet" href="css/main.css">
    <!--header styles end-->
</head>
<body>
<div class="main container">
    <header class="header-in">
        <div class="header-in__inner-wrapper">
            <a href="#" class="header-in__back"><img src="img/header-in-back.svg"></a>
            <span class="header-in__title">Оплата</span>
        </div>
        <img class="header-in__logo" src="img/header-in-logo.svg">
    </header>

    <span class="payment__price-title">1 095 ₽</span>
    <span class="payment__price-subtitle">Итого к оплате</span>

    <span class="payment__methods-title">Оплата в один клик</span>
    <div class="payment__methods">
        <a href="#"><img src="img/apple-pay-big.svg"></a>
    </div>

    <span class="payment__card-title">Выбор способа оплаты</span>

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
        <div class="payment2__owl-carousel-card-2">
            <div class="payment2__owl-carousel-card-2-block-1">
                <img src="img/visa-card-icon.svg">
                <img src="img/mastercard-card-icon.svg">
                <img src="img/mir-card-icon.svg">
            </div>
            <div class="payment2__owl-carousel-card-2-block-2">
                <span>Оплатить другой картой</span>
            </div>
        </div>
    </div>


    <div class="cart-button-wrapper">
        <div class="cart-button cart-button-2">
            <div class="cart-button-left">
                <span>Оплатить</span>
            </div>
        </div>
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

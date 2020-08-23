<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Оплата3 - A1</title>

    <!--header styles start-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
    <link rel="stylesheet" href="css/main.css">
    <!--header styles end-->
</head>
<body>
<div class="main container">
    <header class="header">
        <div class="header-in__inner-wrapper">
            <a href="#" class="header-in__back"><img src="img/header-in-back.svg"></a>
            <span class="header-in__title">Связаться с нами</span>
        </div>
        <img class="header-in__logo" src="img/header-in-logo.svg">
    </header>

    <form action="#" method="post" class="contact__form">
        <input type="text" name="name" placeholder="Укажите имя">
        <input type="tel" name="phone" id="phone" placeholder="Укажите номер телефона">
        <input type="email" name="email" placeholder="Укажите e-mail">
        <textarea placeholder="Комментарий"></textarea>
    </form>


    <div class="cart-button-wrapper">
        <div class="cart-button cart-button-2">
            <div class="cart-button-left">
                <span>Отправить заявку</span>
            </div>
        </div>
    </div>
</div>
<!--footer scripts start-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="js/common.js"></script>
<script>
    $("#phone").mask("+7 (999) 999-99-99");
</script>
<!--footer scripts end-->
</body>
</html>

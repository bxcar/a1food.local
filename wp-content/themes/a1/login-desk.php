<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Вход - A1</title>

    <!--header styles start-->
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

    <div class="login__form-wrapper">
        <span class="login__form-wrapper__title">Мы вас не узнали</span>
        <span class="login__title">Пожалуйста, укажите номер телефона</span>

        <form action="#" method="post" class="login__form1">
            <input type="text" class="login__form1-number" name="number" id="phone" placeholder="номер телефона">
            <span class="login__form1-number-before">+7</span>
            <button type="submit">Получить код</button>
        </form>
        <form action="#" method="post" class="login__form2">
            <input type="text" class="login__form2-code" name="code" placeholder="Код из sms">
            <button type="submit">Далее</button>
        </form>

        <p class="login__agreement">Нажимая на кнопку, вы принимаете условия<br> <a href="#">пользовательского соглашения</a></p>
    </div>


</div>

<div class="footer">
    <div class="footer__container">
        <div class="footer__wrapper1">
            <img src="img/logo.svg">
            <span>(с) Все права защищены</span>
            <span>Построено в MOS-DIGITAL</span>
        </div>
        <div class="footer__wrapper2">
            <a href="#"><?php include "img/feedback.svg" ?> обратная связь</a>
            <a href="#"><?php include "img/agreement.svg" ?> пользовательское соглашение</a>
        </div>
    </div>
</div>
<!--footer scripts start-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="js/common.js"></script>
<script>
    $("#phone").mask("(999) 999-99-99");
</script>
<!--footer scripts end-->
</body>
</html>

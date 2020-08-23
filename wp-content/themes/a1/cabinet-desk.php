<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Личный кабинет - A1</title>

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

    <div class="cabinet__title-wrapper">
        <h1 class="cabinet__title">Личный кабинет</h1>
        <a href="#" class="cabinet_logout"><img src="img/logout.png"></a>
    </div>

    <div class="cabinet__top-buttons">
        <a href="./cabinet.php" class="cabinet__top-buttons-profile"><?php include "img/cabinet-profile-icon.svg"?>Профиль</a>
        <a href="./orders-desk.php" class="cabinet__top-buttons-orders inactive"><?php include "img/cabinet-cart-icon.svg"?>Заказы</a>
    </div>

    <form action="#" method="post" class="cabinet__profile-form">
        <div class="cabinet__profile-form-phone"><input type="text" name="phone" id="phone" placeholder="+7 (555) 555-51-55"></div>
        <div class="cabinet__profile-form-name"><input type="text" name="name" placeholder="Укажите имя"></div>
        <div class="cabinet__profile-form-birth-date"><input type="text" name="birth-date" id="birth-date" placeholder="Укажите дату рождения"></div>
        <div class="cabinet__profile-form-email"><input type="email" name="email" placeholder="Укажите e-mail для чеков"></div>
        <div class="cabinet__profile-form-address"><input type="text" name="address" placeholder="ул. Фрунзе 308, офис 401"></div>
        <span class="cabinet__profile-form-add-address">Добавить адрес</span>
    </form>
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
    $("#phone").mask("+7 (999) 999-99-99");
    $("#birth-date").mask("99.99.9999");
</script>
<!--footer scripts end-->
</body>
</html>

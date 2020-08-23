<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Корзина - A1</title>

    <!--header styles start-->
    <link rel="stylesheet" href="css/main-desk.css">
    <!--header styles end-->
</head>
<body>
<div class="main container-inner">
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
    <div class="cart-products">
        <div class="cart-products__item">
            <div class="cart-products__item-wrapper1">
                <span class="cart-products__item-remove"><img src="img/cart-product-remove.svg"></span>
                <img src="img/cart-product-img-desk.png" class="cart-products__item-image">
                <div class="cart-products__item-title-wrapper">
                    <span class="cart-products__item-title">Ролл «Филадельфия»</span>
                    <span class="cart-products__item-title-bottom">180 гр. х 3 шт.</span>
                </div>
            </div>
            <div class="cart-products__item-wrapper2">
                <div class="cart-products__item-price-wrapper">
                    <span class="cart-products__item-price">2249 ₽</span>
                    <div class="cart-products__item-amount-change">
                        <img src="img/less.svg" class="less">
                        <span class="amount">3</span>
                        <img src="img/more.svg" class="more">
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-products__item">
            <div class="cart-products__item-wrapper1">
                <span class="cart-products__item-remove"><img src="img/cart-product-remove.svg"></span>
                <img src="img/cart-product-img-desk.png" class="cart-products__item-image">
                <div class="cart-products__item-title-wrapper">
                    <span class="cart-products__item-title">Ролл «Филадельфия»</span>
                    <span class="cart-products__item-title-bottom">180 гр. х 3 шт.</span>
                </div>
            </div>
            <div class="cart-products__item-wrapper2">
                <div class="cart-products__item-price-wrapper">
                    <span class="cart-products__item-price">2249 ₽</span>
                    <div class="cart-products__item-amount-change">
                        <img src="img/less.svg" class="less">
                        <span class="amount">3</span>
                        <img src="img/more.svg" class="more">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-delivery">
        <div class="cart-delivery__left-wrapper">
            <span class="cart-delivery__title">Доставка</span>
            <span class="cart-delivery__title-bottom">Закажите еще на 280р для бесплатной доставки</span>
        </div>
        <span class="cart-delivery__price">99 ₽</span>
    </div>
    <div class="cart-promo">
        <div class="cart-promo__title">Введите промокод если есть:</div>
        <form method="post" action="#" class="cart-promo-form">
            <input type="text" name="promo" id="promo" placeholder="6136316136136">
            <input type="submit">
        </form>
    </div>
    <div class="cart-button-desktop">
        <div class="cart-button-desktop-left">
            <img src="img/cart-icon.svg">
            <span>Оформить заказ</span>
        </div>
        <div class="cart-button-desktop-right">
            <span>1095 ₽</span>
        </div>
    </div>
    <div class="cart-minimum-order-price">
        <span><img src="img/cart-i.svg">Минимальная сумма заказа 500р</span>
    </div>
    <div class="cart-recommend">
        <span>Рекомендуем</span>
    </div>

    <div class="products">
        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>
        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

        <div class="product-item">
            <img class="product-item-img" src="img/product-img-desk.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы идейные соображения</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="img/info-icon.svg">
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <li>
                                <span class="product-item-bottom-i-list-title">Количество</span>
                                <span class="product-item-bottom-i-list-text">8 шт.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Вес</span>
                                <span class="product-item-bottom-i-list-text">300 г.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Калории</span>
                                <span class="product-item-bottom-i-list-text">784 кК.</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Белки</span>
                                <span class="product-item-bottom-i-list-text">9</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Жиры</span>
                                <span class="product-item-bottom-i-list-text">10</span>
                            </li>
                            <li>
                                <span class="product-item-bottom-i-list-title">Углеводы</span>
                                <span class="product-item-bottom-i-list-text">20</span>
                            </li>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность на 100гр. продукта</span>
                    </div>
                </div>
                <span class="product-item-price-crossed-out">350 ₽</span>
                <div class="product-item-price-wrapper">
                    <span class="product-item-price-main">249 ₽</span>
                    <span class="product-item-amount">15</span>
                </div>
            </div>
        </div>

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
<script src="js/common.js"></script>
<!--footer scripts end-->
</body>
</html>

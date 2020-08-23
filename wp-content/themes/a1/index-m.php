<?php
/* Template Name: index-m */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Главная - A1</title>

    <script>
        window.mobileAndTabletCheck = function() {
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };

        // console.log(window.mobileAndTabletCheck());

        if(!window.mobileAndTabletCheck()) {
            window.location.href = '/';
        }
    </script>

    <!--header styles start-->
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/main.css">
    <!--header styles end-->
    <?php wp_head(); ?>
</head>
<body>
<div class="main container">
    <header class="header">
        <div class="header_inner_wrapper">
            <img class="header__menu-button" src="<?= get_template_directory_uri(); ?>/img/burger-menu-icon.svg">
            <img class="header__logo" src="<?= get_template_directory_uri(); ?>/img/logo.svg">
        </div>
        <div class="header__login-button">
            <img class="header__login-img" src="<?= get_template_directory_uri(); ?>/img/user-icon.svg">
            <span class="header__login-text">Войти</span>
        </div>
        <!--<div class="header__login-button" style="width: 170px;">
            <img class="header__login-img" src="img/user-icon.svg">
            <span class="header__login-text">+7 (515) 525-66-55</span>
        </div>-->
    </header>
    <div class="search">
        <form action="/" class="search__form">
            <input type="search" name="search" id="search" placeholder="Поиск">
            <button type="submit"><img src="<?= get_template_directory_uri(); ?>/img/search-icon.svg"></button>
        </form>
    </div>
    <div class="filters">
        <div class="filter-item active">
            <?php include "img/sushi-icon.svg" ?>
            <span class="filter-item-text">Суши</span>
        </div>
        <div class="filter-item">
            <?php include "img/pizza-icon.svg" ?>
            <span class="filter-item-text">Пицца</span>
        </div>
        <div class="filter-item">
            <?php include "img/wok-icon.svg" ?>
            <span class="filter-item-text">WOK</span>
        </div>
        <div class="filter-item">
            <?php include "img/soup-icon.svg" ?>
            <span class="filter-item-text">Супы</span>
        </div>
        <div class="filter-item">
            <?php include "img/bakery-icon.svg" ?>
            <span class="filter-item-text">Пироги</span>
        </div>
        <div class="filter-item">
            <?php include "img/second-eat-icon.svg" ?>
            <span class="filter-item-text">Второе</span>
        </div>
    </div>
    <div class="products">
        <div class="product-item">
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
            <img class="product-item-img" src="<?= get_template_directory_uri(); ?>/img/product-img.png">
            <h2 class="product-item-title">Ролл «Филадельфия»</h2>
            <p class="product-item-desc">Идейные соображения высшего порядка, а также начало повседневной работы</p>
            <div class="product-item-bottom">
                <div class="product-item-bottom-i-wrapper">
                    <img class="product-item-bottom-i" src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">
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
    <div class="cart-button-wrapper">
        <div class="cart-button">
            <div class="cart-button-left">
                <img src="<?= get_template_directory_uri(); ?>/img/cart-icon.svg">
                <span>Корзина</span>
            </div>
            <div class="cart-button-right">
                <span>1095 ₽</span>
            </div>
        </div>
    </div>
    <div class="burger-menu">
        <div class="burger-menu__header">
            <img src="<?= get_template_directory_uri(); ?>/img/burger-close.svg" class="burger-menu__close">
            <a href="/"><img src="<?= get_template_directory_uri(); ?>/img/burger-logo.svg" class="burder-menu__logo"></a>
        </div>
        <div class="burger-menu__content">
            <a href="#" class="burger-menu__content-item burger-menu__content-item-first">
                <span><img src="<?= get_template_directory_uri(); ?>/img/user-burger-menu-icon.svg">Привет, Андрей</span>
                <span class="burger-menu__content-item-phone">+7 (989) 852-55-11</span>
            </a>
            <a href="#" class="burger-menu__content-item">
                <span><img src="<?= get_template_directory_uri(); ?>/img/location-icon.svg">г. Омск</span>
            </a>
            <a href="#" class="burger-menu__content-item">
                <span><img src="<?= get_template_directory_uri(); ?>/img/user-agreement-icon.svg">Пользовательское соглашение</span>
            </a>
        </div>
        <div class="burger-menu__button-wrapper">
            <a href="#" class="burger-menu__button">Связаться с нами</a>
        </div>

    </div>
</div>
<!--footer scripts start-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="<?= get_template_directory_uri(); ?>/js/common.js"></script>
<!--footer scripts end-->
<?php wp_footer(); ?>
</body>
</html>

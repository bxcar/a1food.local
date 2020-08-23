<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png"/>
    <title>Личный кабинет - A1</title>

    <script>
        window.mobileAndTabletCheck = function() {
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };

        // console.log(window.mobileAndTabletCheck());

        if(!window.mobileAndTabletCheck()) {
            window.location.href = './orders-desk.php';
        }
    </script>

    <!--header styles start-->
    <link rel="stylesheet" href="css/main.css">
    <!--header styles end-->
</head>
<body>
<div class="main container" style="padding-bottom: 30px;">
    <header class="header-in" style="max-width: none;">
        <div class="header-in__inner-wrapper">
            <a href="#" class="header-in__back"><img src="img/header-in-back.svg"></a>
            <span class="header-in__title">Личный кабинет</span>
        </div>
        <img class="header-in__logo" src="img/header-in-logo.svg">
    </header>

    <div class="cabinet__top-buttons">
        <a href="./cabinet.php" class="cabinet__top-buttons-profile inactive"><?php include "img/cabinet-profile-icon.svg"?>Профиль</a>
        <a href="./orders.php" class="cabinet__top-buttons-orders"><?php include "img/cabinet-cart-icon.svg"?>Заказы</a>
    </div>

    <div class="orders">
        <div class="orders__item order-success">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status green">Доставлен</span>
            </div>
            <div class="orders__item-rating">
                <span class="orders__item-rating-title">Оцените заказ</span>
                <div class="orders__item-rating-stars">
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                    <span><?php include "img/star-icon.svg"?></span>
                </div>
            </div>
            <form action="#" method="post" class="orders__item-feedback">
                <textarea name="feedback" placeholder="Вы можете оставить отзыв"></textarea>
                <img src="img/feedback-icon.svg" class="orders__item-feedback-icon">
                <div class="orders__item-feedback-file-wrapper">
                    <label class="orders__item-feedback-file-image" for="file"><img src="img/input-file-img.svg"></label>
                    <input type="file" name="file" id="file">
                </div>
            </form>
        </div>
        <div class="orders__item">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status yellow">Доставляется</span>
            </div>
        </div>
        <div class="orders__item">
            <div class="orders__item-top-line">
                <span class="orders__item-number">Заказ #9235555-01</span>
                <div class="orders__item-top-line-right">
                    <span class="orders__item-price">2249 ₽</span>
                    <img class="orders__item-close" src="img/order-close.svg">
                </div>
            </div>
            <span class="orders__item-address">ул. Фрунзе 308, офис 401</span>
            <div class="orders__item-bottom-line">
                <span class="orders__item-date">25 мая 2020 г.</span>
                <span class="orders__item-check"><img src="img/get-check-icon.svg"><span>Получить чек</span></span>
                <span class="orders__item-status red">Отменен</span>
            </div>
        </div>
    </div>
</div>
<div class="orders__get-check-popup">
    <span class="orders__get-check-popup-title">Отправка кассового чека</span>
    <form action="#" method="post" class="orders__get-check-popup-form">
        <div class="orders__get-check-popup-form-email-wrapper">
            <input type="email" name="email" id="email" placeholder="Укажите e-mail">
            <img src="img/email-popup-icon.svg" class="orders__get-check-popup-email-image">
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>
<div class="overlay"></div>
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

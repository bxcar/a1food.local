$(document).ready(function () {
	function checkCookie(){
	    var cookieEnabled = navigator.cookieEnabled;
	    if (!cookieEnabled){
	        document.cookie = "testcookie";
	        cookieEnabled = document.cookie.indexOf("testcookie")!=-1;
	    }
	    return cookieEnabled || showCookieFail();
	}

	function showCookieFail(){
	  alert('Для корректной работы сайта необходимо включить cookie-файлы');
	  location.reload();
	}


	// within a window load,dom ready or something like that place your:
	checkCookie();


    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);

    // We listen to the resize event
    window.addEventListener('resize', () => {
        // We execute the same script as before
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    });

    $('.product-item-bottom-i').on('click', function () {
        if($(this).parent().hasClass('active')) {
            $('.product-item-bottom-i-desc').removeClass('active');
            $('.product-item-bottom-i-wrapper').removeClass('active');

            $(this).parent().removeClass('active');
            $(this).parent().parent().parent().find('.product-item-bottom-i-desc').removeClass('active');
        } else {
            $('.product-item-bottom-i-desc').removeClass('active');
            $('.product-item-bottom-i-wrapper').removeClass('active');

            $(this).parent().addClass('active');
            $(this).parent().parent().parent().find('.product-item-bottom-i-desc').addClass('active');
        }
    });

    $('body').click(function(evt){
        if(evt.target.className !== 'product-item-bottom-i-desc'
        && evt.target.className !== 'product-item-bottom-i-list'
        && evt.target.className !== 'product-item-bottom-i-list-title'
        && evt.target.className !== 'product-item-bottom-i-list-text'
        && evt.target.className !== 'product-item-bottom-i-desc-bottom-text'
        && evt.target.className !== 'product-item-bottom-i') {
            $('.product-item-bottom-i-desc').removeClass('active');
            $('.product-item-bottom-i-wrapper').removeClass('active');
        }
    });

    $('.filter-item').on('click', function () {
        $('.filter-item').removeClass('active');
        $(this).addClass('active');
    });

    // left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
    var keys = {37: 1, 38: 1, 39: 1, 40: 1};

    function preventDefault(e) {
        e.preventDefault();
    }

    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
        }
    }

// modern Chrome requires { passive: false } when adding event
    var supportsPassive = false;
    try {
        window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
            get: function () { supportsPassive = true; }
        }));
    } catch(e) {}

    var wheelOpt = supportsPassive ? { passive: false } : false;
    var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
    function disableScroll() {
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
    }

// call this to Enable
    function enableScroll() {
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
        window.removeEventListener('touchmove', preventDefault, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
    }

    $('.header__menu-button').on('click', function () {
        $('.overlay').fadeIn(200);
        $('.overlay').addClass('burger-menu-ov');

        $('.overlay.burger-menu-ov').on('click', function () {
            if($('.contact-popup').css('display') != 'block') {
                $(this).fadeOut(200);
                $(this).removeClass('burger-menu-ov');
                $('.burger-menu').css('left', '-272px');
                enableScroll();
            }
        });

        $('.burger-menu').css('left', 0);
        disableScroll();
    });

    $('.burger-menu__close').on('click', function () {
        if($('.contact-popup').css('display') != 'block') {
            $('.overlay').fadeOut(200);
            $('.overlay.burger-menu-ov').removeClass('burger-menu-ov');
            $('.burger-menu').css('left', '-272px');
            enableScroll();
        }
    });

    //here was the code for checkout, moved to js/checkout-js.php



    //2 here was the code for checkout, moved to checkout-js.php


    $('.page-popup .sl-popup__close').on('click', function (e) {
        $('.slider__item.sl-popup.page-popup').css('display', 'none');
        $('.overlay-sl-popup.page-popup').css('display', 'none');
    });
    $('.hours-popup .sl-popup__close').on('click', function (e) {
        $('.slider__item.sl-popup.hours-popup').css('display', 'none');
        $('.overlay-sl-popup.hours-popup').css('display', 'none');
    });

    $('.contact-popup__item2').on('click', function () {
        $('.contact-popup__item2-wrapper').toggleClass('active');
    });

    $('.contact-popup__item2-subfield').on('click', function () {
        $('.contact-popup__item2-title span').text($(this).text());
        $('.contact-popup__item2-wrapper').toggleClass('active');
        $('.contact-popup input[name="email"]').attr('value', $(this).data('email'));
        $('.contact-popup input[name="user_section"]').attr('value', $(this).text());
    });

    $('.contact-popup__feedback-file').on('click', function () {
        $('.contact-popup input[name="file"]').trigger('click');
    });
    $('.contact-popup__feedback-bottom > img').on('click', function () {
        $('.contact-popup input[name="file"]').trigger('click');
    });

    function readURLcontact(input, extension) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                if((extension === '.jpg') || (extension === '.jpeg') || (extension === '.png')) {
                    $('.contact-popup__feedback-bottom-file-name').css('display', 'none');
                    $('.contact-popup__feedback-bottom > img').attr('src', e.target.result).css('display', 'block');
                } else {
                    $('.contact-popup__feedback-bottom > img').css('display', 'none');
                    $('.contact-popup__feedback-bottom-file-name').text($(input).val().split('\\').pop()).css('display', 'block');
                }

            };

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".contact-popup input[name='file']").change(function() {
        var sFileName = $(this).val();
        var _validFileExtensions = [".jpg", ".jpeg", ".png", ".txt", ".pdf", ".doc", ".docx", ".xlsx", ".xlsm", ".xlsb", ".xltx", ".xltm"];
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                blnValid = true;
                readURLcontact(this, sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase());
                break;
            }
        }

        if (!blnValid) {
            $(this).val('');
            alert('Некорректный формат файла. Разрешенные форматы: jpg, jpeg, png.');
        }
    });

    function close_contact_form() {
        $('.contact-popup').fadeOut(400);
        if(!$('.overlay').hasClass('burger-menu-ov')) {
           $('.overlay').fadeOut(400);
        }

        setTimeout(function () {
            $('.contact-popup__title').html('Связаться<br>с нами').css('margin-bottom', '35px');
            $('.tanks__subtitle').css('display', 'none');
            $('.contact-popup__item1').css('display', 'flex');
            $('.contact-popup__item2-wrapper').css('display', 'block');
            $('.contact-popup__feedback').css('display', 'block');
            $('.contact-popup button[type="submit"]').text('Отправить').off('click');
        }, 500);
    }

    $('.contact-popup-close').on('click', function () {
        close_contact_form();
    });

    $('.contact-popup-button').on('click', function (e) {
        e.preventDefault();
        $('.overlay').fadeIn(400);
        $('.contact-popup').fadeIn(400);
    });

    $('.contact-popup').on('submit', function (e) {
        e.preventDefault();

        var error = false;
        $(this).serializeArray().forEach(function(entry) {
            if((entry['name'] === 'email' || entry['name'] === 'user_section') && !entry['value']) {
                error = true;
            }
        });

        if(error) {
            alert('Выберите тему обращения');
            return;
        }

        var formData =  new FormData(this);

        $.ajax({
            'method': 'POST',
            'dataType': 'json',
            'url': '/wp-content/themes/a1/custom_files_dm/send_contact_form.php',
            'data':  formData,
            'cache': false,
            'contentType': false,
            'processData': false,
            success: function (data) {//success callback
                if(data.success === 'true') {
                    $('.contact-popup__title').text('Спасибо!').css('margin-bottom', '15px');
                    $('.tanks__subtitle').css('display', 'block');
                    $('.contact-popup__item1').css('display', 'none');
                    $('.contact-popup__item2-wrapper').css('display', 'none');
                    $('.contact-popup__feedback').css('display', 'none');
                    $('.contact-popup__feedback textarea').val('');
                    $('.burger-menu').css('left', '-272px');
                    enableScroll();
                    $('.overlay').removeClass('burger-menu-ov');
                    $('.contact-popup button[type="submit"]').text('Закрыть').on('click', function (e) {
                        e.preventDefault();
                        close_contact_form();
                    });
                } else {
                    $('.contact-popup button[type="submit"]').text('Ошибка');
                    console.log(data);
                }
            },
            error: function (data) {
                $('.contact-popup button[type="submit"]').text('Ошибка');
                console.log(data);
            }
        });
    });

});

window.onload = function () {
    $('*').removeClass('animated-background');
};

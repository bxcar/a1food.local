$(document).ready(function () {
    $('.product-item-bottom-i').on('click', function () {
        /*var check_active_class = false;
        if($(this).parent().hasClass('active')) {
            check_active_class = true;
        } else {
            check_active_class = false;
        }
        $('.product-item-bottom-i-wrapper').removeClass('active');
        if(!check_active_class) {
            $(this).parent().addClass('active')
        }*/

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

    $('.header__menu-button').on('click', function () {
        $('.overlay').fadeIn(200);
        $('.burger-menu').css('left', 0);
    });

    $('.burger-menu__close').on('click', function () {
        $('.overlay').fadeOut(200);
        $('.burger-menu').css('left', '-272px');
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
        $('.overlay').fadeOut(400);

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

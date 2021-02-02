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
        $('.burger-menu').css('left', 0);
    });

    $('.burger-menu__close').on('click', function () {
        $('.burger-menu').css('left', '-272px');
    });

    $('.delivery-form__date-main-field').on('click', function () {
        $(this).toggleClass('active');
    });

    $('.delivery-form__date .delivery-form__date-subfield').on('click', function () {
        $('.delivery-form__date .delivery-form__date-main-field-text').text($(this).text());
        $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');

        $('#billing_date').attr('value', $(this).data('date'));
        /*if($('#billing_time').attr('value') === 'Ближайшее') {
            $('#billing_time').attr('value', '12:00');
        }*/

        if($(this).text() != 'Сегодня') {
            if($('.delivery-form__time .delivery-form__date-main-field-text').text() == 'Ближайшее') {
                $('.delivery-form__time .delivery-form__date-main-field-text').text('12:00');
            }
            $('.delivery-form__time .delivery-form__date-subfields').empty();
            var hour = 12;
            var min = 0;
            var current_min = 0;
            for(var i = 0; i < 23; i++) {
                if(min === 0) {
                    current_min = '00';
                } else {
                    current_min = '30';
                    min = -30;
                }
                $('.delivery-form__time .delivery-form__date-subfields').append('<span class="delivery-form__date-subfield" data-time="' + parseInt(hour) + ':' + current_min + ':00">' + parseInt(hour) + ':' + current_min + '</span>');
            hour += 0.5;
            min += 30;
            }

            $('.delivery-form__time .delivery-form__date-subfield').on('click', function () {
                $('.delivery-form__time .delivery-form__date-main-field-text').text($(this).text());
                $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');
                $('#billing_time').attr('value', $(this).data('time'));
            });

        } else {
            location.reload();
        }

    });

    $('.delivery-form__time .delivery-form__date-subfield').on('click', function () {
        $('.delivery-form__time .delivery-form__date-main-field-text').text($(this).text());
        $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');
        $('#billing_time').attr('value', $(this).data('time'));
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(input).parent().parent().find('.orders__item-feedback-img').attr('src', e.target.result).css('display', 'block');
            };

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".orders__item-feedback input[type='file']").change(function() {
        var sFileName = $(this).val();
        var _validFileExtensions = [".jpg", ".jpeg", ".png"];
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                blnValid = true;
                readURL(this);
                break;
            }
        }

        if (!blnValid) {
            $(this).val('');
            alert('Некорректный формат файла. Разрешенные форматы: jpg, jpeg, png.');
        }
    });

    $('.orders__item-feedback').on('submit', function (e) {
        e.preventDefault();
        // var formData = $(this).serialize();
        var formData =  new FormData(document.getElementById("orders__item-feedback"));
        $.ajax({
            'method': 'POST',
            'dataType': 'json',
            'url': '/wp-content/themes/a1/custom_files_dm/add_feedback.php',
            'data':  formData,
            'cache': false,
            'contentType': false,
            'processData': false,
            success: function (data) {//success callback
                if(data.success === 'true') {
                    $('.orders__item-feedback input[type="submit"]').attr('value', 'Отзыв отправлен').prop( "disabled", true );
                    $('.orders__item-feedback textarea').prop( "disabled", true );
                } else {
                    $('.orders__item-feedback input[type="submit"]').attr('value', 'Ошибка');
                    if(data.success === 'invalid_extension') {
                        alert('Некорректный формат файла. Разрешенные форматы: jpg, jpeg, png.')
                    }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('.orders__item-rating-stars.not-chosen span').on('mouseenter', function () {
        $(this).find('svg path').css('fill', '#FFC000');
        $(this).prevAll().find('svg path').css('fill', '#FFC000');
    }).on('mouseleave', function () {
        $(this).find('svg path').css('fill', '#444444');
        $(this).prevAll().find('svg path').css('fill', '#444444');
    }).on('click', function () {
        $('.orders__item-rating-stars span').off('mouseleave').off('mouseenter');
        $(this).parent().parent().parent().find('.orders__item-feedback').slideDown( 500 );
        $('.orders__item-feedback input[name="stars"]').attr('value', $(this).data('star'));
        // $('.orders__item-feedback').submit();
    });

    $('.orders__item-check').on('click', function () {
        $('.overlay').fadeIn(400);
        $('.orders__get-check-popup').fadeIn(400);

        // lock scroll position, but retain settings for later
        var scrollPosition = [
            self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
            self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
        ];
        var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
        html.data('scroll-position', scrollPosition);
        html.data('previous-overflow', html.css('overflow'));
        html.css('overflow', 'hidden');
        window.scrollTo(scrollPosition[0], scrollPosition[1]);


        // un-lock scroll position
        /*var html = jQuery('html');
        var scrollPosition = html.data('scroll-position');
        html.css('overflow', html.data('previous-overflow'));
        window.scrollTo(scrollPosition[0], scrollPosition[1])*/
    });

    $('.delivery-form__address-input').on('click', function (e) {
        $('.delivery-form__address-input').removeClass('active');
        $(this).addClass('active');
    });


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

    $('.contact-popup-close').on('click', function () {
        $('.contact-popup').fadeOut(400);
        $('.overlay').fadeOut(400);
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
                    $('.contact-popup button[type="submit"]').text('Успешно отправлено');
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

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
        $(this).parent().toggleClass('active');
        $(this).parent().parent().parent().find('.product-item-bottom-i-desc').toggleClass('active');
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

    $('.orders__item-rating-stars span').on('mouseenter', function () {
        $(this).find('svg path').css('fill', 'FFC000');
        $(this).prevAll().find('svg path').css('fill', 'FFC000');
    }).on('mouseleave', function () {
        $(this).find('svg path').css('fill', '444444');
        $(this).prevAll().find('svg path').css('fill', '444444');
    }).on('click', function () {
        $('.orders__item-rating-stars span').off('mouseleave').off('mouseenter');
        $(this).parent().parent().parent().find('.orders__item-feedback').slideDown( 500 )
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

    $('#slider').owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        items: 1
    });

    $('.page-popup .sl-popup__close').on('click', function (e) {
        $('.slider__item.sl-popup.page-popup').css('display', 'none');
        $('.overlay-sl-popup.page-popup').css('display', 'none');
    });
    $('.hours-popup .sl-popup__close').on('click', function (e) {
        $('.slider__item.sl-popup.hours-popup').css('display', 'none');
        $('.overlay-sl-popup.hours-popup').css('display', 'none');
    });
});

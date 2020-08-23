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
    });

    $('.delivery-form__time .delivery-form__date-subfield').on('click', function () {
        $('.delivery-form__time .delivery-form__date-main-field-text').text($(this).text());
        $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');
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
    })
});

<script>
    $('.orders__item-close').on('click', function (e) {
        $(this).parent().parent().parent().remove();

        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/delete_order.php',
            dataType: 'json',
            data:
                {
                    'order_id': $(this).data('order-id'),
                },
            success: function (data) {//success callback
                console.log(data);
            },
            error: function (data) {
                console.log('error');
            }
        });
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
        if($(this).parent().hasClass('not-chosen')) {
            $(this).find('svg path').css('fill', '#FFC000');
            $(this).prevAll().find('svg path').css('fill', '#FFC000');
        }
    }).on('mouseleave', function () {
        if($(this).parent().hasClass('not-chosen')) {
            $(this).find('svg path').css('fill', '#444444');
            $(this).prevAll().find('svg path').css('fill', '#444444');
        }
    }).on('click', function () {
        if($(this).parent().hasClass('not-chosen')) {
            $(this).parent().parent().parent().find('.orders__item-feedback').slideDown( 500 );
            $('.orders__item-feedback input[name="stars"]').attr('value', $(this).data('star'));
        }
        $(this).parent().removeClass('not-chosen');
        // $('.orders__item-rating-stars.not-chosen span').off('mouseleave').off('mouseenter');
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
</script>

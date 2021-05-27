<script>
    $('.checkout-submit').on('click', function (e) {
        e.preventDefault();
        if((<?php if(get_field('user_email_field', 'user_' . get_current_user_id())) { echo 'true'; } else { echo 'false'; } ?> &&
        <?php if(get_field('user_addresses_list_field', 'user_' . get_current_user_id())) { echo 'true'; } else { echo 'false'; } ?>)
        || ($('#temporary-email-field').hasClass('correct') && <?php if(get_field('user_addresses_list_field', 'user_' . get_current_user_id())) { echo 'true'; } else { echo 'false'; } ?>)) {
            $('form.woocommerce-checkout').submit();
        } else {
            alert('Заполните все необходимые поля для оформления заказа');
        }
    });

    $('.checkout-cards-right__apple-pay').on('click', function (e) {
        e.preventDefault();
        $('form.woocommerce-checkout').submit();
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $('#temporary-email-field').on('input', function() {
        if (validateEmail($(this).val())) {
            $(this).css('border', '2px solid #3F9B48');
            $(this).addClass('correct');

            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/custom_files_dm/add_email.php',
                dataType: 'json',
                data:
                    {
                        'contact-email': $(this).val(),
                    },
                success: function (data) {//success callback
                    console.log(data);
                },
                error: function (data) {
                    console.log('error');
                }
            });

        } else {
            $(this).css('border', '2px solid #FF0303');
        }
    });

    // $('#billing_address_1').attr('value', $('#address-1').attr('value'));
    $('#billing_city').attr('value', 'Омск');
    $('#billing_street').attr('value', $('#address-1').data('street'));
    $('#billing_home').attr('value', $('#address-1').data('home'));

    if($('#address-1').data('pod')) {
        $('#billing_pod').attr('value', $('#address-1').data('pod'));
    } else {
    	$('#billing_pod').attr('value', '');
    }

    if($('#address-1').data('et')) {
        $('#billing_et').attr('value', $('#address-1').data('et'));
    } else {
    	$('#billing_et').attr('value', '');
    }

    if($('#address-1').data('apart')) {
        $('#billing_apart').attr('value', $('#address-1').data('apart'));
    } else {
    	$('#billing_apart').attr('value', '');
    }

    if($('#address-1').data('comment')) {
        $('#billing_comment').val($('#address-1').data('comment'));
    } else {
        $('#billing_comment').val('');
    }

    $('.delivery-form__address-input').on('click', function (e) {
        // $('#billing_address_1').attr('value', $(this).attr('value'));
        $('#billing_street').attr('value', $(this).data('street'));
        $('#billing_home').attr('value', $(this).data('home'));

        if($(this).data('pod')) {
            $('#billing_pod').attr('value', $(this).data('pod'));
        } else {
        	$('#billing_pod').attr('value', '');
        }

        if($(this).data('et')) {
            $('#billing_et').attr('value', $(this).data('et'));
        } else {
        	$('#billing_et').attr('value', '');
        }

        if($(this).data('apart')) {
            $('#billing_apart').attr('value', $(this).data('apart'));
        } else {
        	$('#billing_apart').attr('value', '');
        }

        if($(this).data('comment')) {
            $('#billing_comment').val($(this).data('comment'));
        } else {
            $('#billing_comment').val('');
        }

    });

    <?php if(get_field('user_name_field', 'user_' . get_current_user_id())) { ?>
    $('#billing_first_name').attr('value', '<?= get_field('user_name_field', 'user_' . get_current_user_id()); ?>');
    <?php } else { ?>
    $('#billing_first_name').attr('value', 'Имя не задано');
    <?php } ?>

    $('#billing_phone').attr('value', '<?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?>');
    $('#billing_date').attr('value', '<?php
        if($current_hour > $non_working_hours_array['lastHour']) {
            $diff = 24 - $non_working_hours_array['lastHour'] + 1;
            $diff_sec = $diff * 3600;
            echo date('Y-m-d', time()+$diff_sec);
        } else {
            echo date('Y-m-d', time());
        } ?>');
    $('#billing_time').attr('value', '<?= $full_time_line_for_js_in_the_bottom ?>');
    $('#billing_asap_time').attr('value', '1');


    $('.delivery-form__date-main-field').on('click', function () {
        $(this).toggleClass('active');
    });


    $('.delivery-form__date .delivery-form__date-subfield').on('click', function () {
        $('.delivery-form__date .delivery-form__date-main-field-text').html($(this).html());
        $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');

        $('#billing_date').attr('value', $(this).data('date'));
        $('#billing_asap_time').attr('value', '0');
        document.cookie = "billing_date=" + $(this).data('date');
        document.cookie = "billing_date_text=" + $(this).find('.plain-text').text();
        /*if($('#billing_time').attr('value') === 'Ближайшее') {
            $('#billing_time').attr('value', '12:00');
        }*/

        if($(this).find('.plain-text').text() != 'Сегодня') {
            // console.log($(this).find('.plain-text').text());
            if(($('.delivery-form__time .delivery-form__date-main-field-text .plain-text').text() == 'Ближайшее') && !getCookie('billing_time')) {
                let hour = <?= $non_working_hours_array['startHour'] ?> + 1;
                $('.delivery-form__time .delivery-form__date-main-field-text').text(hour + ':00');
                $('#billing_time').attr('value', hour + ':00:00');
                document.cookie = "billing_time=" + hour + ":00:00";
            }
            $('.delivery-form__time .delivery-form__date-subfields').empty();
            var hour = <?= $non_working_hours_array['startHour'] ?> + 1;
            var min = 0;
            var current_min = 0;
            for(var i = 0; i <= <?= $non_working_hours_array['lastHour'] ?>; i++) {
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
                $('.delivery-form__time .delivery-form__date-main-field-text').html($(this).html());
                $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');
                $('#billing_time').attr('value', $(this).data('time'));
                document.cookie = "billing_time=" + $(this).data('time');
            });

            if(getCookie('billing_time')) {
            	if ($('.delivery-form__time .delivery-form__date-subfield[data-time="' + getCookie('billing_time') + '"]').length > 0) {
            		$('.delivery-form__time .delivery-form__date-subfield[data-time="' + getCookie('billing_time') + '"]').trigger('click');
		    		$('.delivery-form__time .delivery-form__date-main-field.active').removeClass('active');
				} else {
                    let hour = <?= $non_working_hours_array['startHour'] ?> + 1;
					$('.delivery-form__time .delivery-form__date-main-field-text').text(hour + ':00');
                	$('#billing_time').attr('value', hour + ':00:00');
                	document.cookie = "billing_time=" + hour + ":00:00";
				}
		    }

        } else {
        	// eraseCookie('billing_time');
            // setTimeout(function(){location.reload();},10);
            function refresh() {
                var url = location.origin;
                var pathname = location.pathname;
                var hash = location.hash;

                location = url + pathname + '?application_refresh=' + (Math.random() * 100000) + hash;
            }
            refresh();
        }

    });


    $('.delivery-form__time .delivery-form__date-subfield').on('click', function () {
        $('.delivery-form__time .delivery-form__date-main-field-text').html($(this).html());
        $(this).parent().parent().find('.delivery-form__date-main-field').toggleClass('active');
        $('#billing_time').attr('value', $(this).data('time'));
        document.cookie = "billing_time=" + $(this).data('time');
        if($(this).find('.plain-text').text() == 'Ближайшее') {
            $('#billing_asap_time').attr('value', '1');
        } else {
            $('#billing_asap_time').attr('value', '0');
        }
    });

    $('.delivery-form__address-input').on('click', function (e) {
        $('.delivery-form__address-input').removeClass('active');
        $(this).addClass('active');
    });

    function getCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}

	function eraseCookie(name) {
	    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}

    <?php
    if(!($current_hour <= $non_working_hours_array['lastHour'] && $current_hour >= $non_working_hours_array['startHour'])) { ?>
        if($('.delivery-form__time .delivery-form__date-main-field-text').text() === 'Ближайшее') {
            $('.delivery-form__time .delivery-form__date-subfield:first-child').trigger('click');
        }
    <?php } ?>

    let billing_date_cookie = new Date(getCookie('billing_date'));
    let first_actual_date = new Date($('.delivery-form__date .delivery-form__date-subfield:first-child').attr('data-date'));

    if(billing_date_cookie < first_actual_date) {
        document.cookie = "billing_date=" + $('.delivery-form__date .delivery-form__date-subfield:first-child').attr('data-date');
    }

    if(getCookie('billing_date') && (getCookie('billing_date_text') != 'Сегодня')) {
    	$('.delivery-form__date .delivery-form__date-subfield[data-date="' + getCookie('billing_date') + '"]').trigger('click');
    	$('.delivery-form__date .delivery-form__date-main-field.active').removeClass('active');
    }

    if(getCookie('billing_time') && (getCookie('billing_date_text') == 'Сегодня')) {
    	$('.delivery-form__time .delivery-form__date-subfield[data-time="' + getCookie('billing_time') + '"]').trigger('click');
    	$('.delivery-form__time .delivery-form__date-main-field.active').removeClass('active');
    }

</script>

<script>
    $('.checkout-submit').on('click', function (e) {
        e.preventDefault();
        $('form.woocommerce-checkout').submit();
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
    }
    if($('#address-1').data('et')) {
        $('#billing_et').attr('value', $('#address-1').data('et'));
    }
    if($('#address-1').data('apart')) {
        $('#billing_apart').attr('value', $('#address-1').data('apart'));
    }

    $('.delivery-form__address-input').on('click', function (e) {
        // $('#billing_address_1').attr('value', $(this).attr('value'));
        $('#billing_street').attr('value', $(this).data('street'));
        $('#billing_home').attr('value', $(this).data('home'));
        if($(this).data('pod')) {
            $('#billing_pod').attr('value', $(this).data('pod'));
        }
        if($(this).data('et')) {
            $('#billing_et').attr('value', $(this).data('et'));
        }
        if($(this).data('apart')) {
            $('#billing_apart').attr('value', $(this).data('apart'));
        }
    });

    <?php if(get_field('user_name_field', 'user_' . get_current_user_id())) { ?>
    $('#billing_first_name').attr('value', '<?= get_field('user_name_field', 'user_' . get_current_user_id()); ?>');
    <?php } else { ?>
    $('#billing_first_name').attr('value', 'Имя не задано');
    <?php } ?>

    $('#billing_phone').attr('value', '<?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?>');
    $('#billing_date').attr('value', '<?php
        if($current_hour >= 23) {
            echo date('Y-m-d', time()+3600);
        } else {
            echo date('Y-m-d', time());
        } ?>');
    $('#billing_time').attr('value', '<?= $full_time_line_for_js_in_the_bottom ?>');

</script>

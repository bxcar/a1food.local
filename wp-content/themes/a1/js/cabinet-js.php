<script>
    $('.remove_address').on('click', function (e) {
        $(this).parent().remove();
        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/remove_address.php',
            dataType: 'json',
            data:
                {
                    'row_number': $(this).parent().find('input').data('address-number')
                },
            success: function (data) {//success callback
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $('[name="contact-email"]').on('input', function() {
        if (validateEmail($(this).val())) {
            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/custom_files_dm/cabinet_ajax_save.php',
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
        }
    });

    $('[name="birth-date"]').on('keyup', function() {
        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/cabinet_ajax_save.php',
            dataType: 'json',
            data:
                {
                    'birth-date': $(this).val(),
                },
            success: function (data) {//success callback
                console.log(data);
            },
            error: function (data) {
                console.log('error');
            }
        });
    });

    $('[name="contact-name"]').on('input', function() {
        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/cabinet_ajax_save.php',
            dataType: 'json',
            data:
                {
                    'contact-name': $(this).val(),
                },
            success: function (data) {//success callback
                console.log(data);
            },
            error: function (data) {
                console.log('error');
            }
        });
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
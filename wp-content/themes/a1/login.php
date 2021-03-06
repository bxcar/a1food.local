<?php
/* Template Name: login-mobile */
require_once 'header_mobile.php';
if (is_user_logged_in()) { ?>
    <script>
        window.location.href = "/cabinet-mobile";
    </script>
<?php }
?>

    <img class="login__logo" style="max-width: 93px;" src="<?= get_field('logo_field', 'option') ?>">
    <span class="login__title">Пожалуйста, укажите номер телефона</span>

    <form action="#" method="post" class="login__form1" autocomplete="off">
        <input autocomplete="off" type="text" class="login__form1-number animated-background" name="number" id="phone" placeholder="номер телефона" required pattern="+7 (999) 999-99-99">
        <span class="login__form1-number-before animated-background">+7</span>
        <button type="submit"><span class="animated-background">Получить код</span></button>
    </form>
    <form action="#" method="post" class="login__form2" autocomplete="off">
        <input autocomplete="off" type="text" class="login__form2-code animated-background" name="code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Код из sms" required>
        <button type="submit"><span class="animated-background" onclick="ym(77765119, 'reachGoal', 'click_register'); return true;">Далее</span></button>
    </form>

    <p class="login__agreement animated-background">Нажимая на кнопку «Далее», вы принимаете<br>условия <a href="/offer-mobile">оферты</a></p>

    </div>


    <script>
        $('.login__form1').on('submit', function (e) {
            e.preventDefault();
            $('.login__form1 button').text('Ожидайте смс').prop('disabled', true);
            var phone_mask = $("#phone");
            var phone_format = '7'+phone_mask.val().replace(/[^0-9]/g, '');
            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/smpptest.php',
                dataType: 'json',
                data:
                    {
                        'phone': phone_format
                    },
                success: function (data) {//success callback
                    // console.log('success');
                },
                error: function (data) {
                    $('.login__form1 button').text('Ошибка').prop('disabled', true);
                    // console.log(data);
                }
            });
        });


        $('.login__form2').on('submit', function (e) {
            e.preventDefault();
            var usercode = $('input[name="code"]').val();
            var user_phone_format = '+7 ' + $("#phone").val();
            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/custom_files_dm/create_or_login_user.php',
                dataType: 'json',
                data:
                    {
                        'user_phone': $("#phone").val().replace(/[^0-9]/g, ''),
                        'user_phone_format': user_phone_format,
                        'usercode': usercode
                    },
                success: function (data) {//success callback
                    fbq('track', 'CompleteRegistration');

                    var url_string = window.location.href;
                    var url = new URL(url_string);
                    // var order = url.searchParams.get("order");
                    var redirect = url.searchParams.get("redirect");
                    if(redirect) {
                        window.location.href = redirect;
                    } else {
                        window.location.href = "/cabinet-mobile";
                    }

                },
                error: function (data) {
                    $('.login__form2 button').text('Ошибка');
                    setTimeout(function(){ $('.login__form2 button').text('Далее') }, 3000);
                    // console.log(data);
                }
            });
        });
    </script>

<?php
require_once 'footer_mobile.php';

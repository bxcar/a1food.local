<?php
/* Template Name: login-mobile */
require_once 'header_mobile.php';
if (is_user_logged_in()) { ?>
    <script>
        window.location.href = "/cabinet-mobile";
    </script>
<?php }
?>

    <img class="login__logo" src="<?= get_template_directory_uri(); ?>/img/payment3_logo.svg">
    <span class="login__title">Пожалуйста, укажите номер телефона</span>

    <form action="#" method="post" class="login__form1">
        <input type="text" class="login__form1-number animated-background" name="number" id="phone" placeholder="номер телефона" required pattern="+7 (999) 999-99-99">
        <span class="login__form1-number-before animated-background">+7</span>
        <button type="submit"><span class="animated-background">Получить код</span></button>
    </form>
    <form action="#" method="post" class="login__form2">
        <input type="text" class="login__form2-code animated-background" name="code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Код из sms" required>
        <button type="submit"><span class="animated-background">Далее</span></button>
    </form>

    <p class="login__agreement animated-background">Нажимая на кнопку «Далее», вы принимаете<br>условия <a href="/offer-mobile">оферты</a></p>

    </div>


    <script>
        function setCookie(cname, cvalue, exmin) {
            var d = new Date();
            d.setTime(d.getTime() + (exmin*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        $('.login__form1').on('submit', function (e) {
            e.preventDefault();
            $('.login__form1 button').text('Ожидайте смс').prop('disabled', true);
            var random_code = Math.floor(Math.random()*(999-100+1)+100);
            setCookie('authcode', random_code, 10);
            var phone_mask = $("#phone");
            var phone_format = '7'+phone_mask.val().replace(/[^0-9]/g, '');
            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/smpptest.php',
                dataType: 'json',
                data:
                    {
                        'code': random_code,
                        'phone': phone_format
                    },
                success: function (data) {//success callback
                    console.log('success');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });


        $('.login__form2').on('submit', function (e) {
            e.preventDefault();
            var authcode = getCookie('authcode');
            var usercode = $('input[name="code"]').val();
            if(authcode != "" && authcode == usercode) {
                var user_phone_format = '+7 ' + $("#phone").val();
                $.ajax({
                    type: 'post',
                    url: '/wp-content/themes/a1/custom_files_dm/create_or_login_user.php',
                    dataType: 'json',
                    data:
                        {
                            'user_phone': $("#phone").val().replace(/[^0-9]/g, ''),
                            'user_phone_format': user_phone_format
                        },
                    success: function (data) {//success callback
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
                        console.log(data);
                    }
                });
            } else {
                $('.login__form2 button').text('Ошибка');
                setTimeout(function(){ $('.login__form2 button').text('Далее') }, 3000);
            }
        });
    </script>

<?php
require_once 'footer_mobile.php';

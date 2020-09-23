<?php
/* Template Name: login-desk */
get_header();
if(is_user_logged_in()) { ?>
    <script>
        window.location.href = "/cabinet";
    </script>
<?php }
?>
    <div class="login__form-wrapper">
        <span class="login__form-wrapper__title">Мы вас не узнали</span>
        <span class="login__title">Пожалуйста, укажите номер телефона</span>

        <form action="#" method="post" class="login__form1">
            <input type="text" class="login__form1-number" name="number" id="phone" placeholder="номер телефона" required pattern="+7 (999) 999-99-99">
            <span class="login__form1-number-before">+7</span>
            <button type="submit">Получить код</button>
        </form>
        <form action="#" method="post" class="login__form2">
            <input type="number" class="login__form2-code" name="code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Код из sms" required pattern="999">
            <button type="submit">Далее</button>
        </form>

        <p class="login__agreement">Нажимая на кнопку, вы принимаете условия<br> <a href="#">пользовательского соглашения</a></p>
    </div>


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
        setCookie('authcode', Math.floor(Math.random()*(999-100+1)+100), 10);
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
                    window.location.href = "/cabinet";
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

<?php get_footer(); ?>

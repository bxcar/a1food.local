<?php
/* Template Name: login-desk */
get_header();
?>
    <div class="login__form-wrapper">
        <span class="login__form-wrapper__title">Мы вас не узнали</span>
        <span class="login__title">Пожалуйста, укажите номер телефона</span>

        <form action="#" method="post" class="login__form1">
            <input type="text" class="login__form1-number" name="number" id="phone" placeholder="номер телефона">
            <span class="login__form1-number-before">+7</span>
            <button type="submit">Получить код</button>
        </form>
        <form action="#" method="post" class="login__form2">
            <input type="text" class="login__form2-code" name="code" placeholder="Код из sms">
            <button type="submit">Далее</button>
        </form>

        <p class="login__agreement">Нажимая на кнопку, вы принимаете условия<br> <a href="#">пользовательского соглашения</a></p>
    </div>


</div>

<?php get_footer(); ?>

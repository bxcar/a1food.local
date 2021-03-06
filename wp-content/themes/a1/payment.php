<?php
/* Template Name: payment-mobile */
require_once 'header_mobile.php';
?>
    <span class="payment__price-title">1 095 ₽</span>
    <span class="payment__price-subtitle">Итого к оплате</span>

    <span class="payment__methods-title">Оплата в один клик</span>
    <div class="payment__methods">
        <a href="#"><img src="<?= get_template_directory_uri(); ?>/img/apple-pay-icon.svg"></a>
        <a href="#"><img src="<?= get_template_directory_uri(); ?>/img/samsung-pay-icon.svg"></a>
        <a href="#"><img src="<?= get_template_directory_uri(); ?>/img/google-pay-icon.svg"></a>
    </div>

    <span class="payment__card-title">Оплата картой</span>

    <!--<form action="#" method="post" class="payment__card">
        <span class="payment__card-number-title">Номер карты:</span>
        <div class="payment__card-example-numbers">
            <input type="number" name="card_number_1" placeholder="5469" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <input type="number" name="card_number_2" placeholder="5469" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <input type="number" name="card_number_3" placeholder="5469" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <input type="number" name="card_number_4" placeholder="5469" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>
        <div class="payment__card-terms">
            <span class="payment__card-terms-title">Срок действия:</span>
            <div class="payment__card-terms-values-wrapper">
                <input name="term_value_month" type="number" class="payment__card-terms-value" placeholder="12" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                <span class="payment__card-terms-slash">/</span>
                <input name="term_value_year" type="number" class="payment__card-terms-value" placeholder="21" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            </div>
        </div>
        <span class="payment__card-holder-label">Имя:</span>
        <input type="text" placeholder="IVANOV IVAN IVANOVICH" name="card_holder_name" class="payment__card-holder-name">
        <div class="payment__card-bottom-block">
            <div class="payment__card-bottom-block-1">
                <span>Принимаем к оплате:</span>
                <div>
                    <img src="<?/*= get_template_directory_uri(); */?>/img/visa-icon.svg">
                    <img src="<?/*= get_template_directory_uri(); */?>/img/mastercard-icon.svg">
                    <img src="<?/*= get_template_directory_uri(); */?>/img/mir-icon.svg">
                </div>
            </div>
            <div class="payment__card-bottom-block-2">
                <span>CVC/CVV:</span>
                <input type="number" name="cvv" placeholder="***" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            </div>
        </div>
        <div class="payment__card-save-card">
            <label class="payment__card-save-card-container">Сохранить карту
                <input type="checkbox" checked="checked" name="save_card">
                <span class="checkmark"></span>
            </label>
        </div>
    </form>-->


    <div class="cart-button-wrapper">
        <div class="cart-button cart-button-2">
            <div class="cart-button-left">
                <span>Оплатить</span>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'footer_mobile.php';

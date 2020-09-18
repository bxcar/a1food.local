<?php
/* Template Name: cabinet-desk */
get_header();

$address_counter = 1;

if(isset($_POST['contact-name'])) {
    update_field('user_name_field', $_POST['contact-name'], 'user_'.get_current_user_id());
}

if(isset($_POST['birth-date'])) {
    update_field('user_birth_date_field', $_POST['birth-date'], 'user_'.get_current_user_id());
}


if(isset($_POST['contact-email'])) {
    update_field('user_email_field', $_POST['contact-email'], 'user_'.get_current_user_id());
}

if(isset($_POST['addresses-amount'])) {
    $i = 1;
    for(; $i <= $_POST['addresses-amount']; $i++) {
        if(!isset($_POST['address-'.$i])) {
            delete_row('user_addresses_list_field', $i, 'user_'.get_current_user_id());
        }
    }
}


?>

    <div class="cabinet__title-wrapper">
        <h1 class="cabinet__title">Личный кабинет</h1>
        <a href="<?php echo wp_logout_url('/login'); ?>" class="cabinet_logout"><img src="<?= get_template_directory_uri(); ?>/img/logout.png"></a>
    </div>

    <div class="cabinet__top-buttons">
        <a href="" class="cabinet__top-buttons-profile"><?php include "img/cabinet-profile-icon.svg"?>Профиль</a>
        <a href="./orders-desk.php" class="cabinet__top-buttons-orders inactive"><?php include "img/cabinet-cart-icon.svg"?>Заказы</a>
    </div>

    <form action="<?php the_permalink(); ?>" method="post" class="cabinet__profile-form">
        <div class="cabinet__profile-form-phone"><input type="text" name="phone" id="phone-cabinet" placeholder="+7 (555) 555-55-55" value="<?= get_field('user_phone_field', 'user_'.get_current_user_id()); ?>" disabled></div>
        <div class="cabinet__profile-form-name"><input type="text" name="contact-name" placeholder="Укажите имя" value="<?= get_field('user_name_field', 'user_'.get_current_user_id()); ?>"></div>
        <div class="cabinet__profile-form-birth-date"><input type="text" name="birth-date" id="birth-date" placeholder="Укажите дату рождения" value="<?= get_field('user_birth_date_field', 'user_'.get_current_user_id()); ?>"></div>
        <div class="cabinet__profile-form-email"><input type="email" name="contact-email" placeholder="Укажите e-mail для чеков" value="<?= get_field('user_email_field', 'user_'.get_current_user_id()); ?>"></div>
        <?php if(get_field('user_addresses_list_field', 'user_'.get_current_user_id())) {
            foreach (get_field('user_addresses_list_field', 'user_'.get_current_user_id()) as $item) { ?>
                <div class="cabinet__profile-form-address"><input type="text" name="address-<?= $address_counter ?>" placeholder="ул. Фрунзе 308, офис 401" value="<?= $item['address'] ?>" readonly><span class="remove_address"></span></div>
            <?php $address_counter++; }
        } ?>
        <input type="hidden" name="addresses-amount" value="<?= $address_counter-1 ?>">
        <span class="cabinet__profile-form-add-address">Добавить адрес</span>
        <button type="submit" class="cabinet__profile-form-add-address" style="margin-top: 14px; border: none; outline: none;">Сохранить</button>
    </form>
</div>

<script>
    $('.remove_address').on('click', function (e) {
        $(this).parent().remove();
    })
</script>

<?php get_footer() ?>

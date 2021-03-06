<?php
/* Template Name: cabinet-desk */
get_header();

if(!is_user_logged_in()) { ?>
    <script>
        window.location.href="/login";
    </script>
<?php }

 $address_counter = 1;

/*if (isset($_POST['contact-name'])) {
    update_field('user_name_field', $_POST['contact-name'], 'user_' . get_current_user_id());
}*/

/*if (isset($_POST['birth-date'])) {
    update_field('user_birth_date_field', $_POST['birth-date'], 'user_' . get_current_user_id());
}*/


/*if (isset($_POST['contact-email'])) {
    update_field('user_email_field', $_POST['contact-email'], 'user_' . get_current_user_id());
    $args = array(
        'ID'         => get_current_user_id(),
        'user_email' => $_POST['contact-email']
    );
    wp_update_user( $args );
}*/

/*if (isset($_POST['addresses-amount'])) {
    $ix = 0;
    for ($i = 1; $i <= $_POST['addresses-amount']; $i++) {
        if (!isset($_POST['address-' . $i])) {
            delete_row('user_addresses_list_field', $i-$ix, 'user_' . get_current_user_id());
            $ix++;
        }
    }
}*/


?>

<div class="cabinet__title-wrapper">
    <h1 class="cabinet__title animated-background">Личный кабинет</h1>
    <a href="<?php echo wp_logout_url('/login'); ?>" class="cabinet_logout animated-background"><img
                src="<?= get_template_directory_uri(); ?>/img/logout.png"></a>
</div>

<div class="cabinet__top-buttons">
    <a href="" class="cabinet__top-buttons-profile animated-background"><?php include "img/cabinet-profile-icon.svg" ?>Профиль</a>
    <a href="/orders"
       class="cabinet__top-buttons-orders inactive animated-background"><?php include "img/cabinet-cart-icon.svg" ?>Заказы</a>
</div>

<form action="<?php the_permalink(); ?>" method="post" class="cabinet__profile-form">
    <div class="cabinet__profile-form-phone"><input class="animated-background" type="text" name="phone" id="phone-cabinet"
                                                    placeholder="+7 (555) 555-55-55"
                                                    value="<?= get_field('user_phone_field', 'user_' . get_current_user_id()); ?>"
                                                    disabled></div>
    <div class="cabinet__profile-form-name"><input class="animated-background" type="text" name="contact-name" placeholder="Укажите имя"
                                                   value="<?= get_field('user_name_field', 'user_' . get_current_user_id()); ?>">
    </div>
    <div class="cabinet__profile-form-birth-date"><input class="animated-background" type="text" name="birth-date" id="birth-date"
                                                         placeholder="Укажите дату рождения"
                                                         value="<?= get_field('user_birth_date_field', 'user_' . get_current_user_id()); ?>">
    </div>
    <div class="cabinet__profile-form-email"><input class="animated-background" type="email" name="contact-email"
                                                    placeholder="Укажите e-mail для чеков"
                                                    value="<?= get_field('user_email_field', 'user_' . get_current_user_id()); ?>">
    </div>
    <?php if (get_field('user_addresses_list_field', 'user_' . get_current_user_id())) {
        foreach (get_field('user_addresses_list_field', 'user_' . get_current_user_id()) as $item) { ?>
            <div class="cabinet__profile-form-address"><input class="animated-background" type="text" data-address-number="<?= $address_counter ?>" name="address-<?php /*$address_counter*/ ?>"
                                                              placeholder="ул. Фрунзе 308, офис 401"
                                                              value="<?= 'ул. ' . $item['street'] . ' ' . $item['building'] ?>
<?php if ($item['entrance']) {
                                                                  echo ', под. ' . $item['entrance'];
                                                              }
                                                              if ($item['floor']) {
                                                                  echo ', эт. ' . $item['floor'];
                                                              }
                                                              if ($item['apartment']) {
                                                                  echo ', кв./офис ' . $item['apartment'];
                                                              }

                                                              if ($item['comment']) {
                                                                  echo ' (' . $item['comment'] . ')';
                                                              }
                                                              ?>" readonly><span class="remove_address"></span></div>
            <?php $address_counter++;
        }
    } ?>
<!--    <input type="hidden" name="addresses-amount" value="--><?php //$address_counter - 1 ?><!--">-->
    <a href="/address" class="cabinet__profile-form-add-address animated-background">Добавить адрес</a>
    <!-- <button type="submit" class="cabinet__profile-form-add-address animated-background"
            style="margin-top: 14px; border: none; outline: none;">Сохранить
    </button> -->
</form>
</div>

<?php include "js/cabinet-js.php"; ?>

<?php get_footer() ?>

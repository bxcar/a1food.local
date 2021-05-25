<?php
/* Template Name: index-m */
require_once 'header_mobile.php';
?>
    <header class="header">
        <div class="header_inner_wrapper animated-background">
            <img class="header__menu-button" src="<?= get_template_directory_uri(); ?>/img/burger-menu-icon.svg">
            <img class="header__logo" src="<?= get_template_directory_uri(); ?>/img/logo.svg">
        </div>

        <?php if(is_user_logged_in()) { ?>
            <a href="/cabinet-mobile" class="header__login-button animated-background">
                <img class="header__login-img" src="<?= get_template_directory_uri(); ?>/img/user-icon.svg">
                <?php if(get_field('user_name_field', 'user_'.get_current_user_id())) { ?>
                    <span class="header__login-text"><?= get_field('user_name_field', 'user_'.get_current_user_id()); ?></span>
                <?php } else { ?>
                    <span class="header__login-text"><?= get_field('user_phone_field', 'user_'.get_current_user_id()); ?></span>
                <?php } ?>
            </a>
        <?php } else {
            $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            ?>
            <a href="/login-mobile?redirect=<?= $current_link ?>" class="header__login-button animated-background">
                <img class="header__login-img" src="<?= get_template_directory_uri(); ?>/img/user-icon.svg">
                <span class="header__login-text">Войти</span>
            </a>
        <?php } ?>
    </header>
<?php
if (get_field('search_line', 'option')) { ?>
    <div class="search animated-background">
        <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>"
              class="search__form searchform">
            <input autocomplete="off" type="search" name="s" id="search" placeholder="Поиск">
            <button type="submit"><img src="<?= get_template_directory_uri(); ?>/img/search-icon.svg"></button>
        </form>
    </div>
<?php }
?>
    <div class="filters">
        <?php
        global $wp_query;
        $current_product_cat_id =  $wp_query->get_queried_object()->term_id;
        if($current_product_cat_id) {
            $_GET['category_id'] = $current_product_cat_id;
        }

        $categories = get_categories([
            'taxonomy' => 'product_cat',
            'hide_empty' => 0
        ]);

        $i = 0;
        $first_cat_id = 0;
        $first_cat_name = '';

        if ($categories) {
            foreach ($categories as $cat) {
                $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
                $cat_image_link = wp_get_attachment_url($thumbnail_id);
                if ($i == 0) {

                    if (isset($_GET['category_id'])) {
                        $first_cat_id = $_GET['category_id'];
                        $first_cat_name = get_term_by('id', $_GET['category_id'], 'product_cat')->name;
                    } else {
                        $first_cat_id = $cat->cat_ID;
                        $first_cat_name = $cat->name;
                    }
                    ?>
                <?php } ?>
                <a href="/m?category_id=<?= $cat->cat_ID ?>" class="filter-item animated-background <?php
                if (isset($_GET['category_id'])) {
                    if ($cat->cat_ID == $_GET['category_id']) {
                        echo 'active';
                    }
                } elseif ($i == 0) {
                    echo 'active';
                }

                ?>" data-catid="<?= $cat->cat_ID ?>">
                    <?php if ($cat_image_link) {
                        echo file_get_contents("$cat_image_link");
                    } ?>
                    <span class="filter-item-text"><?= $cat->name ?></span>
                </a>
                <?php $i++;
            }
        }
        ?>
    </div>
<?php
if (isset($_GET['category_id'])) {
    $count = get_term_by('id', $_GET['category_id'], 'product_cat')->count;
} else {
    $count = get_term_by('id', $first_cat_id, 'product_cat')->count;
}
?>
    <div class="products">
        <?php
        $args = array(
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
        	'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $first_cat_id
                )
            )
        );

        $i = 1;

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post(); ?>
                <div class="product-item animated-background" style="position: relative">
                    <img class="product-item-img"
                         src="<?= get_the_post_thumbnail_url() ?>">
                    <h2 class="product-item-title"><?php the_title(); ?></h2>
                    <p class="product-item-desc"><?= get_the_content(); ?></p>
                    <div class="product-item-bottom">
                        <div class="product-item-bottom-i-wrapper">
                            <img class="product-item-bottom-i"
                                 src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">


                        </div>
                        <?php
                        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
                        if (get_post_meta(get_the_ID(), '_sale_price', true)) {
                            $sale_price = get_post_meta(get_the_ID(), '_sale_price', true); ?>
                            <span class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?></span>
                        <?php } else {
                            $sale_price = $regular_price; ?>
                            <span style="visibility: hidden; opacity: 0; height: 0;"
                                  class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?></span>
                        <?php }
                        ?>
                        <a href="<?= get_site_url(); ?>?add-to-cart=<?= get_the_ID(); ?>" class="product-item-price-wrapper"
                           data-id="<?= get_the_ID(); ?>">
                            <span class="product-item-price-main"><?= $sale_price ?></span>
                            <?php
                            // Usage as a condition in an if statement
                            if (0 < woo_is_in_cart(get_the_ID())) { ?>
                                <span class="product-item-amount"><?= woo_is_in_cart(get_the_ID()) ?></span>
                            <?php } else { ?>
                                <span class="product-item-amount" style="display: none;"></span>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="product-item-bottom-i-desc">
                        <ul class="product-item-bottom-i-list">
                            <?php if (get_field('popap')) {
                                foreach (get_field('popap') as $item) { ?>
                                    <li>
                                        <span class="product-item-bottom-i-list-title"><?= $item['title'] ?></span>
                                        <span class="product-item-bottom-i-list-text"><?= $item['value'] ?></span>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность<br> на 100гр. продукта</span>
                    </div>
                </div>
                <?php
                if ($query->found_posts % 2 != 0) {
                    if ($i == $query->found_posts) {
                        while ($i % 2 != 0) { ?>
                            <div class="product-item" style="position: relative; visibility: hidden; opacity: 0;">
                                <img class="product-item-img"
                                     src="<?= get_the_post_thumbnail_url() ?>">
                                <h2 class="product-item-title"><?php the_title(); ?></h2>
                                <p class="product-item-desc"><?= get_the_content(); ?></p>
                                <div class="product-item-bottom">
                                    <div class="product-item-bottom-i-wrapper">
                                        <img class="product-item-bottom-i"
                                             src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">


                                    </div>
                                    <span class="product-item-price-crossed-out">350</span>
                                    <div class="product-item-price-wrapper">
                                        <span class="product-item-price-main">249</span>
                                        <span class="product-item-amount">15</span>
                                    </div>
                                </div>
                                <div class="product-item-bottom-i-desc">
                                    <ul class="product-item-bottom-i-list">
                                        <?php if (get_field('popap')) {
                                            foreach (get_field('popap') as $item) { ?>
                                                <li>
                                                    <span class="product-item-bottom-i-list-title"><?= $item['title'] ?></span>
                                                    <span class="product-item-bottom-i-list-text"><?= $item['value'] ?></span>
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>
                                    <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность<br> на 100гр. продукта</span>
                                </div>
                            </div>
                            <?php $i++;
                        }
                    }
                }
                $i++;
            }
        }
        // Возвращаем оригинальные данные поста. Сбрасываем $post.
        wp_reset_postdata();
        ?>
    </div>
    <a href="/cart-mobile" class="cart-button-wrapper animated-background">
        <div class="cart-button">
            <div class="cart-button-left">
                <img src="<?= get_template_directory_uri(); ?>/img/cart-icon.svg">
                <span>Корзина</span>
            </div>
            <div class="cart-button-right">
                <span>0</span>
            </div>
        </div>
    </a>
<?php
require_once 'footer_mobile.php';


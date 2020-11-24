<?php get_header(); ?>
<div class="search animated-background">
    <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search__form searchform">
        <input autocomplete="off" type="search" name="s" id="search" placeholder="Поиск" value="<?= get_search_query() ?>">
        <button type="submit"><img src="<?= get_template_directory_uri(); ?>/img/search-icon.svg"></button>
    </form>
</div>

<h1 class="main__title animated-background">Результаты поиска по запросу: <span><?= get_search_query() ?></span></h1>
<div class="products">
    <?php

    $i = 1;

    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
            <div class="product-item animated-background" style="position: relative">
                <img class="product-item-img"
                     src="<?= get_template_directory_uri(); ?>/img/product-img-desk.png">
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
                        <span class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?> ₽</span>
                    <?php } else {
                        $sale_price = $regular_price; ?>
                        <span style="visibility: hidden; opacity: 0; height: 0;"
                              class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?> ₽</span>
                    <?php }
                    ?>
                    <a href="<?= get_site_url(); ?>?add-to-cart=<?= get_the_ID(); ?>" class="product-item-price-wrapper"
                       data-id="<?= get_the_ID(); ?>">
                        <span class="product-item-price-main"><?= $sale_price ?> ₽</span>
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
            global $wp_query;
            if($wp_query->found_posts % 4 != 0) {
                if($i == $wp_query->found_posts) {
                    while($i % 4 != 0) { ?>
                        <div class="product-item" style="position: relative; visibility: hidden; opacity: 0;">
                            <img class="product-item-img"
                                 src="<?= get_template_directory_uri(); ?>/img/product-img-desk.png">
                            <h2 class="product-item-title"><?php the_title(); ?></h2>
                            <p class="product-item-desc"><?= get_the_content(); ?></p>
                            <div class="product-item-bottom">
                                <div class="product-item-bottom-i-wrapper">
                                    <img class="product-item-bottom-i"
                                         src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">


                                </div>
                                <span class="product-item-price-crossed-out">350 ₽</span>
                                <div class="product-item-price-wrapper">
                                    <span class="product-item-price-main">249 ₽</span>
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
            $i++; }
    }
    // Возвращаем оригинальные данные поста. Сбрасываем $post.
    wp_reset_postdata();
    ?>
</div>

<div class="burger-menu">
    <div class="burger-menu__header">
        <img src="<?= get_template_directory_uri(); ?>/img/burger-close.svg" class="burger-menu__close">
        <a href="/"><img src="<?= get_template_directory_uri(); ?>/img/burger-logo.svg"
                         class="burder-menu__logo"></a>
    </div>
    <div class="burger-menu__content">
        <a href="#" class="burger-menu__content-item burger-menu__content-item-first">
            <span><img src="<?= get_template_directory_uri(); ?>/img/user-burger-menu-icon.svg">Привет, Андрей</span>
            <span class="burger-menu__content-item-phone">+7 (989) 852-55-11</span>
        </a>
        <a href="#" class="burger-menu__content-item">
            <span><img src="<?= get_template_directory_uri(); ?>/img/location-icon.svg">г. Омск</span>
        </a>
        <a href="#" class="burger-menu__content-item">
            <span><img src="<?= get_template_directory_uri(); ?>/img/user-agreement-icon.svg">Пользовательское соглашение</span>
        </a>
    </div>
    <div class="burger-menu__button-wrapper">
        <a href="#" class="burger-menu__button">Связаться с нами</a>
    </div>

</div>
</div>
<?php get_footer(); ?>

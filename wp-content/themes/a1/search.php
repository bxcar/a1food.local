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
                                 src="<?= get_the_post_thumbnail_url() ?>">
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

<script>
    function updateURLParameter(url, param, paramVal)
    {
        var TheAnchor = null;
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";

        if (additionalURL)
        {
            var tmpAnchor = additionalURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
            if(TheAnchor)
                additionalURL = TheParams;

            tempArray = additionalURL.split("&");

            for (var i=0; i<tempArray.length; i++)
            {
                if(tempArray[i].split('=')[0] != param)
                {
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }
        else
        {
            var tmpAnchor = baseURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor  = tmpAnchor[1];

            if(TheParams)
                baseURL = TheParams;
        }

        if(TheAnchor)
            paramVal += "#" + TheAnchor;

        var rows_txt = temp + "" + param + "=" + paramVal;
        return baseURL + "?" + newAdditionalURL + rows_txt;
    }

    $('#search').on('input', function() {
        var $this = $(this);
        $.ajax({
            type: 'post',
            url: '/wp-content/themes/a1/custom_files_dm/search_ajax.php',
            dataType: 'json',
            data:
                {
                    'search_query': $(this).val(),
                },
            success: function (data) {//success callback
                $('.products').empty();

                $('.main__title span').text($this.val());
                window.history.replaceState('', '', updateURLParameter(window.location.href, "s", $this.val()));

                var demo_posts_amount = 4 - (data.amount_of_posts % 4);
                if(demo_posts_amount == 4) {
                    demo_posts_amount = 0;
                }

                data.posts_array.forEach(function(entry) {

                    var popap_data = '';
                    if(entry['popap']) {
                        entry['popap'].forEach(function(entry2) {
                            let title = '<li><span class="product-item-bottom-i-list-title">'+ entry2.title +'</span>';
                            let text = '<span class="product-item-bottom-i-list-text">'+ entry2.value +'</span></li>';
                            popap_data = popap_data.concat(title);
                            popap_data = popap_data.concat(text);
                        });
                    }

                    $('.products').append('<div class="product-item" style="position: relative">' +
                        '    <img class="product-item-img"' +
                        '         src="' + entry.img +'">' +
                        '    <h2 class="product-item-title">' + entry.title +'</h2>' +
                        '    <p class="product-item-desc">' + entry.desc +'</p>' +
                        '    <div class="product-item-bottom">' +
                        '        <div class="product-item-bottom-i-wrapper">' +
                        '            <img class="product-item-bottom-i"' +
                        '                 src="<?= get_template_directory_uri(); ?>/img/info-icon.svg">\n' +
                        '        </div>' +
                                 entry.product_item_price_crossed_out +
                        '        <a href="<?= get_site_url(); ?>?add-to-cart=' + entry.id +'" class="product-item-price-wrapper"' +
                        '           data-id="' + entry.id +'">' +
                        '            <span class="product-item-price-main">' + entry.sale_price +' ₽</span>' + entry.product_item_amount +'' +
                        '        </a>' +
                        '    </div>' +
                        '    <div class="product-item-bottom-i-desc">' +
                        '        <ul class="product-item-bottom-i-list">' + popap_data +'</ul>' +
                        '        <span class="product-item-bottom-i-desc-bottom-text">Пищевая ценность<br> на 100гр. продукта</span>' +
                        '    </div>' +
                        '</div>');
                });

                for(let i = 0; i <  demo_posts_amount; i++) {
                    $('.products').append('<div class="product-item" style="position: relative;  visibility: hidden; opacity: 0;"></div>');
                }

                $('.product-item-bottom-i').on('click', function () {
                    if($(this).parent().hasClass('active')) {
                        $('.product-item-bottom-i-desc').removeClass('active');
                        $('.product-item-bottom-i-wrapper').removeClass('active');

                        $(this).parent().removeClass('active');
                        $(this).parent().parent().parent().find('.product-item-bottom-i-desc').removeClass('active');
                    } else {
                        $('.product-item-bottom-i-desc').removeClass('active');
                        $('.product-item-bottom-i-wrapper').removeClass('active');

                        $(this).parent().addClass('active');
                        $(this).parent().parent().parent().find('.product-item-bottom-i-desc').addClass('active');
                    }
                });

                $('.product-item-price-wrapper').on('click', function (e) {
                    e.preventDefault();
                    var data_id = $(this).data('id');

                    var $this = $(this);

                    $.ajax({
                        type: 'post',
                        url: '/wp-content/themes/a1/custom_files_dm/add_to_cart.php',
                        dataType: 'json',
                        data:
                            {
                                'product_id': $(this).attr('data-id')
                            },
                        success: function (data) {//success callback
                            // console.log('success');
                            $this.find('.product-item-amount').css('display', 'flex');
                            var items_amount = $this.find('.product-item-amount').text();
                            if (!items_amount) {
                                items_amount = 0;
                            }
                            $this.find('.product-item-amount').text(parseInt(items_amount) + 1);

                            $('.header__cart-button span').text((data.cart_total) + ' ₽');

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });

                });

            },
            error: function (data) {
                console.log('error');
            }
        });

    });
</script>
<?php get_footer(); ?>

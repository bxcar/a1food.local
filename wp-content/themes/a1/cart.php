<?php
/* Template Name: cart-mobile */
require_once 'header_mobile.php';
//the_content();
?>

    <div class="cart-products">
        <?php
        date_default_timezone_set('Asia/Omsk');
        $day = date('w', strtotime(date('m/d/Y', time())));
        $hour = date('G', time());

        $day = getDayNumberForTable($day);

        if($hour < 12) {
            $hour = 12;
        }

        $delivery_current_time_price = get_field('delivery_price_by_hours', 'option')['body'][$day][$hour]['c'];
        $delivery_current_time_price = getDeliveryPriceNonWorkingHours($delivery_current_time_price, $day);

        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $cart_total_price = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            //product image
            $getProductDetail = wc_get_product($values['product_id']);
            if(get_post_meta($values['product_id'], '_sale_price', true)) {
                $total_price = get_post_meta($values['product_id'], '_sale_price', true) * $values['quantity'];
            } else {
                $total_price = get_post_meta($values['product_id'], '_regular_price', true) * $values['quantity'];
            }
            $cart_item_remove_url = wc_get_cart_remove_url( $item );
            $cart_total_price =  WC()->cart->cart_contents_total;

            $delivery = 0;
            if(($cart_total_price < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) {
                $delivery = (int)$delivery_current_time_price;
            }

            ?>
            <div class="cart-products__item animated-background" data-key="<?= $item ?>" data-id="<?= $values['product_id'] ?>">
                <div class="cart-products__item-wrapper1">
                    <a href="<?= $cart_item_remove_url ?>" class="cart-products__item-remove"><img src="<?= get_template_directory_uri(); ?>/img/cart-product-remove.svg"></a>
                    <img src="<?= get_the_post_thumbnail_url($values['product_id']) ?>" class="cart-products__item-image">
                    <div class="cart-products__item-title-wrapper">
                        <span class="cart-products__item-title"><?= $_product->get_title() ?></span>
                        <span class="cart-products__item-title-bottom"><?= get_field('weight', $values['product_id']) ?> х <span><?= $values['quantity'] ?></span> шт.</span>
                    </div>
                </div>
                <div class="cart-products__item-wrapper2">
                    <div class="cart-products__item-price-wrapper">
                        <span class="cart-products__item-price"><span><?= $total_price ?></span></span>
                        <div class="cart-products__item-amount-change">
                            <img src="<?= get_template_directory_uri(); ?>/img/less.svg" class="less">
                            <span class="amount"><?= $values['quantity'] ?></span>
                            <img src="<?= get_template_directory_uri(); ?>/img/more.svg" class="more">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
    <div class="cart-delivery animated-background">
        <div class="cart-delivery__left-wrapper">
            <span class="cart-delivery__title">Доставка</span>
            <?php if(($cart_total_price < get_field('free_delivery_min_price', 'option')) && get_field('free_delivery_min_price_logic', 'option')) {
                $difference = get_field('free_delivery_min_price', 'option') - $cart_total_price; ?>
                <span class="cart-delivery__title-bottom">Закажите еще на <span><?= $difference ?></span>р для бесплатной доставки</span>
            <?php } else if(get_field('free_delivery_min_price_logic', 'option')) { ?>
                <span class="cart-delivery__title-bottom" style="display: none;">Закажите еще на <span></span>р для бесплатной доставки</span>
            <?php } ?>
        </div>
        <?php if(($cart_total_price < get_field('free_delivery_min_price', 'option')) || !get_field('free_delivery_min_price_logic', 'option')) { ?>
            <span class="cart-delivery__price"><?= $delivery_current_time_price; ?></span>
        <?php } else { ?>
            <span class="cart-delivery__price">Бесплатно</span>
        <?php } ?>
    </div>

<?php if(get_field('option_upsale_logic', 'option')) { ?>
    <div class="cart-gift animated-background">
        <div class="cart-gift__left-wrapper">
            <span class="cart-gift__title">Подарок: <?= get_field('option_upsale_gift', 'option') ?></span>
            <?php if($cart_total_price < get_field('option_upsale', 'option')) {
                $difference = get_field('option_upsale', 'option') - $cart_total_price; ?>
                <span class="cart-gift__title-bottom">Закажите еще на <span><?= $difference ?></span>р, чтобы получить подарок</span>
            <?php } else { ?>
                <span class="cart-gift__title-bottom" style="display: none;">Закажите еще на <span></span>р, чтобы получить подарок</span>
            <?php } ?>
        </div>
        <?php if($cart_total_price < get_field('option_upsale', 'option')) { ?>
            <span class="cart-gift__price"><img src="<?= get_template_directory_uri() ?>/img/no-gift.svg"></span>
        <?php } else { ?>
            <span class="cart-gift__price"><img src="<?= get_template_directory_uri() ?>/img/gift-check.svg"></span>
        <?php } ?>
    </div>
<?php } ?>


    <div class="cart-promo">
        <div class="cart-promo__title animated-background">Введите промокод если есть:</div>
        <form method="post" action="#" class="cart-promo-form animated-background">
            <input type="text" name="promo" id="promo" placeholder="6136316136136" maxlength="13">
            <span class="promo-error">Промокод введен неверно</span>
            <span class="promo-success">Промокод активирован</span>
            <input type="submit">
        </form>
        <!--<div class="cart-promo__title  animated-background">Введите промокод если есть</div>
        <form method="post" action="#" class="cart-promo-form">
            <input type="text" name="promo" id="promo" placeholder="6136316136136">
            <input type="submit">
        </form>-->
    </div>
    <!--<div class="cart-minimum-order-price">
        <span><img src="<?/*= get_template_directory_uri(); */?>/img/cart-i.svg">Минимальная сумма заказа 500р</span>
    </div>-->
<?php
if((($cart_total_price) < get_field('min_order_price', 'option')) && get_field('min_order_price_logic', 'option')) { ?>
    <div class="cart-minimum-order-price" style="display: flex">
        <span><img src="<?= get_template_directory_uri(); ?>/img/cart-i.svg">Минимальная сумма заказа <?= get_field('min_order_price', 'option'); ?>р</span>
    </div>
<?php } else if(get_field('min_order_price_logic', 'option')) { ?>
    <div class="cart-minimum-order-price" style="display: none;">
        <span><img src="<?= get_template_directory_uri(); ?>/img/cart-i.svg">Минимальная сумма заказа <?= get_field('min_order_price', 'option'); ?>р</span>
    </div>
<?php }
?>
    <!--<div class="cart-recommend">
        <span>Рекомендуем</span>
    </div>-->

    <?php if(get_field('rec_products', 'option')) {
    $myarray = array();
    foreach (get_field('rec_products', 'option') as $item) {
        array_push($myarray, $item['product_item']);
    }

    ?>
    <div class="cart-recommend animated-background" style="margin-bottom: 13px;">
        <span>Рекомендуем</span>
    </div>

    <div class="products">
        <?php
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'product',
            'post__in' => $myarray,
            'orderby' => 'post__in'
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
                        if(get_post_meta(get_the_ID(), '_sale_price', true)) {
                            $sale_price = get_post_meta(get_the_ID(), '_sale_price', true); ?>
                            <span class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?></span>
                        <?php } else {
                            $sale_price = $regular_price; ?>
                            <span style="visibility: hidden; opacity: 0; height: 0;" class="product-item-price-crossed-out"><?= get_post_meta(get_the_ID(), '_regular_price', true) ?></span>
                        <?php }
                        ?>
                        <a href="<?= get_site_url(); ?>?add-to-cart=<?= get_the_ID(); ?>" onclick="ym(77765119, 'reachGoal', 'click_add_cart'); fbq('track', 'AddToCart'); return true;" class="product-item-price-wrapper" data-id="<?= get_the_ID(); ?>">
                            <span class="product-item-price-main"><?= $sale_price ?></span>
                            <?php
                            // Usage as a condition in an if statement
                            if( 0 < woo_is_in_cart(get_the_ID()) ){ ?>
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
                if($query->found_posts % 4 != 0) {
                    if($i == $query->found_posts) {
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
                $i++; }
        }
        // Возвращаем оригинальные данные поста. Сбрасываем $post.
        wp_reset_postdata();
        ?>

    </div>
<?php }?>

    <a style="text-decoration: none;" onclick="ym(77765119, 'reachGoal', 'click_cart_checkout'); fbq('track', 'InitiateCheckout'); return true;" class="cart-button-wrapper animated-background"
        <?php
        if((($cart_total_price) < get_field('min_order_price', 'option')) && get_field('min_order_price_logic', 'option')) {
            echo 'href=""';
        } else {
            echo 'href="/checkout-mobile"';
        }
        ?>>
        <div class="cart-button">
            <div class="cart-button-left">
                <img src="<?= get_template_directory_uri(); ?>/img/cart-icon.svg">
                <span>Оформить заказ</span>
            </div>
            <div class="cart-button-right">
                <span><?= number_format(((int)$cart_total_price + (int)$delivery), 0, '.', ' ') ?> руб.</span>
            </div>
        </div>
    </a>
</div>
    <script>
        function calculateDelivery(cartTotal) {
            var cart_total = cartTotal;

            if((cart_total >= <?= get_field('free_delivery_min_price', 'option') ?>) && '<?= get_field('free_delivery_min_price_logic', 'option') ?>') {
                $('.cart-delivery__title-bottom').css('display', 'none');
                $('.cart-delivery__price').text('Бесплатно');
            } else {
                var difference_delivery_price = <?= get_field('free_delivery_min_price', 'option') ?> - cart_total;
                $('.cart-delivery__title-bottom').css('display', 'block');
                $('.cart-delivery__title-bottom span').text(difference_delivery_price);
                $('.cart-delivery__price').text("<?= $delivery_current_time_price; ?>");
            }
        }

        function calculateGift(cartTotal) {
            var cart_total = cartTotal;

            if(cart_total >= <?= get_field('option_upsale', 'option') ?>) {
                $('.cart-gift__title-bottom').css('display', 'none');
                $('.cart-gift__price').html('<img src="<?= get_template_directory_uri() ?>/img/gift-check.svg">');
            } else {
                var difference_gift_price = <?= get_field('option_upsale', 'option') ?> - cart_total;
                $('.cart-gift__title-bottom').css('display', 'block');
                $('.cart-gift__title-bottom span').text(difference_gift_price);
                $('.cart-gift__price').html('<img src="<?= get_template_directory_uri() ?>/img/no-gift.svg">');
            }
        }

        function calculateTotalItemPrice(amount='more', product_quantity = 0, $this) {
            var current_total_price = parseInt($this.parent().parent().find('.cart-products__item-price span').text());
            var current_item_price = current_total_price/product_quantity;
            var new_price = '';
            if(amount === 'more') {
                new_price = current_item_price * (product_quantity+1);
            } else {
                new_price = current_item_price * (product_quantity-1);
            }
            $this.parent().parent().find('.cart-products__item-price span').text(new_price);
        }

        function updateQuantityInCartDatabase($this) {
            $.ajax({
                type: 'post',
                url: '/wp-content/themes/a1/custom_files_dm/change_cart_item_quantity.php',
                dataType: 'json',
                data:
                    {
                        'cart_item_key': $this.parent().parent().parent().parent().attr('data-key'),
                        'quantity': parseInt($this.parent().find('.amount').text())
                    },
                success: function (data) {//success callback
                    $('.cart-button-right span').text(numberWithSpaces(data.cart_total) + ' руб.');
                    // $('.header__cart-button span').text(numberWithSpaces(data.cart_total) + '');
                    if((data.cart_total_without_delivery < <?= get_field('min_order_price', 'option'); ?>) && '<?= get_field('min_order_price_logic', 'option'); ?>') {
                        $('.cart-minimum-order-price').css('display', 'flex');
                        $('.cart-button-wrapper').attr('href', '');
                    } else {
                        $('.cart-minimum-order-price').css('display', 'none');
                        $('.cart-button-wrapper').attr('href', '/checkout-mobile');
                    }
                    calculateDelivery(data.cart_total_without_delivery);
                    calculateGift(data.cart_total_without_delivery);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        $('.less').on('click', function (e) {
            var product_quantity = parseInt($(this).parent().find('.amount').text());
            if(product_quantity > 1) {
                $(this).parent().find('.amount').text(product_quantity-1);
                $(this).parent().parent().parent().parent().find('.cart-products__item-title-bottom span').text(product_quantity-1);

                calculateTotalItemPrice('less', product_quantity, $(this));
            }

            updateQuantityInCartDatabase($(this));
            $('.product-item-price-wrapper[data-id="' + $(this).parent().parent().parent().parent().data('id') + '"]').find('.product-item-amount').text($(this).parent().find('.amount').text());
            // calculateDelivery();

        });
        $('.more').on('click', function (e) {
            console.log('more');
            var product_quantity = parseInt($(this).parent().find('.amount').text());
            $(this).parent().find('.amount').text(product_quantity+1);
            $(this).parent().parent().parent().parent().find('.cart-products__item-title-bottom span').text(product_quantity+1);

            calculateTotalItemPrice('more', product_quantity, $(this));
            updateQuantityInCartDatabase($(this));

            $('.product-item-price-wrapper[data-id="' + $(this).parent().parent().parent().parent().data('id') + '"]').find('.product-item-amount').text(parseInt($(this).parent().find('.amount').text()));
            // calculateDelivery();

        });

        var is_input_was_full = false;

        $('#promo').on('input', function() {
            if (this.value.length == 13) {
                $.ajax({
                    type: 'post',
                    url: '/wp-content/themes/a1/custom_files_dm/check_coupon_is_valid.php',
                    dataType: 'json',
                    data:
                        {
                            'coupon': $(this).val(),
                        },
                    success: function (data) {//success callback
                        console.log(data);
                        if(data.coupon == 'valid') {
                            $('#promo').css('border', '1px solid #3F9B48');
                            $('.promo-success').css('display', 'block');
                            $('.promo-error').css('display', 'none');
                            $('.cart-button-right span').text(numberWithSpaces(data.cart_total) + ' руб.');
                            $('.header__cart-button span').text(numberWithSpaces(data.cart_total) + '');
                        } else {
                            $('#promo').css('border', '1px solid #FF0303');
                            $('.promo-success').css('display', 'none');
                            $('.promo-error').css('display', 'block');
                        }
                        calculateDelivery(data.cart_total_without_delivery);
                        if((data.cart_total_without_delivery < <?= get_field('min_order_price', 'option'); ?>) && '<?= get_field('min_order_price_logic', 'option'); ?>') {
                            $('.cart-minimum-order-price').css('display', 'flex');
                            $('.cart-button-wrapper').attr('href', '');
                        } else {
                            $('.cart-minimum-order-price').css('display', 'none');
                            $('.cart-button-wrapper').attr('href', '/checkout-mobile');
                        }
                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
                is_input_was_full = true;
            } else if(is_input_was_full) {
                $('#promo').css('border', '1px solid #FF0303');
                $('.promo-success').css('display', 'none');
                $('.promo-error').css('display', 'block');
            }
        });

    </script>
<?php
require_once 'footer_mobile.php';

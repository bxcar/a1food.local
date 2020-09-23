<?php
/* Template Name: cart-desk */
get_header();
the_content();
?>
    <div class="cart-products">
        <?php
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $cart_total_price = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            //product image
            $getProductDetail = wc_get_product($values['product_id']);
//            echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )
//            echo get_the_post_thumbnail_url($values['product_id']);

//            echo "<b>" . $_product->get_title() . '</b>  <br> Quantity: ' . $values['quantity'] . '<br>';
//            $price = get_post_meta($values['product_id'], '_price', true);
//            echo "  Price: " . $price . "<br>";
            /*Regular Price and Sale Price*/
//            echo "Regular Price: " . get_post_meta($values['product_id'], '_regular_price', true) . "<br>";
//            echo "Sale Price: " . get_post_meta($values['product_id'], '_sale_price', true) . "<br>";
            $total_price = get_post_meta($values['product_id'], '_sale_price', true) * $values['quantity'];
            $cart_item_remove_url = wc_get_cart_remove_url( $item );
            $cart_total_price =  WC()->cart->cart_contents_total;

            $delivery = 0;
            if($cart_total_price < get_field('free_delivery_min_price', 'option')) {
                $delivery = (int)get_field('delivery_price', 'option');
            }

            ?>
            <div class="cart-products__item" data-key="<?= $item ?>">
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
                        <span class="cart-products__item-price"><span><?= $total_price ?></span> ₽</span>
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
    <div class="cart-delivery">
        <div class="cart-delivery__left-wrapper">
            <span class="cart-delivery__title">Доставка</span>
            <?php if($cart_total_price < get_field('free_delivery_min_price', 'option')) {
                $difference = get_field('free_delivery_min_price', 'option') - $cart_total_price; ?>
                <span class="cart-delivery__title-bottom">Закажите еще на <span><?= $difference ?></span>р для бесплатной доставки</span>
            <?php } else { ?>
                <span class="cart-delivery__title-bottom" style="display: none;">Закажите еще на <span></span>р для бесплатной доставки</span>
            <?php } ?>
        </div>
        <?php if($cart_total_price < get_field('free_delivery_min_price', 'option')) { ?>
            <span class="cart-delivery__price"><?= get_field('delivery_price', 'option'); ?> ₽</span>
        <?php } else { ?>
            <span class="cart-delivery__price">Бесплатно</span>
        <?php } ?>
    </div>
    <div class="cart-promo">
        <div class="cart-promo__title">Введите промокод если есть:</div>
        <form method="post" action="#" class="cart-promo-form">
            <input type="text" name="promo" id="promo" placeholder="6136316136136">
            <input type="submit">
        </form>
    </div>
    <div class="cart-button-desktop">
        <div class="cart-button-desktop-left">
            <img src="<?= get_template_directory_uri(); ?>/img/cart-icon.svg">
            <span>Оформить заказ</span>
        </div>
        <div class="cart-button-desktop-right">
            <span><?= (int)$cart_total_price + (int)$delivery ?> ₽</span>
        </div>
    </div>
    <div class="cart-minimum-order-price">
        <span><img src="<?= get_template_directory_uri(); ?>/img/cart-i.svg">Минимальная сумма заказа 500р</span>
    </div>
    <div class="cart-recommend">
        <span>Рекомендуем</span>
    </div>

    <div class="products">
        <?php
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'product'
        );

        $i = 1;

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post(); ?>
                <div class="product-item" style="position: relative">
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
                        <a href="<?= get_site_url(); ?>?add-to-cart=<?= get_the_ID(); ?>" class="product-item-price-wrapper" data-id="<?= get_the_ID(); ?>">
                            <span class="product-item-price-main">249 ₽</span>
                            <span class="product-item-amount">15</span>
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
</div>
<script>
    function calculateDelivery() {
        var cart_total = 0;
        $(".cart-products__item").each(function( index ) {
            cart_total +=  parseInt($(this).find('.cart-products__item-price span').text());
        });

        if(cart_total >= <?= get_field('free_delivery_min_price', 'option') ?>) {
            $('.cart-delivery__title-bottom').css('display', 'none');
            $('.cart-delivery__price').text('Бесплатно');
        } else {
            var difference_delivery_price = <?= get_field('free_delivery_min_price', 'option') ?> - cart_total;
            $('.cart-delivery__title-bottom').css('display', 'block');
            $('.cart-delivery__title-bottom span').text(difference_delivery_price);
            $('.cart-delivery__price').text("<?= get_field('delivery_price', 'option'); ?> ₽");
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
                $('.cart-button-desktop-right span').text(data.cart_total + ' ₽');
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

        calculateDelivery();
        updateQuantityInCartDatabase($(this));

    });
    $('.more').on('click', function (e) {
        var product_quantity = parseInt($(this).parent().find('.amount').text());
        $(this).parent().find('.amount').text(product_quantity+1);
        $(this).parent().parent().parent().parent().find('.cart-products__item-title-bottom span').text(product_quantity+1);

        calculateTotalItemPrice('more', product_quantity, $(this));
        calculateDelivery();
        updateQuantityInCartDatabase($(this));

    });
</script>
<?php get_footer(); ?>

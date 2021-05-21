<?php
/**
 * a1 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package a1
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'a1_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function a1_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on a1, use a find and replace
		 * to change 'a1' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'a1', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'a1' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'a1_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'a1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'a1_content_width', 640 );
}
add_action( 'after_setup_theme', 'a1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a1_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'a1' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'a1' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'a1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function a1_scripts() {
	wp_enqueue_style( 'a1-style', get_stylesheet_uri(), array(), _S_VERSION );
//	wp_style_add_data( 'a1-style', 'rtl', 'replace' );

	/*wp_enqueue_script( 'a1-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );*/

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'a1_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
/*if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}*/

//Exclude pages from WordPress Search
if (!is_admin()) {
    function wpb_search_filter($query) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
    add_filter('pre_get_posts','wpb_search_filter');
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme General Settings'),
            'menu_title'    => __('Theme Settings'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

// This will suppress empty email errors when submitting the user form
add_action('user_profile_update_errors', 'my_user_profile_update_errors', 10, 3 );
function my_user_profile_update_errors($errors, $update, $user) {
    $errors->remove('empty_email');
}

// This will remove javascript required validation for email input
// It will also remove the '(required)' text in the label
// Works for new user, user profile and edit user forms
add_action('user_new_form', 'my_user_new_form', 10, 1);
add_action('show_user_profile', 'my_user_new_form', 10, 1);
add_action('edit_user_profile', 'my_user_new_form', 10, 1);
function my_user_new_form($form_type) {
    ?>
    <script type="text/javascript">
        jQuery('#email').closest('tr').removeClass('form-required').find('.description').remove();
        // Uncheck send new user email option by default
        <?php if (isset($form_type) && $form_type === 'add-new-user') : ?>
        jQuery('#send_user_notification').removeAttr('checked');
        <?php endif; ?>
    </script>
    <?php
}

function woo_is_in_cart($product_id) {
    global $woocommerce;
    foreach($woocommerce->cart->get_cart() as $key => $val ) {
        $_product = $val['data'];
        if($product_id == $_product->get_id() ) {
            return $val['quantity'];
        }
    }
    return 0;
}

//add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );

function custom_remove_woo_checkout_fields( $fields ) {
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_state']);
//    unset($fields['billing']['billing_country']);
//    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_email']);
//    $fields['billing']['billing_first_name']['default'] = "Thomas";
    return $fields;
}


//'wc-pending' 'wc-processing'  'wc-on-hold' 'wc-completed' 'wc-cancelled' 'wc-refunded' 'wc-failed'
function so_39252649_remove_processing_status( $statuses ){
    /*if( isset( $statuses['wc-pending'] ) ){
        unset( $statuses['wc-pending'] );
    }*/

    if( isset( $statuses['wc-refunded'] ) ){
        unset( $statuses['wc-refunded'] );
    }

    if( isset( $statuses['wc-failed'] ) ){
        unset( $statuses['wc-failed'] );
    }

    /*$statuses['wc-processing'] = 'Принят';
    $statuses['wc-on-hold'] = 'Доставляется';
    $statuses['wc-completed'] = 'Доставлен';
    $statuses['wc-cancelled'] = 'Отменен';*/

    $statuses['wc-pending'] = 'Принят';
    $statuses['wc-processing'] = 'Готовится';
    $statuses['wc-on-hold'] = 'Доставляется';
    $statuses['wc-completed'] = 'Доставлен';
    $statuses['wc-cancelled'] = 'Отменен';

    return $statuses;
}
add_filter( 'wc_order_statuses', 'so_39252649_remove_processing_status' );

function get_month_title($date_month) {
    if($date_month == 1) {
        $date_month = 'января';
    } else if($date_month == 2) {
        $date_month = 'февраля';
    } else if($date_month == 3) {
        $date_month = 'марта';
    } else if($date_month == 4) {
        $date_month = 'апреля';
    } else if($date_month == 5) {
        $date_month = 'мая';
    } else if($date_month == 6) {
        $date_month = 'июня';
    } else if($date_month == 7) {
        $date_month = 'июля';
    } else if($date_month == 8) {
        $date_month = 'августа';
    } else if($date_month == 9) {
        $date_month = 'сентября';
    } else if($date_month == 10) {
        $date_month = 'октября';
    } else if($date_month == 11) {
        $date_month = 'ноября';
    } else if($date_month == 12) {
        $date_month = 'декабря';
    }

    return $date_month;
}

function get_order_status_title($order_status) {
    if($order_status == 'pending') {
        $order_status = 'Принят';
    } else if($order_status == 'processing') {
        $order_status = 'Готовится';
    } else if($order_status == 'on-hold') {
        $order_status = 'Доставляется';
    } else if($order_status == 'completed') {
        $order_status = 'Доставлен';
    } else {
        $order_status = 'Отменен';
    }

    return $order_status;
}

/*add_filter( 'woocommerce_checkout_create_order', 'mbm_alter_shipping', 10, 1 );
function mbm_alter_shipping ($order) {

    $order_data = $order->get_data(); // The Order data

    $order_id = $order_data['id'];

    $current_numbers_of_orders =  get_field('number_of_orders', 'user_' . get_current_user_id());
    update_field('number_of_orders', $current_numbers_of_orders+1, 'user_' . get_current_user_id());
    update_field('order_number_for_current_customer', $current_numbers_of_orders+1, $order_id);

    return $order;
}*/

/*$hook_to = 'woocommerce_thankyou';
$what_to_hook = 'wl8OrderPlacedTriggerSomething';
$prioriy = 111;
$num_of_arg = 1;
add_action($hook_to, $what_to_hook, $prioriy, $num_of_arg);

function wl8OrderPlacedTriggerSomething($order_id){
    $current_number_of_orders =  get_field('number_of_orders', 'user_' . get_current_user_id());
    $new_number_of_orders = $current_number_of_orders + 1;
    if($new_number_of_orders <= 9) {
        $new_number_of_orders = '0' . $new_number_of_orders;
    }
    update_field('number_of_orders', $new_number_of_orders, 'user_' . get_current_user_id());
    update_field('order_number_for_current_customer', $new_number_of_orders, $order_id);
}*/

/**
 * Display field value on the order edit page
 */
/*add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta( $order ){
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
    if(empty(get_field('order_number_for_current_customer', $order_id))) {
        $current_number_of_orders =  get_field('number_of_orders', 'user_' . get_current_user_id());
        $new_number_of_orders = $current_number_of_orders + 1;
        if($new_number_of_orders <= 9) {
            $new_number_of_orders = '0' . $new_number_of_orders;
        }
        update_field('number_of_orders', $new_number_of_orders, 'user_' . get_current_user_id());
        update_field('order_number_for_current_customer', $new_number_of_orders, $order_id);
    }
}*/

//https://stackoverflow.com/questions/39401393/how-to-get-woocommerce-order-details
//https://stackoverflow.com/questions/51947198/how-to-query-woocommerce-orders-on-a-page

add_action('admin_head', 'my_custom_style');

function my_custom_style() {
    echo '<style>
    .banks-cards-list {
      display: none;
    } 
  </style>';
}

/*add_action( 'woocommerce_review_order_before_order_total', 'custom_cart_total' );
add_action( 'woocommerce_before_cart_totals', 'custom_cart_total' );
function custom_cart_total() {
    include "custom_files_dm/calculate_total_price_with_delivery.php";

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    WC()->cart->total = (int)$cart_total_price + (int)$delivery;
}

add_action( 'woocommerce_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price( $cart_object ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_calculate_totals' ) >= 2 )
        return;

    include "custom_files_dm/calculate_total_price_with_delivery.php";

    $cart_object->subtotal = (int)$cart_total_price + (int)$delivery;
}*/

add_filter( 'woocommerce_package_rates', 'override_ups_rates' );
function override_ups_rates( $rates ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    include "custom_files_dm/calculate_total_price_with_delivery.php";
    foreach( $rates as $rate_key => $rate ){
        // Check if the shipping method ID is UPS
        /*if( ($rate->method_id == 'flexible_shipping_ups') ) {
            // Set cost to zero
            $rates[$rate_key]->cost = 0;
        }*/
        $rates[$rate_key]->cost = (int)$delivery;
    }
    return $rates;
}

add_action( 'wp_ajax_md_support_save','md_support_save' );
add_action( 'wp_ajax_nopriv_md_support_save','md_support_save' );


function md_support_save($order_id){
    $support_title = !empty($_POST['supporttitle']) ?
        $_POST['supporttitle'] : 'Support Title';

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    // echo $_FILES["upload"]["name"];
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);


    if ($movefile && !isset($movefile['error'])) {
//        echo "File Upload Successfully";
        update_field('client_feedback_file', $movefile['url'], $order_id);
        return $movefile['url'];
        /*echo json_encode(
            [
                'success' => 'true',
//                'file' => $movefile['url']
            ]
        );*/
    } else {
        /**
         * Error generated by _wp_handle_upload()
         * @see _wp_handle_upload() in wp-admin/includes/file.php
         */
        /*echo json_encode(
            [
                'success' => 'false',
                'file' => $movefile['error']
            ]
        );*/
        return '';
    }
//    die();
}

//https://wordpress.stackexchange.com/questions/198781/wordpress-ajax-file-upload-frontend
//https://stackoverflow.com/questions/21214608/jquery-ajax-single-file-upload

function tg_include_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array('product') );
    }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );

// remove product-category
add_filter('request', function( $vars ) {
    global $wpdb;
    if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
        $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
        $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
        if( $exists ){
            $old_vars = $vars;
            $vars = array('product_cat' => $slug );
            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
            if ( !empty( $old_vars['orderby'] ) )
                $vars['orderby'] = $old_vars['orderby'];
            if ( !empty( $old_vars['order'] ) )
                $vars['order'] = $old_vars['order'];
        }
    }
    return $vars;
});

//https://stackoverflow.com/questions/43447175/woocommerce-how-to-remove-product-product-category-from-urls


//https://wordpress.stackexchange.com/questions/250667/stop-wordpress-from-logging-me-out-need-to-keep-me-logged-in
function wpse108399_change_cookie_logout( $expiration, $user_id, $remember ) {
    return 600000000;
}
add_filter( 'auth_cookie_expiration','wpse108399_change_cookie_logout', 10, 3 );

add_shortcode( 'text_page_shortcode', 'textpage_func' );

function textpage_func( $atts ){
    $text = '';
    if(get_field('list', 293)) {
        foreach (get_field('list', 293) as $item) {
           $text .= '<div class="text-page-custom-block__item">
                        <div class="text-page-custom-block__subitem">'.$item['title']. '</div>
                        <div class="text-page-custom-block__subitem">' . $item['opisanie'].'</div>
                    </div>';
        }
    }
    $text = '<div class="text-page-custom-block">'.$text.'</div>';

    return $text;
}

function getDay($day) {
    if($day == 1) {
        $day = 'Пн';
    } else if($day == 2) {
        $day = 'Вт';
    } else if($day == 3) {
        $day = 'Ср';
    } else if($day == 4) {
        $day = 'Чт';
    } else if($day == 5) {
        $day = 'Пт';
    } else if($day == 6) {
        $day = 'Сб';
    } else if($day == 0) {
        $day = 'Вс';
    }
    return $day;
}

function getMonth($date_month) {
    if($date_month == 1) {
        $date_month = 'января';
    } else if($date_month == 2) {
        $date_month = 'февраля';
    } else if($date_month == 3) {
        $date_month = 'марта';
    } else if($date_month == 4) {
        $date_month = 'апреля';
    } else if($date_month == 5) {
        $date_month = 'мая';
    } else if($date_month == 6) {
        $date_month = 'июня';
    } else if($date_month == 7) {
        $date_month = 'июля';
    } else if($date_month == 8) {
        $date_month = 'августа';
    } else if($date_month == 9) {
        $date_month = 'сентября';
    } else if($date_month == 10) {
        $date_month = 'октября';
    } else if($date_month == 11) {
        $date_month = 'ноября';
    } else if($date_month == 12) {
        $date_month = 'декабря';
    }

    return $date_month;
}
<?php
/**
 * domnoo functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Domnoo
 * @since Domnoo 1.32
 */

define( 'DOMNOO_THEME_VERSION', '1.32' );
define( 'DOMNOO_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'domnoo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Domnoo 1.0
 */
function domnoo_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on domnoo, use a find and replace
	 * to change 'domnoo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'domnoo', get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 750, true );
	add_image_size( 'domnoo-shop-horizontal', 770, 370, true );
	add_image_size( 'domnoo-shop-vertical', 585, 792, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'domnoo' ),
		'top-menu' => esc_html__( 'Top Menu', 'domnoo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = domnoo_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'domnoo_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', domnoo_get_fonts_url() ) );
	
	domnoo_get_load_plugins();
}
endif; // domnoo_setup
add_action( 'after_setup_theme', 'domnoo_setup' );
/**
 * Load Google Front
 */
function domnoo_get_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'domnoo' );
    $source  = _x( 'on', 'Source font: on or off', 'domnoo' );
    $arizonia  = _x( 'on', 'Arizonia font: on or off', 'domnoo' );
 
    if ( 'off' !== $roboto || 'off' !== $dosis ) {
        $font_families = array();
 
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto:400,500,700,900';
        }
        if ( 'off' !== $source ) {
            $font_families[] = 'Source+Sans+Pro:400,600,700';
        }
        if ( 'off' !== $arizonia ) {
            $font_families[] = 'Arizonia';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function domnoo_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'domnoo-theme-fonts', domnoo_get_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'domnoo_fonts_url');
/**
 * Enqueue scripts and styles.
 *
 * @since Domnoo 1.0
 */
function domnoo_scripts() {
	// Load our main stylesheet.

	//load font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.5.0' );
	
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), '2.0.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css', array(), '3.2.0' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.2.0' );
	}
	
	wp_enqueue_style( 'domnoo-template', get_template_directory_uri() . '/css/template.css', array(), '3.2' );
	$footer_style = domnoo_print_style_footer();
	if ( !empty($footer_style) ) {
		wp_add_inline_style( 'domnoo-template', $footer_style );
	}
	
	$custom_style = domnoo_custom_styles();
	if ( !empty($custom_style) ) {
		wp_add_inline_style( 'domnoo-template', $custom_style );
	}
	wp_enqueue_style( 'domnoo-style', get_template_directory_uri() . '/style.css', array(), '3.2' );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );
	
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/js/magnific/magnific-popup.css', array(), '1.1.0' );

	wp_enqueue_script( 'jquery-unveil', get_template_directory_uri() . '/js/jquery.unveil.js', array( 'jquery' ), '1.1.0', true );
	
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/css/perfect-scrollbar.css', array(), '0.6.12' );
	
	wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.css', array(), '0.6.12' );

	wp_register_script( 'domnoo-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'domnoo-script', 'domnoo_ajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
	wp_enqueue_script( 'domnoo-script' );

	if ( domnoo_get_config('custom_js') != "" ) {
		wp_add_inline_script( 'domnoo-script', domnoo_get_config('custom_js') );
	}
	wp_add_inline_script( 'domnoo-script', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'domnoo_scripts', 100 );

/**
 * Display descriptions in main navigation.
 *
 * @since Domnoo 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function domnoo_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'domnoo_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Domnoo 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function domnoo_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'domnoo_search_form_modify' );

/**
 * Function get opt_name
 *
 */
function domnoo_get_opt_name() {
	return 'domnoo_theme_options';
}
add_filter( 'apus_framework_get_opt_name', 'domnoo_get_opt_name' );


function domnoo_register_demo_mode() {
	if ( defined('DOMNOO_DEMO_MODE') && DOMNOO_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_framework_register_demo_mode', 'domnoo_register_demo_mode' );

function domnoo_get_demo_preset() {
	$preset = '';
    if ( defined('DOMNOO_DEMO_MODE') && DOMNOO_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_framework_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_framework_preset_default' );
        }
    }
    return $preset;
}

function domnoo_register_post_types($post_types) {
	foreach ($post_types as $key => $post_type) {
		if ( $post_type == 'brand' ) {
			unset($post_types[$key]);
		}
	}
	return $post_types;
}
add_filter( 'apus_framework_register_post_types', 'domnoo_register_post_types' );

function domnoo_get_config($name, $default = '') {
	global $apus_options;
    if ( isset($apus_options[$name]) ) {
        return $apus_options[$name];
    }
    return $default;
}

function domnoo_get_global_config($name, $default = '') {
	$options = get_option( 'domnoo_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function domnoo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'domnoo' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'domnoo' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Contact', 'domnoo' ),
		'id'            => 'sidebar-contact',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'domnoo' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'domnoo' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'domnoo' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'domnoo' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'domnoo' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Sidebar', 'domnoo' ),
		'id' 				=> 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'domnoo' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Top Filter Sidebar', 'domnoo' ),
		'id' 				=> 'shop-top-filter-sidebar',
		'before_widget'		=> '<div class="col-md-cus-5 perfect-scroll  %2$s">',
		'after_widget' 		=> '</div></div></div>',
		'before_title' 		=> '<h3 class="apus-widget-title">',
		'after_title' 		=> '</h3><div class="apus-widget-content"><div class="apus-widget-scroll">'
	));
}
add_action( 'widgets_init', 'domnoo_widgets_init' );

function domnoo_get_load_plugins() {

	$plugins[] = array(
		'name'                     => esc_html__( 'Apus Framework For Themes', 'domnoo' ),
        'slug'                     => 'apus-framework',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/apus-framework.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'WPBakery Visual Composer', 'domnoo' ),
	    'slug'                     => 'js_composer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/js_composer.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Revolution Slider', 'domnoo' ),
        'slug'                     => 'revslider',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Cmb2', 'domnoo' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'domnoo' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Contact Form 7', 'domnoo' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Woocommerce', 'domnoo' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	);

	$plugins[] = array(
        'name'     				   => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'domnoo' ),
        'slug'     				   => 'woo-smart-wishlist',
        'required' 				   => false,
    );

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';

if ( defined( 'APUS_FRAMEWORK_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'DOMNOO_REDUX_FRAMEWORK_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	define( 'DOMNOO_CMB2_ACTIVED', true );
}
if( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/visualcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/google-maps-styles.php';
	if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts2.php';
	} else {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts.php';
	}
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-theme.php';
	define( 'DOMNOO_VISUALCOMPOSER_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-search.php';
	require get_template_directory() . '/inc/vendors/woocommerce/vc-map.php';
	require get_template_directory() . '/inc/vendors/woocommerce/woo-custom.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-taxonomy.php';
	define( 'DOMNOO_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'apus-framework/apus-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/contact-info.php';
	require get_template_directory() . '/inc/widgets/about.php';
	require get_template_directory() . '/inc/widgets/custom_menu.php';
	require get_template_directory() . '/inc/widgets/posts.php';
	require get_template_directory() . '/inc/widgets/recent_comment.php';
	require get_template_directory() . '/inc/widgets/recent_post.php';
	require get_template_directory() . '/inc/widgets/search.php';
	require get_template_directory() . '/inc/widgets/single_image.php';
	require get_template_directory() . '/inc/widgets/socials.php';
	require get_template_directory() . '/inc/widgets/top_rate.php';
	require get_template_directory() . '/inc/widgets/video.php';
	require get_template_directory() . '/inc/widgets/woo-price-filter.php';
	require get_template_directory() . '/inc/widgets/woo-product-sorting.php';
	define( 'DOMNOO_FRAMEWORK_ACTIVED', true );
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';
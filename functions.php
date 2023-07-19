<?php
/**
 * Whistler Cabins functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Whistler_Cabins
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function whistler_cabins_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Whistler Cabins, use a find and replace
		* to change 'whistler-cabins' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'whistler-cabins', get_template_directory() . '/languages' );

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


	add_image_size( 'activities-card', 350, 470, true );
	add_image_size( 'product-card', 400, 400, true); 
	

	// Register menu location(s). Output menu(s) using wp_nav_menu()
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'whistler-cabins' ),
			'menu-2' => esc_html__( 'Footer', 'whistler-cabins' ),
			'menu-3' => esc_html__( 'Footer Social', 'whistler-cabins' ),
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
add_action( 'after_setup_theme', 'whistler_cabins_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function whistler_cabins_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'whistler_cabins_content_width', 640 );
}
add_action( 'after_setup_theme', 'whistler_cabins_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function whistler_cabins_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'whistler-cabins' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'whistler-cabins' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Secondary Sidebar', 'whistler-cabins'),
			'id'            => 'sidebar-2',
			'description'   => esc_html__('Add widgets here.', 'whistler-cabins'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
}
add_action( 'widgets_init', 'whistler_cabins_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function whistler_cabins_scripts() {
	wp_enqueue_style( 'whistler-cabins-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'whistler-cabins-style', 'rtl', 'replace' );

	wp_enqueue_script( 'whistler-cabins-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if(is_home()){
		wp_enqueue_script( 'getMorePostsBtn.js', get_template_directory_uri() .'/js/getMorePostsBtn.js');
	}
  
  	if (is_product()){
		wp_enqueue_style( 'swiper-styles', get_template_directory_uri() .'/css/swiper-bundle.css', array(), '10.0.3' );
		wp_enqueue_script( 'swiper-scripts', get_template_directory_uri() .'/js/swiper-bundle.min.js', array(), '10.0.3', true );
		wp_enqueue_script( 'swiper-setting', get_template_directory_uri() .'/js/swiper-setting.js', array( 'swiper-scripts' ), _S_VERSION, true );
    }

    if ( is_front_page() || is_page(17)) {
		wp_enqueue_script( 'custom-map', get_template_directory_uri() . '/js/custom-map.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script(
			'google-maps-api',
			'https://maps.googleapis.com/maps/api/js?key=AIzaSyDpY5bD4tfgPVeApcgQBI0sR76IAX8NrLg&callback=Function.prototype',
			array(),
			null,
			true
		);
	}

	if (is_page(19)){
		wp_enqueue_script( 'displayFAQ', get_template_directory_uri() . '/js/displayFAQ.js', array(), '1.0', false );
	}
	
	

}
add_action( 'wp_enqueue_scripts', 'whistler_cabins_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WooCommerce.
 */

require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * ACF Google Map API Key
 */
function my_acf_init() {
    
    acf_update_setting('google_api_key', 'AIzaSyDpY5bD4tfgPVeApcgQBI0sR76IAX8NrLg');
}

add_action('acf/init', 'my_acf_init');


/**
 * ACF Options page. All data saved on an options page is global.
 * @link https://www.advancedcustomfields.com/resources/options-page/
 */
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'General Content',
		'menu_title' => 'General Content',
		'menu_slug' => 'general-content',
	));
};

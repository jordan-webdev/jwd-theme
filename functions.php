<?php
/**
 * jwd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jwd
 */

if (! function_exists('jwd_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jwd_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on jwd, use a find and replace
     * to change 'jwd' to the name of your theme in all the template files.
     */
    load_theme_textdomain('jwd', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_theme_support( 'customize-selective-refresh-widgets' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'menu-1' => esc_html__('Primary', 'jwd'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('jwd_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // WooCommerce
    //add_theme_support( 'woocommerce' );
}
endif;
add_action('after_setup_theme', 'jwd_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jwd_content_width()
{
    $GLOBALS['content_width'] = apply_filters('jwd_content_width', 640);
}
add_action('after_setup_theme', 'jwd_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function jwd_scripts()
{
    wp_enqueue_style('jwd-style', get_stylesheet_uri());

    $page_template = get_page_template_slug(get_the_ID());

    /* ****** ASSETS ****** */

    // Add to any
    $add_social_buttons = is_singular("blog_post");
    if ($add_social_buttons){
      wp_enqueue_script('jwd-add-to-any-js', '//static.addtoany.com/menu/page.js');
    }

    // Arrive
    //wp_enqueue_script('jwd-arrive-js', get_template_directory_uri() . '/inc/assets/arrive/arrive.min.js', array('jquery'), '', true);

    // Draw SVG
    //wp_enqueue_script('jwd-draw-svg-js', get_template_directory_uri() . '/js/drawsvg.js', array('jquery'), '', true);

    // Fancybox
    wp_enqueue_script('jwd-fancybox-js', get_template_directory_uri() . '/inc/assets/fancybox/jquery.fancybox.min.js', array('jquery'), '', true);

    wp_enqueue_style('jwd-fancybox-css', get_template_directory_uri() . '/inc/assets/fancybox/jquery.fancybox.min.css');

    // Focus Visible
    wp_enqueue_script('jwd-focus-visible-js', get_template_directory_uri() . '/inc/assets/focus-visible.js', array('jquery'), '', true);

    // FooTable
    //wp_enqueue_script('jwd-footable-js', get_template_directory_uri() . '/inc/assets/footable/footable.js', array('jquery'), '', true);

    // Skip link focus fix
    wp_enqueue_script('jwd-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    // Google Font
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant:wght@300;600;700&family=Montserrat:wght@300;400&display=swap');

    // JS Cookie
    wp_enqueue_script('jwd-js-cookie-js', get_template_directory_uri() . '/inc/assets/js-cookie/js-cookie.js', array(), '', true);

    // Object Fit Function (for video backgrounds)
    wp_enqueue_script('jwd-object-fit-videos-js', get_template_directory_uri() . '/inc/assets/object-fit/object-fit-videos.js', array(), '', true);

    // Object Fit Polyfill (for image / video backgrounds)
    //wp_enqueue_script('jwd-object-fit-js', get_template_directory_uri() . '/inc/assets/object-fit/objectFitPolyfill.basic.min.js', array(), '', true);

    // Progressbar
    //wp_enqueue_script('jwd-progressbar-js', get_template_directory_uri() . '/inc/assets/progressbar/progressbar.js', array(), '', true);

	// Slick
    wp_enqueue_script('jwd-slick-js', get_template_directory_uri() . '/inc/assets/slick.js', array('jquery'), '', true);

    // Swiper
    //wp_enqueue_script('jwd-swiper-js', get_template_directory_uri() . '/inc/assets/swiper/swiper.min.js', array('jquery'), '', true);




    /* ****** Non-Asset JS ****** */
	
	// Functions
    wp_enqueue_script('jwd-functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), '', true);

    // Modules
    foreach( glob( get_template_directory(). '/js/modules/*.js' ) as $file ) {
      $filename = basename($file, strrpos($file, '/') + 1);
      wp_enqueue_script( $filename, get_template_directory_uri().'/js/modules/'.$filename, array('jquery'), '', true);
    }

    // JWD Dropdown
    wp_enqueue_script('jwd-dropdown-js', get_template_directory_uri() . '/js/jwd-dropdown.js', array('jquery'), '', true);

    // Main js
    wp_enqueue_script('jwd-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);

    // Ajax Index
    $is_ajax_index_page = in_array($page_template, array('template-blog.php', 'template-q-a.php')) || is_category();
    if ($is_ajax_index_page){
      wp_enqueue_script('jwd-ajax-index', get_template_directory_uri() . '/js/ajax-index.js', array('jquery'), '', true);
    }

    // Carousels
    foreach( glob( get_template_directory(). '/js/carousels/*.js' ) as $file ) {
      $filename = basename($file, strrpos($file, '/') + 1);
      wp_enqueue_script( $filename, get_template_directory_uri().'/js/carousels/'.$filename, array('jquery'), '', true);
    }

    // Cart (on cart page)
    //if ( is_cart() ) {
      //wp_enqueue_script('jwd-cart', get_template_directory_uri() . '/js/cart.js', array('jquery'), '', true);
    //}

    // Cart List (in header)
    //wp_enqueue_script('jwd-cart-list', get_template_directory_uri() . '/js/cart-list.js', array('jquery'), '', true);

    // Category
    //if (is_category()) {
      //wp_enqueue_script('jwd-category', get_template_directory_uri() . '/js/category.js', array('jquery'), '', true);
    //}

    // Category Accordions
    if (is_page_template("template-q-a.php")){
      wp_enqueue_script('jwd-category-accordions', get_template_directory_uri() . '/js/category-accordions.js', array('jquery'), '', true);
    }

    // Custom Input
    //wp_enqueue_script('jwd-custom-input-js', get_template_directory_uri() . '/js/custom-input.js', array('jquery'), '', true);

    // Drop Down
    //wp_enqueue_script('jwd-drop-down-js', get_template_directory_uri() . '/js/drop-down.js', array('jquery'), '', true);

    // Footable
    wp_enqueue_script('jwd-footable-init-js', get_template_directory_uri() . '/js/footable.js', array('jquery'), '', true);

    // Go To Top
    wp_enqueue_script('jwd-go-to-top-js', get_template_directory_uri() . '/js/go-to-top.js', array('jquery'), '', true);

    // Main Popup
    wp_enqueue_script('jwd-main-popup-js', get_template_directory_uri() . '/js/main-popup.js', array('jquery'), '', true);

    // Product
    //wp_enqueue_script('jwd-product-js', get_template_directory_uri() . '/js/product.js', array('jquery'), '', true);

    // Products Archive
    //wp_enqueue_script('jwd-products-js', get_template_directory_uri() . '/js/products.js', array('jquery'), '', true);

    // Side Slider
    wp_register_script('jwd-side-slider-js', get_template_directory_uri() . '/js/side-slider.js', array('jquery'), '', true);
    // Variables to script
    $handle = 'jwd-side-slider-js';
    $name = 'localizedVar';
    $data = array(
      'homeURL' => home_url(),
      'logo' => wp_get_attachment_image( get_field("mobile_logo", "options")['ID'], "full", false, array("class" => "menu-logo-img") ),
    );
    wp_localize_script($handle, $name, $data);
    wp_enqueue_script('jwd-side-slider-js');

    // Scroll
    wp_enqueue_script('jwd-scroll-js', get_template_directory_uri() . '/js/scroll.js', array('jquery'), '', true);

    // WooCommerce
    //wp_enqueue_script('jwd-woocommerce-js', get_template_directory_uri() . '/js/woocommerce.js', array('jquery'), '', true);

    // SVG animations
    //wp_enqueue_script('jwd-svg-animations', get_template_directory_uri() . '/js/svg.js', array('jquery'), '', true);

    // Togglers
    wp_enqueue_script('jwd-togglers', get_template_directory_uri() . '/js/togglers.js', array('jquery'), '', true);

    // Videos
    //wp_enqueue_script('jwd-videos', get_template_directory_uri() . '/js/videos.js', array('jquery'), '', true);

    // Video Slider
    //wp_enqueue_script('jwd-video-slider', get_template_directory_uri() . '/js/video-slider.js', array('jquery'), '', true);

}
add_action('wp_enqueue_scripts', 'jwd_scripts');

$template = get_template_directory();

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
require $template .'/inc/widgets.php';

/**
 * Implement the Custom Header feature.
 */
require $template . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require $template . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require $template . '/inc/extras.php';

/**
 * Required Plugins
 */
require $template . '/inc/required-plugins/plugins-list.php';

/**
 * Customizer additions.
 */
require $template . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Extra files not included in underscores.
 */

// Functions Files
$files = glob($template . '/inc/functions/*.php');
foreach ($files as $file) {
  require($file);
}

// Blocks
require $template . '/inc/functions/blocks/blocks.php';


// Hooks
$files = glob($template . '/inc/functions/hooks/*.php');
foreach ($files as $file) {
  require($file);
}

// WooCommerce Hooks
/*$files = glob($template . '/inc/functions/woocommerce-hooks/*.php');
foreach ($files as $file) {
  require($file);
}*/

// Remove wp admin bar
//add_filter('show_admin_bar', '__return_false');

// Remove Auto P from text widget
//remove_filter('widget_text_content', 'wpautop');

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

function id_WPSE_114111() {
    var_dump(get_current_screen());
}

//add_action( 'admin_notices', 'id_WPSE_114111' );

add_filter('style_loader_tag', 'jwd_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'jwd_remove_type_attr', 10, 2);

function jwd_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

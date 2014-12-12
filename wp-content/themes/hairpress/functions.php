<?php 

/**
 * Functions for Hairpress WP Theme
 * 
 * textdomain for translations: proteusthemes
 */

//  ========== 
//  = Set the content width = 
//  ========== 
/*
 * @see http://developer.wordpress.com/themes/content-width/
 */
if ( ! isset( $content_width ) )
    $content_width = 700;

function hairpress_adjust_content_width() { // adjust if necessary
    global $content_width;

    if ( is_page_template( 'page-no-sidebar.php' ) )
        $content_width = 940;
}
add_action( 'template_redirect', 'hairpress_adjust_content_width' );


//  ========== 
//  = Option Tree Plugin = 
//  ========== 
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );
/**
 * Theme Options
 */
include_once( 'includes/theme-options.php' );


  
//  ========== 
//  = Theme support and thumbnail sizes = 
//  ==========  
function add_my_theme_support() {
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	
	// thumbnails
	add_image_size( 'services-front', 270, 172, true );
	add_image_size( 'slider', 1500, 530, true );
	add_image_size( 'team-large', 270, 370, true );
	add_image_size( 'team-small', 170, 233, true );
    
    // featured image size
    set_post_thumbnail_size( 200, 167, true );
}
add_action( 'after_setup_theme', 'add_my_theme_support' );
 

 
//  ========== 
//  = ADD CSS = 
//  ==========
function register_my_css() {
	// main style
	wp_register_style( 'main-css', get_template_directory_uri() . "/assets/stylesheets/main.css", array( 'bootstrap', 'bootstrap-responsive' ) );
	// bootstrap css
	wp_register_style( 'bootstrap', get_template_directory_uri() . "/assets/stylesheets/bootstrap.css" );
	// bootstrap responsive css
	wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . "/assets/stylesheets/responsive.css", array( 'bootstrap' ) );
	// jquery UI theme
	wp_register_style( 'jquery-ui-hairpress', get_template_directory_uri() . "/assets/jquery-ui/css/smoothness/jquery-ui-1.10.2.custom.min.css" );
}
add_action( "init", "register_my_css" );

function add_my_css() {
	// add to the header
	if ( !is_admin() && !is_login_page() ) {
		wp_enqueue_style( 'main-css' );
		wp_enqueue_style( 'jquery-ui-hairpress' );
	}
}
add_action( "wp_enqueue_scripts", "add_my_css" );



//  ========== 
//  = ADD JS = 
//  ==========
function add_my_js() {
	// add to the header
	if ( !is_admin() && !is_login_page() ) {
	    wp_enqueue_script( 'jquery' );
	    wp_enqueue_script( 'jquery-ui-datepicker' );
	    wp_enqueue_script( 'jquery-ui-slider' );
	    wp_enqueue_script( 'jquery-ui-datetimepicker', get_template_directory_uri() . "/assets/js/jquery-ui-timepicker.js", array( 'jquery-ui-datepicker', 'jquery-ui-slider' ), FALSE, TRUE );
	    wp_enqueue_script( 'jquery-ui-touch-fix', get_template_directory_uri() . "/assets/jquery-ui/touch-fix.min.js", array( 'jquery-ui-datetimepicker' ), FALSE, TRUE );
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . "/assets/js/bootstrap.min.js", array( 'jquery' ), FALSE, TRUE );
		wp_enqueue_script( 'carousel-js', get_template_directory_uri() . "/assets/js/jquery.carouFredSel-6.1.0-packed.js", array( 'jquery' ), FALSE, TRUE );
        wp_enqueue_script( 'custom-js', get_template_directory_uri() . "/assets/js/custom.js", array(
                'jquery', 
                'carousel-js', 
                'bootstrap-js', 
                'jquery-ui-datepicker' 
            ), FALSE, TRUE );
        
		wp_localize_script( 'custom-js', 'HairpressJS', array(
            'theme_slider_delay' => intval( (double)ot_get_option( 'theme_slider_delay', 8 ) * 1000 ),
            'datetimepicker_date_format' => ot_get_option( 'js_date_format', 'mm/dd/yy' )
		) );
	}
}
add_action( "wp_enqueue_scripts", "add_my_js" );




//  ========== 
//  = Translations = 
//  ==========
function load_proteusthemes_translations(){
    load_theme_textdomain( 'proteusthemes', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'load_proteusthemes_translations');



//  ========== 
//  = Load OT variables = 
//  ========== 
function load_ot_settings() {
	global $content_divider;
	if ( function_exists( 'ot_get_option' ) )
		$content_divider = ot_get_option( 'content_divider', 'scissors' );
}
add_action( 'init', 'load_ot_settings' );



//  ========== 
//  = Add menus = 
//  ========== 
function add_theme_menus() {
	register_nav_menu( "main-menu", "Main Menu" );
}
add_action( "init", "add_theme_menus" );	




//  ========== 
//  = Helper functions = 
//  ========== 
require_once("includes/helpers.php");




//  ========== 
//  = Custom post types = 
//  ========== 
require_once("includes/post-types.php");




//  ========== 
//  = Meta Boxes = 
//  ========== 
require_once("includes/ot-meta-boxes.php");




//  ========== 
//  = Shortcodes = 
//  ========== 
require_once("includes/shortcodes.php");




//  ========== 
//  = Custom menu walker = 
//  ========== 
require_once( "includes/twitter-bootstrap-nav-walker.php" );




//  ========== 
//  = Wordpress Widgets = 
//  ========== 
require_once( "includes/theme-widgets.php" );




//  ========== 
//  = Wordpress Sidebars = 
//  ========== 
require_once( "includes/register-sidebars.php" );



//  ========== 
//  = Filters = 
//  ========== 
require_once( "includes/filters.php" );



//  ========== 
//  = Theme Customization = 
//  ========== 
require_once( "includes/theme-customizer.php" );



//  ========== 
//  = Comment custom function = 
//  ========== 
require_once( "includes/custom-comments.php" );

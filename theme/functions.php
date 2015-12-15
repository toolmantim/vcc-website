<?php
/**
 * Victorian Climbing Club functions and definitions
 *
 * @package Victorian Climbing Club
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'vcc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vcc_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Victorian Climbing Club, use a find and replace
	 * to change 'vcc' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vcc', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Add our custom TinyMCE editor styles
	add_editor_style();

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vcc' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vcc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // vcc_setup
add_action( 'after_setup_theme', 'vcc_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function vcc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Homepage Cliffcare Sidebar', 'vcc' ),
		'id'            => 'homepage-cliffcare-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'vcc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vcc_scripts() {
	wp_enqueue_style( 'vcc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'vcc-es6-shim', get_template_directory_uri() . '/js/es6-shim.min.js', array(), '2015-06-07', true );
	wp_enqueue_script( 'vcc-header-photos', get_template_directory_uri() . '/js/header_photos.js', array(), '2015-06-07', true );

	// wp_enqueue_script( 'vcc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	// wp_enqueue_script( 'vcc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vcc_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load event post type.
 */
require get_template_directory() . '/inc/event-post-type.php';

/**
 * Load custom query functions
 */
require get_template_directory() . '/inc/queries.php';

/**
 * Load iCal feed gen functions
 */
require get_template_directory() . '/inc/ical-feed.php';

/**
 * Removes unused items from the admin menu.
 */
function remove_unused_menu_items() {
  remove_menu_page('edit-comments.php'); // Comments
}
add_action('admin_menu', 'remove_unused_menu_items');

/**
 * Removes unused items from the admin bar.
 */
function remove_unused_admin_bar_items($wp_admin_bar) {
  $wp_admin_bar->remove_node('new-content'); // New Content
}
add_action('admin_bar_menu', 'remove_unused_admin_bar_items', 999);

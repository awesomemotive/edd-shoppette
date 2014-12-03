<?php
/**
 * functions and definitions
 */
 
/**
 * definitions
 */
define( 'SHOPPETTE_NAME', 'Shoppette' );
define( 'SHOPPETTE_VERSION', '1.0.4' );


if ( ! function_exists( 'shoppette_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function shoppette_setup() {

	// keep the media in check
	if ( ! isset( $content_width ) ) $content_width = 700; 

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'shoppette', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );	
	// add a hard cropped (for uniformity) image sizes for the products and posts
	add_image_size( 'featured-img', 768, 450, true );
	add_image_size( 'product-img', 540, 360, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'shoppette' ),
		'header' => __( 'Header Menu (no drop-downs)', 'shoppette' )
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // shoppette_setup
add_action( 'after_setup_theme', 'shoppette_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function shoppette_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'shoppette' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'EDD Sidebar', 'shoppette' ),
		'id'            => 'sidebar-edd',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'shoppette_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shoppette_scripts() {

	// main stylesheet
	wp_enqueue_style( 'shoppette-style', get_stylesheet_uri() );

	// color stylesheet
	if ( get_theme_mod( 'shoppette_stylesheet' ) == 'picnic' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/picnic.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'campaign' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/campaign.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'equipment' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/equipment.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'clay' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/clay.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'golden' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/golden.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'upstream' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/upstream.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'lazer' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/lazer.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'crafty' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/crafty.css' );
	elseif ( get_theme_mod( 'shoppette_stylesheet' ) == 'steel' ) :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/steel.css' );
	else :
		wp_enqueue_style( 'shoppette-design', get_template_directory_uri() . '/inc/assets/css/picnic.css' );
	endif;
	
	// font awesome stylesheet
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/assets/fonts/font-awesome/css/font-awesome.min.css' );
	
	// Google fonts - Pacifico & Open Sans
	wp_enqueue_style( 'googlefonts', 'http://fonts.googleapis.com/css?family=Pacifico|Open+Sans:400italic,700italic,400,700' );
	
	// theme assets
	wp_enqueue_script( 'shoppette-navigation', get_template_directory_uri() . '/inc/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'shoppette-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shoppette_scripts' );

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
 * Theme updater.
 */
require get_template_directory() . '/inc/updater.php';


/** ===============
 * Adjust excerpt length
 */
function shoppette_custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'shoppette_custom_excerpt_length', 999 );


/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function shoppette_excerpt_more( $more ) {
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) || is_archive( 'download') ) {
		return '...';
	} else {
		return '...</p> <div class="continue-reading"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'shoppette_read_more', __( 'Read More', 'shoppette' ) ) . '<i class="fa fa-arrow-circle-o-right"></i></a></div>';
	}
}
add_filter( 'excerpt_more', 'shoppette_excerpt_more' );


/** ===============
 * Add .top class to the first post in a loop
 */
function shoppette_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post )
		$classes[] = 'top';
		return $classes;
}
add_filter( 'post_class', 'shoppette_first_post_class' );


/** ===============
 * Only show regular posts in search results
 */
function shoppette_search_filter( $query ) {
	if ( $query->is_search && !is_admin() )
		$query->set( 'post_type', 'post' );
	return $query;
}
add_filter( 'pre_get_posts','shoppette_search_filter' );


/** ===============
 * Allow comments on downloads
 */
function shoppette_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'shoppette_edd_add_comments_support' );

	
/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );
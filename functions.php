<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'theme', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'theme' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Prints the page number currently being browsed, with a vertical bar before it.
 *
 * Used in header.php to add the page number to the <title> HTML tag.
 */
function toolbox_the_page_number() {
	global $paged; // Contains page number.
	if ( $paged >= 2 )
		echo ' | ' . sprintf( __( 'Page %s' , 'theme' ), $paged );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Primary Widget Area', 'theme' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	$current_theme = get_option( 'template' ); // variable stores the current theme
	$target_theme = 'toolbox'; // variable stores the theme we want to target

	global $pagenow;

	if ( 'themes.php' == $pagenow ) {
		if ( isset( $_GET['activated'] ) && $current_theme == $target_theme ) {
		
			// Setup some instances of the default widgets:
			update_option( 'widget_search', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );
			update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
			update_option( 'widget_meta', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );

			// Update the sidebars with those widgets
			update_option( 'sidebars_widgets', array(
				'primary-widget-area' => array(
					'search-2',
					'archives-2',
					'meta-2',
				),
			));
		}
	}	
}
add_action( 'init', 'toolbox_widgets_init' );
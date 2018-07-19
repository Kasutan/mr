<?php
/**
 * Themedd-child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themedd-child
 */

add_action( 'wp_enqueue_scripts', 'themedd_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function themedd_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'themedd-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'themedd-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'themedd-style' )
	);

}

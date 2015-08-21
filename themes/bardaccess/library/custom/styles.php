<?php
/**
 * Styles
 * WordPress will add these style sheets to the theme header
 */

add_action('wp_enqueue_scripts', 'reactor_register_styles', 1);
add_action('wp_enqueue_scripts', 'reactor_enqueue_styles', 5);
add_action('wp_enqueue_scripts', 'reactor_ie_styles', 99);
 
function reactor_register_styles() {
	// register styles
	wp_register_style('normalize', get_template_directory_uri() . '/library/css/normalize.css', array(), false, 'all');
	wp_register_style('foundation', get_template_directory_uri() . '/library/css/foundation.min.css', array(), false, 'all');
	wp_register_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), false, 'all');
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array(), false, 'all');
}

function reactor_enqueue_styles() {
	if ( !is_admin() ) { 
		// enqueue styles
		wp_enqueue_style('normalize');
		wp_enqueue_style('foundation');
		wp_enqueue_style('foundicons');
		wp_enqueue_style('reactor'); 
		wp_enqueue_style('fontawesome'); 
		
		// add style.css with child themes
		if ( is_child_theme() ) {
			wp_enqueue_style('style');
		}
	}
}

/**
 * IE Styles
 * IE8 doesn't work well with Foundation 4
 * So we need to patch it up a bit
 * 
 * @since 1.0.0
 */
function reactor_ie_styles() {
	
	// load css for IE8
	wp_enqueue_style('ie8-style', get_template_directory_uri() . '/library/css/ie8.css');
	global $wp_styles;
	$wp_styles->add_data('ie8-style', 'conditional', 'lte IE 8');
	
}
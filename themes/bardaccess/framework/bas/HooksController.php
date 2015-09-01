<?php
/*--------------------------------------*/
/* Functions Related to Styles and Scripts
/*--------------------------------------*/

	// THEME SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support( 'woocommerce' );
	add_image_size('thumb-300', 300, 250, true);
	add_image_size('thumb-200', 200, 150, true);
	add_theme_support('automatic-feed-links');
	// add_editor_style('/library/css/editor.css');
	if ( !isset( $content_width ) ) $content_width = 1000;

	// Limit the Custom excerpt length
	function new_excerpt_length($length) {
		global $post;
		if ($post->post_type == 'testimonial'){
			return 120;
		} else {
			return 80;
		}
	}
	add_theme_support(
		'bas-layouts',
		array('1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c')
	);
	add_filter('excerpt_length', 'new_excerpt_length');
	add_theme_support(
		'post-formats',
		array('aside', 'gallery','link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);
	add_theme_support('menus');

	// FILTERS
	add_filter('widget_text', 'do_shortcode');
	
	// HEADER FUNCTIONS
	function bas_get_header_logo_mobile() {  do_action('bas_get_header_logo_mobile'); }
	function bas_get_header_menu() { do_action('bas_get_header_menu'); }
	function bas_header_inside() { do_action('bas_header_inside'); }
	function bas_do_mobile_nav() { do_action('bas_do_mobile_nav'); }
	function bas_nav_bar_below_slider() { do_action('bas_nav_bar_below_slider'); }
	function bas_header_layout1() { do_action('bas_header_layout1'); }
	function bas_header_layout2() { do_action('bas_header_layout2'); }
	function bas_header_layout3() { do_action('bas_header_layout3'); }
	function bas_header_layout4() { do_action('bas_header_layout4'); }
	function bas_header_layout5() { do_action('bas_header_layout5'); }
	function bas_header_layout6() { do_action('bas_header_layout6'); }
	function bas_get_top_bar() { do_action('bas_get_top_bar'); }
	function bas_get_header_logo() { do_action('bas_get_header_logo'); }
	function bas_get_header_right_sidebar() { do_action('bas_get_header_right_sidebar'); }
	function bas_get_header_left_sidebar() { do_action('bas_get_header_left_sidebar'); }
	
	// HOMEPAGE FUNCTION
	function bas_get_homepage_row_content_1() { do_action('bas_get_homepage_row_content_1'); }
	function bas_get_homepage_row_content_2() { do_action('bas_get_homepage_row_content_2'); }
	function bas_get_homepage_row_content_3() { do_action('bas_get_homepage_row_content_3'); }
	function bas_get_homepage_row_content_4() { do_action('bas_get_homepage_row_content_4'); }
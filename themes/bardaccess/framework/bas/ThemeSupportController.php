<?php
/*--------------------------------------*/
/* Theme Support -> Turning On the Lights!
/*--------------------------------------*/

    /**
     * Adds theme support for each of the customizable WP sections
     *
     * @return var
     */
		/*	if ( !function_exists('bas_theme_setup') ) {
		function bas_theme_setup() {

			/**
			 * Add support for the custom menu locations

			add_theme_support( 'bas', array('main-menu') );

	
			add_theme_support(
				'bas-post-types',
				array('slides', 'smiles', 'events', 'staff', 'faq', 'doctor', 'video', 'testimonial', 'beforeafter', 'locations')
			);
			add_theme_support(
				'bas-sidebars',
				array('primary', 'homepage-widget-area-1', 'homepage-widget-area-2')
			);
			
			add_theme_support(
				'bas-layouts',
				array('1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c')
			);
			
			
			add_theme_support(
				'bas-page-templates',
				array('front-page', 'contact', 'testimonial', 'video', 'events', 'staff', 'doctors', 'locations', 'smile-gallery')
			);
			
			add_theme_support('bas-backgrounds');
			add_theme_support('bas-fonts');
			add_theme_support('bas-breadcrumbs');
			add_theme_support('bas-page-links');
			add_theme_support('bas-post-meta');
			add_theme_support('bas-shortcodes');
			add_theme_support('bas-custom-login');
			add_theme_support('bas-taxonomy-subnav');
			add_theme_support('bas-tumblog-icons');
			add_theme_support('bas-translation');
			
			/**
			 * WordPress features
			add_theme_support('menus');
			
			// different post formats for tumblog style posting
			add_theme_support(
				'post-formats',
				array('aside', 'gallery','link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
			);
			
		   /**
		    * 3rd Party Supprt
			
			// WooCommerce
		    // Necessary hooks are removed in the bas construct and added in
		    // library/inc/content/content-pages.php
			add_theme_support( 'woocommerce' );
			
			add_theme_support('post-thumbnails');
			
			// thumbnail sizes - you can add more
			add_image_size('thumb-300', 300, 250, true);
			add_image_size('thumb-200', 200, 150, true);
			
			// these are not needed
			// add_theme_support('custom-background');
			// add_theme_support('custom-header');
			
			// RSS feed links to header.php for posts and comments.
			add_theme_support('automatic-feed-links');
			
			// editor stylesheet for TinyMCE
			add_editor_style('/library/css/editor.css');
			
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
			add_filter('excerpt_length', 'new_excerpt_length');
		}
	}
	add_action('after_setup_theme', 'bas_theme_setup', 10);

			*/


<?php
/*--------------------------------------*/
/* Functions Related to Styles and Scripts
/*--------------------------------------*/
	
    /**
     * Adds styles to wp_enqueue_scripts
     *
     * @return action
     */
	if( !function_exists("theme_styles") ) 
	{  
	    function theme_styles() { 
	    	// Eric Meyer Normalize.css
	        wp_register_style( 'normalize', get_template_directory_uri() . '/includes/css/noarmalize.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'normalize' );
	        // Foundation CSS
	        wp_register_style( 'foundation', get_template_directory_uri() . '/includes/css/foundation.min.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'foundation' );
	        // Foundation CSS
	        wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'fontawesome' );
	        // For child themes
	        wp_register_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'child-style' );
	    }
	}
	add_action( 'wp_enqueue_scripts', 'theme_styles' );
	

    /**
     * Adds javascript to wp_enqueue_scripts
     *
     * @return action
     */
	if( !function_exists( "theme_scripts" ) ) 
	{  
	  function theme_scripts(){
	  
	    wp_register_script( 'foundation-js', get_template_directory_uri() . '/includes/foundation.min.js', array('jquery'), '1.2' );
	    wp_enqueue_script('foundation-js');
	  
	  }
	}
	add_action( 'wp_enqueue_scripts', 'theme_scripts' );

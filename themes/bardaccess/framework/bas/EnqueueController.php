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
	        wp_register_style( 'normalize', get_template_directory_uri() . '/includes/css/normalize.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'normalize' );
	        // Foundation CSS
	        wp_register_style( 'foundation', get_template_directory_uri() . '/includes/css/foundation.min.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'foundation' );
	        // Font Awesome CSS
	        wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'fontawesome' );
	        // Google Fonts CSS
	        wp_register_style( 'source-sans', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,900,700,200,300,200italic,300italic,400italic,600,600italic,900italic', array(), '1.0', 'all' );
	        wp_enqueue_style( 'source-sans' );
	        wp_register_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,800,700italic,700,600italic,600,400italic,300,300italic,800italic', array(), '1.0', 'all' );
	        wp_enqueue_style( 'open-sans' );
	        wp_register_style( 'chivo', 'https://fonts.googleapis.com/css?family=Chivo:400,900,400italic,900italic', array(), '1.0', 'all' );
	        wp_enqueue_style( 'chivo' );
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

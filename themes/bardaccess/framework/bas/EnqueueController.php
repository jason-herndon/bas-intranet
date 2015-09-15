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
	        
	        // OWL Slider
	        wp_register_style( 'owl-css', get_template_directory_uri() . '/includes/css/vendor/owl.carousel.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'owl-css' );
	        wp_register_style( 'owl-theme', get_template_directory_uri() . '/includes/css/vendor/owl.theme.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'owl-theme' );
	        wp_register_style( 'owl-transitions', get_template_directory_uri() . '/includes/css/vendor/owl.transitions.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'owl-transitions' );
	        
	        // Pretty Photo
	        wp_register_style( 'prettyphoto-css', 'http://cdn.jsdelivr.net/prettyphoto/3.1.5/css/prettyPhoto.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'prettyphoto-css' );

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

			// Foundation JS
			wp_register_script( 'foundation-js', get_template_directory_uri() . '/includes/js/foundation.min.js', array('jquery'), '', true );
			wp_enqueue_script('foundation-js');
			
			// OWL Slider
			wp_register_script( 'owl-js', get_template_directory_uri() . '/includes/js/vendor/owl.carousel.min.js', array('jquery'), '', true );
			wp_enqueue_script( 'owl-js' );

			// Pretty Photo
			wp_register_script( 'prettyphoto-js', 'http://cdn.jsdelivr.net/prettyphoto/3.1.5/js/jquery.prettyPhoto.js', array('jquery'), '', true );
			wp_enqueue_script( 'prettyphoto-js' );

			// Theme JS
			wp_register_script( 'theme-js', get_template_directory_uri() . '/includes/js/theme.js', array('jquery'), '', true );
			wp_enqueue_script( 'theme-js' );

		}
	}
	add_action( 'wp_enqueue_scripts', 'theme_scripts' );

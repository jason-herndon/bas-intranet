<?php
/*--------------------------------------*/
/* Styles and Scripts
/*--------------------------------------*/
	
	// enqueue styles
	if( !function_exists("theme_styles") ) {  
	    function theme_styles() { 
	        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
	        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '1.0', 'all' );
	        wp_register_style( 'fontawesome', get_template_directory_uri() . '/library/css/font-awesome.min.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'bootstrap' );
	        wp_enqueue_style( 'fontawesome' );
	
	        // For child themes
	        wp_register_style( 'wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
	        wp_enqueue_style( 'wpbs-style' );
	    }
	}
	add_action( 'wp_enqueue_scripts', 'theme_styles' );
	
	// enqueue javascript
	if( !function_exists( "theme_js" ) ) {  
	  function theme_js(){
	  
	    wp_register_script( 'bootstrap', 
	      get_template_directory_uri() . '/library/js/bootstrap.min.js', 
	      array('jquery'), 
	      '1.2' );
	  
	    wp_register_script( 'wpbs-scripts', 
	      get_template_directory_uri() . '/library/js/scripts.js', 
	      array('jquery'), 
	      '1.2' );
	  
	    wp_register_script(  'modernizr', 
	      get_template_directory_uri() . '/library/js/modernizr.full.min.js', 
	      array('jquery'), 
	      '1.2' );
	  
	    wp_enqueue_script('bootstrap');
	    wp_enqueue_script('wpbs-scripts');
	    wp_enqueue_script('modernizr');
	    
	  }
	}
	add_action( 'wp_enqueue_scripts', 'theme_js' );

	// Add fonts to the Admin area
	add_action('admin_head', 'my_custom_fonts');
	function my_custom_fonts() {
	  echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/library/css/admin.css" type="text/css" media="all" />';
	}
	
	// Set a custom CSS
	function custom_login_css() {
	  echo '<style type="text/css">
	  .login {
	  		background:#34425A;
		}
		
		#login {
			width: 380px
		}
		
		.login form {
		   font-family: "Montserrat", sans-serif;
		}
	    .login h1 a { background-image:url('.get_bloginfo('template_directory').'/library/img/logo-login.png) !important; width: 380px;background-size: 100%; }
	    </style>';
	}
	add_action('login_head', 'custom_login_css');



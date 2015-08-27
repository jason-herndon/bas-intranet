<?php

/*--------------------------------------*/
/* Admin Customization Methods
/*--------------------------------------*/

    /**
     * Add fonts to the Admin area
     *
     * @return view
     */
	function my_custom_fonts() 
	{
	  echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/includes/css/admin.css" type="text/css" media="all" />';
	}
	add_action('admin_head', 'my_custom_fonts');


    /**
     * Set a custom CSS
     *
     * @return view
     */
	function custom_login_css() {
	  echo '<style type="text/css">
	  		.login { background:#34425A; }
			#login { width: 380px }
			.login form { font-family: "Montserrat", sans-serif; }
	    	.login h1 a { background-image:url('.get_bloginfo('template_directory').'/includes/img/logo-login.png) !important; width: 380px;background-size: 100%; }
	    </style>';
	}
	add_action('login_head', 'custom_login_css');

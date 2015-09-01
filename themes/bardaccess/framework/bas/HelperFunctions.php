<?php

/*--------------------------------------*/
/* Helper Functions
/*--------------------------------------*/

    /**
     * Gets the post footer for each blog post
     *
     * @return var
     */
	if ( !function_exists('bas_create_owl_slider_javascript') ) {
		function bas_create_owl_slider_javascript($args) 
		{
		  	if ( wp_script_is( 'owl-js', 'done' ) ) {
		  	}
		}
		add_action( 'wp_footer', 'bas_create_owl_slider_javascript', 111);
	}

    /**
     * Gets the post footer for each blog post
     *
     * @return var
     */
	if ( !function_exists('bas_get_post_footer') ) {
		function bas_get_post_footer() 
		{
		}
	}

    /**
     * Gets the current logged in users role
     *
     * @return string
     */
	if ( !function_exists('bas_get_user_role') ) {
		function bas_get_user_role() 
		{
		    global $current_user;
		    $user_roles = $current_user->roles;
		    $user_role = array_shift($user_roles);
		
		    return $user_role;
		}
	}

    /**
     * Gets the current logged in users role
     *
     * @return string
     */
	if ( !function_exists('bas_get_logo') ) {
		function bas_get_logo() 
		{
			// check if isset logo, else 
			$siteLogo = get('site_logo');
			if (isset($siteLogo) && ($siteLogo != '')){
				return '<img src="'.wp_get_attachment_url($siteLogo).'" class="site-logo">';
			}

		    return get_bloginfo('name');
		}
	}


	/**
	 * Get the Carbon Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_menu') ) {
		function bas_get_menu() {
			if ( has_nav_menu('main-menu') ) 
			{ 
				// get the main menu
				$defaults = array( 
					'theme_location'  	=> 'main-menu',
					'container'       	=> false,
					'menu_class'      	=> 'right',
					'echo'            	=> true,
					'fallback_cb'     	=> 'wp_page_menu',
					'depth'           	=> 2,
					'walker'          	=> new Nav_Bar_Walker()
				 );		
				return wp_nav_menu( $defaults );
			}
		}
	}

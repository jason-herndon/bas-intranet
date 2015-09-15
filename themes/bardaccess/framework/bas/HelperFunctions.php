<?php

/*--------------------------------------*/
/* Helper Functions
/*--------------------------------------*/

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
	 * Get the BAS Main Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_main_menu') ) {
		function bas_get_main_menu() {
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


	/**
	 * Get the BAS Footer Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_footer_menu') ) {
		function bas_get_footer_menu() {
			if ( has_nav_menu('footer-menu') ) 
			{ 
				// get the main menu
				$defaults = array( 
					'theme_location'  	=> 'footer-menu',
					'container'       	=> false,
					'menu_class'      	=> 'inline-list left footer-menu',
					'echo'            	=> true,
					'fallback_cb'     	=> 'wp_page_menu',
					'depth'           	=> 2,
					'walker'          	=> new Nav_Bar_Footer_Walker()
				 );		
				
				return wp_nav_menu( $defaults );
			}
		}
	}	


	/**
	 * Customize the Read More Link
	 * 
	 * @return string
	 */
	if ( !function_exists('bas_customize_read_more') ) {
		function bas_customize_read_more($output) {
			return $output . '<a class="more-link" href="' . get_permalink() . '">Read More</a>';
		}
		add_filter( 'the_content_more_link', 'bas_customize_read_more' );
		add_filter( 'the_excerpt', 'bas_customize_read_more' );
	}
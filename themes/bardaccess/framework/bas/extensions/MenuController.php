<?php

/*--------------------------------------*/
/* Register New Menus & Walkers
/*--------------------------------------*/


    /**
     * Register each of the new menu types
     *
     * @return var
     */
	if ( !function_exists('bas_register_menus') ) {
		function bas_register_menus() {

			register_nav_menu('main-menu', __( 'Main Menu', 'bas'));			
			register_nav_menu('footer-menu', __( 'Footer Menu', 'bas'));
			register_nav_menu('about-left-menu', __( 'About Left Menu', 'bas'));
			register_nav_menu('about-right-menu', __( 'About Right Menu', 'bas'));
			register_nav_menu('news-left-menu', __( 'News Left Menu', 'bas'));
			register_nav_menu('news-right-menu', __( 'News Right Menu', 'bas'));
			register_nav_menu('team-left-menu', __( 'Team Left Menu', 'bas'));
			register_nav_menu('team-right-menu', __( 'Team Right Menu', 'bas'));
			register_nav_menu('faqs-left-menu', __( 'FAQs Left Menu', 'bas'));
			register_nav_menu('faqs-right-menu', __( 'FAQs Right Menu', 'bas'));
			register_nav_menu('forms-left-menu', __( 'Forms Left Menu', 'bas'));
			register_nav_menu('forms-right-menu', __( 'Forms Right Menu', 'bas'));
			register_nav_menu('resources-left-menu', __( 'Resources Left Menu', 'bas'));
			register_nav_menu('resources-right-menu', __( 'Resources Right Menu', 'bas'));

		}
	}
	add_action('init', 'bas_register_menus'); 

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
	 * Get the BAS About Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_about_left_menu') ) {
		function bas_get_about_left_menu() {
			if ( has_nav_menu('about-left-menu') ) 
			{ 
				// get the about left menu
				$defaults = array( 
					'theme_location'  	=> 'about-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left about-left-menu sub-left-menu',
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
	 * Get the BAS About Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_about_right_menu') ) {
		function bas_get_about_right_menu() {
			if ( has_nav_menu('about-right-menu') ) 
			{ 
				// get the about right menu
				$defaults = array( 
					'theme_location'  	=> 'about-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left about-right-menu sub-right-menu',
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
	 * Get the BAS News Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_news_left_menu') ) {
		function bas_get_news_left_menu() {
			if ( has_nav_menu('news-left-menu') ) 
			{ 
				// get the news left menu
				$defaults = array( 
					'theme_location'  	=> 'news-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left news-left-menu sub-left-menu',
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
	 * Get the BAS News Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_news_right_menu') ) {
		function bas_get_news_right_menu() {
			if ( has_nav_menu('news-right-menu') ) 
			{ 
				// get the news right menu
				$defaults = array( 
					'theme_location'  	=> 'news-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left news-right-menu sub-right-menu',
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
	 * Get the BAS Team Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_team_left_menu') ) {
		function bas_get_team_left_menu() {
			if ( has_nav_menu('team-left-menu') ) 
			{ 
				// get the team left menu
				$defaults = array( 
					'theme_location'  	=> 'team-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left team-left-menu sub-left-menu',
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
	 * Get the BAS Team Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_team_right_menu') ) {
		function bas_get_team_right_menu() {
			if ( has_nav_menu('team-right-menu') ) 
			{ 
				// get the team right menu
				$defaults = array( 
					'theme_location'  	=> 'team-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left team-right-menu sub-right-menu',
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
	 * Get the BAS FAQs Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_faqs_left_menu') ) {
		function bas_get_faqs_left_menu() {
			if ( has_nav_menu('faqs-left-menu') ) 
			{ 
				// get the faqs left menu
				$defaults = array( 
					'theme_location'  	=> 'faqs-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left faqs-left-menu sub-left-menu',
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
	 * Get the BAS FAQs Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_faqs_right_menu') ) {
		function bas_get_faqs_right_menu() {
			if ( has_nav_menu('faqs-right-menu') ) 
			{ 
				// get the faqs right menu
				$defaults = array( 
					'theme_location'  	=> 'faqs-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left faqs-right-menu sub-right-menu',
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
	 * Get the BAS Forms Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_forms_left_menu') ) {
		function bas_get_forms_left_menu() {
			if ( has_nav_menu('forms-left-menu') ) 
			{ 
				// get the forms left menu
				$defaults = array( 
					'theme_location'  	=> 'forms-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left forms-left-menu sub-left-menu',
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
	 * Get the BAS Forms Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_forms_right_menu') ) {
		function bas_get_forms_right_menu() {
			if ( has_nav_menu('forms-right-menu') ) 
			{ 
				// get the forms right menu
				$defaults = array( 
					'theme_location'  	=> 'forms-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left forms-right-menu sub-right-menu',
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
	 * Get the BAS Resources Left Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_resources_left_menu') ) {
		function bas_get_resources_left_menu() {
			if ( has_nav_menu('resources-left-menu') ) 
			{ 
				// get the resources left menu
				$defaults = array( 
					'theme_location'  	=> 'resources-left-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left resources-left-menu sub-left-menu',
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
	 * Get the BAS Resources Right Menu
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_resources_right_menu') ) {
		function bas_get_resources_right_menu() {
			if ( has_nav_menu('resources-right-menu') ) 
			{ 
				// get the resources right menu
				$defaults = array( 
					'theme_location'  	=> 'resources-right-menu',
					'container'       	=> false,
					'menu_class'      	=> 'side-nav left resources-right-menu sub-right-menu',
					'echo'            	=> true,
					'fallback_cb'     	=> 'wp_page_menu',
					'depth'           	=> 2,
					'walker'          	=> new Nav_Bar_Footer_Walker()
				 );		
				
				return wp_nav_menu( $defaults );
			}
		}
	}	

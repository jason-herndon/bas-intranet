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
			
		}
	}
	add_action('init', 'bas_register_menus'); 

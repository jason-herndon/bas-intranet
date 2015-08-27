<?php

/*--------------------------------------*/
/* Register New Sidebar Locations
/*--------------------------------------*/

add_action('widgets_init', 'bas_register_sidebars'); 

if ( !function_exists('bas_register_sidebars') ) {
	function bas_register_sidebars() {

		// PRIMARY SIDEBAR
		register_sidebar( array( 
			'name'          => __('Primary Sidebar', 'bas'),
			'id'            => 'sidebar',
			'description'   => 'The primary sidebar for 2 column layouts',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

	}
} // end register sidebars

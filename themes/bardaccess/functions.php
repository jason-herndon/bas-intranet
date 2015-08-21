<?php
/*
Author: Jason Herndon
*/

/*--------------------------------------*/
/* Initialization
/*--------------------------------------*/
	
	// Get the Framework Up & Running!
	require locate_template('library/frameworks/bas-framework/bootstrap.php' );

	// Create an action for add the options
	add_action( 'bas_create_options', 'initalize_theme_and_create_admin_panel' );

	// Fire up the Theme Menu
	function initalize_theme_and_create_admin_panel() {
		
	    // We create all our options here
	    $titan = TitanFramework::getInstance( 'my-theme' );

		// Load in the the Theme Menu
		require locate_template('library/theme-menu.php');
	
	}	

	// Load in the the Theme Functions
	require locate_template('library/theme.php');

	// Set content width
	if ( ! isset( $content_width ) ) $content_width = 580;
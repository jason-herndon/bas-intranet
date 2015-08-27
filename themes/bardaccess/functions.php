<?php
/*
Author: Jason Herndon
*/

/*--------------------------------------*/
/* Initialization
/*--------------------------------------*/
	
	// Get the Framework Up & Running!
	require locate_template('framework/titan/titan-framework-embedder.php' );

	// Create an action for add the options
	add_action( 'tf_create_options', 'initalize_theme_and_create_admin_panel' );

	// Fire up the Theme Menu
	function initalize_theme_and_create_admin_panel() {
		
	    // We create all our options here
	   $titan = TitanFramework::getInstance( 'bas-intranet' );

		// Load in the the Theme Menu
		require locate_template('framework/theme-menu.php');
	
	}	

	// Bootstrap in the the Theme Functions
	require locate_template('framework/bootstrap.php');
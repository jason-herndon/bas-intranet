<?php
/*
Author: Jason Herndon
*/

/*--------------------------------------*/
/* Main Functions
/*--------------------------------------*/
	
	// Get Bones Core Up & Running!
//	require_once('library/frameworks/titan-framework/titan-framework-embedder.php' );
	
	// Admin Functions (commented out by default)
	// require_once('library/custom/admin.php');         // custom admin functions

	// Load widgets
	require_once('library/widgets/social.php');
	require_once('library/widgets/video.php');
	require_once('library/widgets/taxonomies.php');
	require_once('library/widgets/recent-custom-types.php');

	// Meta
	require_once('library/meta/meta_class.php');	

	// Register Custom Post Types
//	require_once('library/custom/admin-menu.php');
	require_once('library/custom/custom_post_menus.php');
//	require_once('library/custom/dashboard-widgets.php');
	require_once('library/custom/menus.php');
	require_once('library/custom/misc.php');
	require_once('/library/custom/styles.php');
	require_once('/library/custom/scripts.php');
//	require_once('library/custom/menu-box-locations.php');
//	require_once('library/custom/modify-css.php');
	require_once('library/custom/post_types.php');
	require_once('library/custom/shortcodes.php');
	require_once('library/custom/sidebars.php');
	require_once('library/custom/taxonomies.php');
	require_once('library/custom/user-roles.php');

	// From FirmaSite && BuddyPress
	require_once('library/buddypress/fix.php');				// Little fix Functions
	require_once('library/buddypress/infinite-scroll.php'); 	// infinite-scroll
	require_once('library/buddypress/honeypot.php');			// Honeypot
	require_once('library/buddypress/plugins.php');			// Buddypress + bbPress
	
	// Include the TGM_Plugin_Activation class.
	require_once( 'library/frameworks/class-tgm-plugin-activation.php');
	add_action( 'tgmpa_register', 'firmasite_register_required_plugins' );
	
	
	// Set content width
	if ( ! isset( $content_width ) ) $content_width = 580;
	

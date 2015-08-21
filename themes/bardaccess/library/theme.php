<?php
/*
Author: Jason Herndon
*/

/*--------------------------------------*/
/* Theme Functions
/*--------------------------------------*/

	// Admin Functions (commented out by default)
	// require_once('custom/admin.php');         // custom admin functions

	// Load widgets
	require_once('widgets/social.php');
	require_once('widgets/video.php');
	require_once('widgets/taxonomies.php');
	require_once('widgets/recent-custom-types.php');

	// Meta
	require_once('meta/meta_class.php');	

	// Register Custom Post Types
//	require_once('custom/admin-menu.php');
	require_once('custom/custom_post_menus.php');
//	require_once('custom/dashboard-widgets.php');
	require_once('custom/menus.php');
	require_once('custom/misc.php');
	require_once('custom/styles.php');
	require_once('custom/scripts.php');
//	require_once('custom/menu-box-locations.php');
//	require_once('custom/modify-css.php');
	require_once('custom/post_types.php');
	require_once('custom/shortcodes.php');
	require_once('custom/sidebars.php');
	require_once('custom/taxonomies.php');
	require_once('custom/user-roles.php');

 	// From FirmaSite && BuddyPress
	require_once('buddypress/fix.php');					// Little fix Functions
	require_once('buddypress/infinite-scroll.php'); 	// infinite-scroll
	require_once('buddypress/honeypot.php');			// Honeypot
	require_once('buddypress/plugins.php');				// Buddypress + bbPress
	
	// Include the TGM_Plugin_Activation class.
	require_once( 'frameworks/class-tgm-plugin-activation.php');
	add_action( 'tgmpa_register', 'firmasite_register_required_plugins' );
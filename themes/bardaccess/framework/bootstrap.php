<?php
/*
 * Author: Jason Herndon
 * Theme Functions
 * @package BAS Intranet
 */

	// Register Custom Functions and Helpers
	require_once('bas/FrameworkIntegration.php');
	require_once('bas/MetaBoxIntegration.php');
	require_once('bas/HooksController.php');
	require_once('bas/HelperFunctions.php');
	require_once('bas/EnqueueController.php');
	require_once('bas/ColumnsController.php');

	// Register Custom Sidebars, Post Types and Taxonomies
	require_once('bas/extensions/MenuWalkerController.php');
	require_once('bas/extensions/PostTypeController.php');
	require_once('bas/extensions/PostMenuController.php');
	require_once('bas/extensions/SidebarController.php');
	require_once('bas/extensions/ShortCodesController.php');
	require_once('bas/extensions/MenuController.php');

	// Register Widgets
	require_once('bas/widgets/SocialWidget.php');
	require_once('bas/widgets/VideoWidget.php');
	require_once('bas/widgets/TaxonomyWidget.php');
	require_once('bas/widgets/RecentCustomTypeWidget.php');

	// Add BuddyPress Scripts
	require_once('buddypress/fix.php');
	require_once('buddypress/honeypot.php');
	require_once('buddypress/infinite-scroll.php');
	require_once('buddypress/plugins.php');	
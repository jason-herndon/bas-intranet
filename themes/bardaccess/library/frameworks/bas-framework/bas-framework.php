<?php
/*
Plugin Name: BAS Framework
Plugin URI: 
Description:
Author: 
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Used for tracking the version used
defined( 'TF_VERSION' ) or define( 'TF_VERSION', '1.0' );
// Used for text domains
defined( 'TF_I18NDOMAIN' ) or define( 'TF_I18NDOMAIN', 'titan-framework' );
// Used for general naming, e.g. nonces
defined( 'TF' ) or define( 'TF', 'titan-framework' );
// Used for general naming
defined( 'TF_NAME' ) or define( 'TF_NAME', 'Titan Framework' );
// Used for file includes
defined( 'TF_PATH' ) or define( 'TF_PATH', trailingslashit( dirname( __FILE__ ) ) );

require_once( TF_PATH . 'classes/admin-notification.php' );
require_once( TF_PATH . 'classes/admin-panel.php' );
require_once( TF_PATH . 'classes/admin-tab.php' );
require_once( TF_PATH . 'classes/bas-css.php' );
require_once( TF_PATH . 'classes/bas-framework.php' );
require_once( TF_PATH . 'classes/meta-box.php' );
require_once( TF_PATH . 'classes/option.php' );
require_once( TF_PATH . 'classes/option-checkbox.php' );
require_once( TF_PATH . 'classes/option-code.php' );
require_once( TF_PATH . 'classes/option-color.php' );
require_once( TF_PATH . 'classes/option-edd-license.php' );
require_once( TF_PATH . 'classes/option-date.php' );
require_once( TF_PATH . 'classes/option-enable.php' );
require_once( TF_PATH . 'classes/option-editor.php' );
require_once( TF_PATH . 'classes/option-font.php' );
require_once( TF_PATH . 'classes/option-heading.php' );
require_once( TF_PATH . 'classes/option-multicheck.php' );
require_once( TF_PATH . 'classes/option-multicheck-categories.php' );
require_once( TF_PATH . 'classes/option-multicheck-pages.php' );
require_once( TF_PATH . 'classes/option-multicheck-posts.php' );
require_once( TF_PATH . 'classes/option-note.php' );
require_once( TF_PATH . 'classes/option-number.php' );
require_once( TF_PATH . 'classes/option-radio.php' );
require_once( TF_PATH . 'classes/option-radio-image.php' );
require_once( TF_PATH . 'classes/option-radio-palette.php' );
require_once( TF_PATH . 'classes/option-save.php' );
require_once( TF_PATH . 'classes/option-select-categories.php' );
require_once( TF_PATH . 'classes/option-select-pages.php' );
require_once( TF_PATH . 'classes/option-select-posts.php' );
require_once( TF_PATH . 'classes/option-select.php' );
require_once( TF_PATH . 'classes/option-sortable.php' );
require_once( TF_PATH . 'classes/option-text.php' );
require_once( TF_PATH . 'classes/option-textarea.php' );
require_once( TF_PATH . 'classes/option-upload.php' );
require_once( TF_PATH . 'classes/theme-customizer-section.php' );
require_once( TF_PATH . 'classes/wp-customize-control.php' );
require_once( TF_PATH . 'functions/googlefonts.php' );
require_once( TF_PATH . 'functions/utils.php' );


/**
 * Titan Framework Plugin Class
 *
 * @since 1.0
 */
class TitanFrameworkPlugin {


	/**
	 * Constructor, add hooks
	 *
	 * @since	1.0
	 */
	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ) );
		add_action( 'plugins_loaded', array( $this, 'forceLoadFirst' ), 10, 1 );

		// Initialize options, but do not really create them yet
		add_action( 'after_setup_theme', array( $this, 'triggerOptionCreation' ), 5 );

		// Create the options
		add_action( 'init', array( $this, 'triggerOptionCreation' ), 11 );
	}


	/**
	 * This will trigger the loading of all the options
	 *
	 * @access	public
	 * @return	void
	 * @since	1.6
	 */
	public function triggerOptionCreation() {
		// The after_setup_theme is the initialization stage
		if ( current_filter() == 'after_setup_theme' ) {
			TitanFramework::$initializing = true;
		}

		do_action( 'bas_create_options' );

		TitanFramework::$initializing = false;
	}


	/**
	 * Load plugin translations
	 *
	 * @access	public
	 * @return	void
	 * @since	1.0
	 */
	public function loadTextDomain() {
		load_plugin_textdomain( TF_I18NDOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Forces our plugin to be loaded first. This is to ensure that plugins that use the framework have access to
	 * this class.
	 *
	 * @access	public
	 * @return	void
	 * @since	1.0
	 * @see		loosly based on http://snippets.khromov.se/modify-wordpress-plugin-load-order/
	 */
	public function forceLoadFirst() {
		$tfFileName = basename( __FILE__ );
		if ( $plugins = get_option( 'active_plugins' ) ) {
			foreach ( $plugins as $key => $pluginPath ) {
				// If we are the first one to load already, don't do anything
				if ( strpos( $pluginPath, $tfFileName ) !== false && $key == 0 ) {
					break;
				// If we aren't the first one, force it!
				} else if ( strpos( $pluginPath, $tfFileName ) !== false ) {
					array_splice( $plugins, $key, 1 );
					array_unshift( $plugins, $pluginPath );
					update_option( 'active_plugins', $plugins );
					break;
				}
			}
		}
	}

}


new TitanFrameworkPlugin();
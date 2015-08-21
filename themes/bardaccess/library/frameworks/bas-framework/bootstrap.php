<?php
/**
 */


if ( ! class_exists( 'BasFrameworkEmbedder' ) ) {


	/**
	 * Titan Framework Embedder
	 *
	 * @since 1.6
	 */
	class BasFrameworkEmbedder {

		/**
		 * Constructor, add hooks for embedding for Titan Framework
		 *
		 * @since 1.6
		 */
		function __construct() {
			// Don't do anything when we're activating a plugin to prevent errors
			// on redeclaring Titan classes
			if ( is_admin() ) {
				if ( ! empty( $_GET['action'] ) && ! empty( $_GET['plugin'] ) ) {
				    if ( $_GET['action'] == 'activate' ) {
				        return;
				    }
				}
			}
			add_action( 'after_setup_theme', array( $this, 'performCheck' ), 1 );
		}


		/**
		 * Uses Titan Framework
		 *
		 * @since 1.6
		 */
		public function performCheck() {
			if ( class_exists( 'TitanFramework' ) ) {
				return;
			}
			require_once( 'bas-framework.php' );
		}

	}

	new BasFrameworkEmbedder();
}
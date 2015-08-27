<?php
/*--------------------------------------*/
/* Integrate with a Meta Box Class
/* In this case, @author Tammy Hart (@tammyhart / tammyhartdesigns.com)
/*--------------------------------------*/

    /**
     * Loads the meta box class
     */
	// De-couple the path to the metaboxes from the class itself
	define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/framework/metaboxes' );
	define( 'THIS_ROOT', dirname(dirname(__FILE__)));

	// require the file
	require_once(THIS_ROOT.'/metaboxes/custom-meta.php');


    /**
     * Returns the value
     *
     * @return var
 	 */
    if ( !function_exists('bas_get_from_tammy_metaboxes') ) {
		function bas_get_from_tammy_metaboxes($args) 
		{
			new Add_Meta_Box( $args['id'], $args['label'], $args['post_type'], $args['position'], $args['priority'], $args['fields'] );
		}
	}


    /**
     * Returns the value
     * args=array( 'id' => '', 'label' => '', 'post_type' => '', 'position' => '', 'priority' => '', 'fields' => '', );
     *
     * @return var
 	 */
	if ( !function_exists('carbon_add_meta_box') ) {
		function carbon_add_meta_box($args) 
		{
			return bas_get_from_tammy_metaboxes($args);
		}
	}
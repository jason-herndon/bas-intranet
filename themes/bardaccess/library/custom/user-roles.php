<?php
	
/*--------------------------------------*/
/* User Roles
/*--------------------------------------*/

	// Extend User Roles & Permissions
	if ( ! function_exists( 'writer_set_roles' ) ):
	 function writer_set_roles()
	 {
	    global $wp_roles;
	
	    // post / page editing
	    $wp_roles->add_cap('author','edit_others_pages');
	    $wp_roles->add_cap('author','edit_published_pages');
	    $wp_roles->add_cap('author','edit_private_pages');
	    $wp_roles->add_cap('author','publish_pages');
	    $wp_roles->add_cap('author','delete_pages');
	    $wp_roles->add_cap('author','delete_others_pages');
	    $wp_roles->add_cap('author','delete_others_posts');
	    $wp_roles->add_cap('author','delete_published_pages');
	    $wp_roles->add_cap('author','manage_categories');
	
	    // appearance
	    $wp_roles->add_cap('editor','edit_themes');
	    $wp_roles->add_cap('editor','edit_theme_options');
	    $wp_roles->add_cap('editor','manage_widgets');
	    $wp_roles->add_cap('editor','edit_widgets');
	    $wp_roles->add_cap('editor','manage_options');
	
	    // sample for plugin caps
		// $wp_roles->add_cap('author','NextGEN Gallery overview');
	  }
	endif;
	
	add_action( 'after_setup_theme', 'writer_set_roles' );


	

/*--------------------------------------*/
/* Find out User Role
/*--------------------------------------*/

	function get_user_role() {
	    global $current_user;
	
	    $user_roles = $current_user->roles;
	    $user_role = array_shift($user_roles);
	
	    return $user_role;
	}




/*--------------------------------------*/
/* RESTRICT ADMIN AREA BY USER ROLE 
/*--------------------------------------*/
	
	function wpse_11244_restrict_admin() {
	    if ( ! current_user_can( 'manage_options' )  && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
	        wp_redirect( home_url() );
	    }
	}
	add_action( 'admin_init', 'wpse_11244_restrict_admin', 1 );
	

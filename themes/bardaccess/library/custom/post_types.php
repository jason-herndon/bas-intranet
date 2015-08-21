<?php
/*--------------------------------------*/
/*	Post Types
/*--------------------------------------*/
add_action( 'init', 'it_create_post_types' );
function it_create_post_types() {
	
	global $it_data; //get theme options for use in setting post type labels & permalinks


	/// ExtendedProfiles
	register_post_type( 'ExtendedProfiles',
		array(
		  'labels' => array(
			'name' => __( 'ExtendedProfiles', 'firmasite' ),
			'singular_name' => __( 'ExtendedProfiles', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'ExtendedProfiles', 'firmasite' ),
			'add_new_item' => __( 'Add New ExtendedProfiles Entry', 'firmasite' ),
			'edit_item' => __( 'Edit ExtendedProfiles Entry', 'firmasite' ),
			'new_item' => __( 'New ExtendedProfiles Entry', 'firmasite' ),
			'view_item' => __( 'View ExtendedProfiles Entry', 'firmasite' ),
			'search_items' => __( 'Search ExtendedProfiles Items', 'firmasite' ),
			'not_found' =>  __( 'No ExtendedProfiles items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No ExtendedProfiles items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),		 

		  'public' => true,
		  'capability_type' => 'post',
		  'supports' => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'ExtendedProfiles' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('post_tag', 'ExtendedProfiles_cats'), // this is IMPORTANT
		   'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	);


	/// DepartmentDescriptions
	register_post_type( 'ExtendedDepartments',
		array(
		  'labels' => array(
			'name' => __( 'Ext-Departments', 'firmasite' ),
			'singular_name' => __( 'ExtendedDepartments', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'ExtendedDepartments', 'firmasite' ),
			'add_new_item' => __( 'Add New ExtendedDepartments Entry', 'firmasite' ),
			'edit_item' => __( 'Edit ExtendedDepartments Entry', 'firmasite' ),
			'new_item' => __( 'New ExtendedDepartments Entry', 'firmasite' ),
			'view_item' => __( 'View ExtendedDepartments Entry', 'firmasite' ),
			'search_items' => __( 'Search ExtendedDepartments Items', 'firmasite' ),
			'not_found' =>  __( 'No ExtendedDepartments items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No ExtendedDepartments items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),		 

		  'public' => true,
		  'capability_type' => 'post',
		  'supports' => array('title','editor','thumbnail','excerpt','custom-fields', 'tags', 'revisions'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'ExtendedDepartments' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('post_tag'), // this is IMPORTANT
		  'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	);



	/// IDP
	register_post_type( 'IDP', 
		array(
		  'labels' => array(
			'name' => __( 'IDP', 'firmasite' ),
			'singular_name' => __( 'IDP', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'IDP', 'firmasite' ),
			'add_new_item' => __( 'Add New IDP Entry', 'firmasite' ),
			'edit_item' => __( 'Edit IDP Entry', 'firmasite' ),
			'new_item' => __( 'New IDP Entry', 'firmasite' ),
			'view_item' => __( 'View IDP Entry', 'firmasite' ),
			'search_items' => __( 'Search IDP items', 'firmasite' ),
			'not_found' =>  __( 'No IDP items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No IDP Items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),

		  'public' => true,
		  'supports' => array('title', 'revisions', 'thumbnail', 'custom-fields', 'editor'),
		  'query_var' => true,
		  'show_ui' => true,
		  'capability_type' => 'post',
		  'rewrite' => array( 'slug' => 'IDP' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('IDP_cats'), // this is IMPORTANT
		  'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	  );


	/// SuccessTree
	register_post_type( 'SuccessTree', 
		array(
		  'labels' => array(
			'name' => __( 'SuccessTree', 'firmasite' ),
			'singular_name' => __( 'SuccessTree', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'SuccessTree', 'firmasite' ),
			'add_new_item' => __( 'Add New SuccessTree Entry', 'firmasite' ),
			'edit_item' => __( 'Edit SuccessTree Entry', 'firmasite' ),
			'new_item' => __( 'New SuccessTree Entry', 'firmasite' ),
			'view_item' => __( 'View SuccessTree Entry', 'firmasite' ),
			'search_items' => __( 'Search SuccessTree items', 'firmasite' ),
			'not_found' =>  __( 'No SuccessTree items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No SuccessTree Items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),

		  'public' => true,
		  'supports' => array('title', 'revisions', 'thumbnail', 'custom-fields', 'editor'),
		  'query_var' => true,
		  'show_ui' => true,
		  'rewrite' => array( 'slug' => 'SuccessTree' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('ST_cats'), // this is IMPORTANT
		   'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	  );


	/// Perks
	register_post_type( 'Perks', 
		array(
		  'labels' => array(
			'name' => __( 'Perks', 'firmasite' ),
			'singular_name' => __( 'Perks', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'Perks', 'firmasite' ),
			'add_new_item' => __( 'Add New Perks Entry', 'firmasite' ),
			'edit_item' => __( 'Edit Perks Entry', 'firmasite' ),
			'new_item' => __( 'New Perks Entry', 'firmasite' ),
			'view_item' => __( 'View Perks Entry', 'firmasite' ),
			'search_items' => __( 'Search Perks items', 'firmasite' ),
			'not_found' =>  __( 'No Perks items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No Perks Items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),

		  'public' => true,
		  'supports' => array('title', 'revisions', 'thumbnail', 'custom-fields', 'editor', 'tags'),
		  'query_var' => true,
		  'show_ui' => true,
		  'rewrite' => array( 'slug' => 'Perks' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('post_tag'), // this is IMPORTANT
		   'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	  );


	/// VacationTracker
	register_post_type( 'VacationTracker', 
		array(
		  'labels' => array(
			'name' => __( 'VacationTracker', 'firmasite' ),
			'singular_name' => __( 'VacationTracker', 'firmasite' ),		
			'add_new' => _x( 'Add New', 'VacationTracker', 'firmasite' ),
			'add_new_item' => __( 'Add New VacationTracker Entry', 'firmasite' ),
			'edit_item' => __( 'Edit VacationTracker Entry', 'firmasite' ),
			'new_item' => __( 'New VacationTracker Entry', 'firmasite' ),
			'view_item' => __( 'View VacationTracker Entry', 'firmasite' ),
			'search_items' => __( 'Search VacationTracker items', 'firmasite' ),
			'not_found' =>  __( 'No VacationTracker items found', 'firmasite' ),
			'not_found_in_trash' => __( 'No VacationTracker Items found in Trash', 'firmasite' ),
			'parent_item_colon' => ''
		  ),

		  'public' => true,
		  'supports' => array('title', 'revisions', 'thumbnail', 'custom-fields', 'editor', 'tags'),
		  'query_var' => true,
		  'show_ui' => true,
		  'rewrite' => array( 'slug' => 'VacationTracker' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'taxonomies' => array('post_tag'), // this is IMPORTANT
		   'menu_icon' => get_template_directory_uri() . '/library/frameworks/bas-framework/img/admin/custom-post-type.png',
		)
	  );

	


}
?>
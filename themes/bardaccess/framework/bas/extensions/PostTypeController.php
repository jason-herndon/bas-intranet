<?php

/*--------------------------------------*/
/* Register New Post Types
/*--------------------------------------*/

add_action('after_setup_theme', 'bas_register_post_types', 16); 
 
if ( !function_exists('bas_register_post_types') ) {
	function bas_register_post_types() { 
		
		/**
		 * Register SLIDER post type
		 */
		if ( !function_exists('bas_slide_register') ) {
			function bas_slide_register() {
					
				$labels = array( 
					'name'               => __('Slideshow', 'bas'),
					'singular_name'      => __('Slide', 'bas'),
					'add_new'            => __('Add New', 'bas'),
					'add_new_item'       => __('Add New Slide', 'bas'),
					'edit_item'          => __('Edit Slide', 'bas'),
					'new_item'           => __('New Slide', 'bas'),
					'all_items'          => __('All Slides', 'bas'),
					'view_item'          => __('View Slide', 'bas'),
					'search_items'       => __('Search Slides', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Sliders', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => true,
					'capability_type'    => 'post',
					'taxonomies'         => array('slide-category'),
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 7,
						'rewrite'    => array(  
						'slug'       => __('slideshow-post', 'bas'),
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor', 'thumbnail', 'excerpt'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
			 
				register_post_type('slide' , $args );
			} // end function
			add_action('init', 'bas_slide_register');

			/**
			 * Create slide taxonomies
			 */
			if ( !function_exists('bas_slide_taxonomies') ) {
				function bas_slide_taxonomies() {
				  $labels = array( 
					'name'              => __('Sliders', 'bas'),
					'singular_name'     => __('Slider Name', 'bas'),
					'search_items'      => __('Search Sliders', 'bas'),
					'all_items'         => __('All Sliders', 'bas'),
					'parent_item'       => __('Parent Sliders', 'bas'),
					'parent_item_colon' => __('Parent Sliders', 'bas'),
					'edit_item'         => __('Edit Slider', 'bas'), 
					'update_item'       => __('Update Slider', 'bas'),
					'add_new_item'      => __('Add New Slider', 'bas'),
					'new_item_name'     => __('New Slider Name', 'bas'),
					'menu_name'         => __('Sliders', 'bas'),
				  ); 	
					
				  register_taxonomy('slide-category', array('slide'), 
				  array( 
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				  ));
				} // end taxonomy
				add_action('init', 'bas_slide_taxonomies', 0);
			} // end if function exists
		} // end slider post type




		/**
		 * Register FEATURED CONTENT post type
		 */
		if ( !function_exists('bas_featured_content_register') ) {
			function bas_featured_content_register() {
					
				$labels = array( 
					'name'               => __('Featured Content', 'bas'),
					'singular_name'      => __('Feature', 'bas'),
					'add_new'            => __('Add Featured Content Slide', 'bas'),
					'add_new_item'       => __('Add Featured Content Slide', 'bas'),
					'edit_item'          => __('Edit Featured Content Slide', 'bas'),
					'new_item'           => __('New Featured Content Slide', 'bas'),
					'all_items'          => __('All Featured Content Slides', 'bas'),
					'view_item'          => __('View Featured Content Slide', 'bas'),
					'search_items'       => __('Search Featured Content Slides', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Featured Content', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => true,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 7,
						'rewrite'    => array(  
						'slug'       => __('featured-post', 'bas'),
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor', 'thumbnail', 'excerpt'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
			 
				register_post_type('featured' , $args );
			} // end function
			add_action('init', 'bas_featured_content_register');
		} // end featured content post type




		/**
		 * Register SIDEBAR IMAGES post type
		 */
		if ( !function_exists('bas_sidebar_images_register') ) {
			function bas_sidebar_images_register() {
					
				$labels = array( 
					'name'               => __('Sidebar Ads', 'bas'),
					'singular_name'      => __('Feature', 'bas'),
					'add_new'            => __('Add Sidebar Ad', 'bas'),
					'add_new_item'       => __('Add Sidebar Ad', 'bas'),
					'edit_item'          => __('Edit Sidebar Ad', 'bas'),
					'new_item'           => __('New Sidebar Ad', 'bas'),
					'all_items'          => __('All Sidebar Ads', 'bas'),
					'view_item'          => __('View Sidebar Ad', 'bas'),
					'search_items'       => __('Search Sidebar Ads', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Sidebar Ads', 'bas')
				);
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => true,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 7,
						'rewrite'    => array(  
						'slug'       => __('sidebar-image', 'bas'),
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor', 'thumbnail', 'excerpt'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				); 
			 
				register_post_type('sidebar-images' , $args );
			} // end function
			add_action('init', 'bas_sidebar_images_register');
		} // end sidebar-images post type




		/**
		 * Register FAQ post type
		 */
		if ( !function_exists('bas_faq_register') ) {
			function bas_faq_register() {
					
				$labels = array( 
					'name'               => __('FAQ', 'bas'),
					'singular_name'      => __('FAQ', 'bas'),
					'add_new'            => __('Add New', 'bas'),
					'add_new_item'       => __('Add New FAQ', 'bas'),
					'edit_item'          => __('Edit FAQ', 'bas'),
					'new_item'           => __('New FAQ', 'bas'),
					'all_items'          => __('All FAQs', 'bas'),
					'view_item'          => __('View FAQ', 'bas'),
					'search_items'       => __('Search FAQs', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('FAQ', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => true,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 7,
						'rewrite'    => array(  
						'slug'       => __('faq', 'bas'),
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','thumbnail', 'excerpt', 'editor'),
				  ); 
			 
				register_post_type('faq' , $args );
	
			} // end function
			add_action('init', 'bas_faq_register');
		} // end post type


		/**
		 * Register EVENTS post type
		 */
		if ( !function_exists('bas_event_register') ) {
			function bas_event_register() {
					
				$labels = array( 
					'name'               => __('Calendar', 'bas'),
					'singular_name'      => __('Event', 'bas'),
					'add_new'            => __('Add New', 'bas'),
					'add_new_item'       => __('Add New Event', 'bas'),
					'edit_item'          => __('Edit Event', 'bas'),
					'new_item'           => __('New Event', 'bas'),
					'all_items'          => __('All Events', 'bas'),
					'view_item'          => __('View Event', 'bas'),
					'search_items'       => __('Search Events', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Events', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => true,
					'capability_type'    => 'post',
					'taxonomies'         => array('event-category'),
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 7,
						'rewrite'    => array(  
						'slug'       => __('event-post', 'bas'),
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail', 'excerpt'),
				  ); 
			 
				register_post_type('event' , $args );
			}
			add_action('init', 'bas_event_register');

			/**
			 * Create event taxonomies
			 */
			if ( !function_exists('bas_event_taxonomies') ) {
				function bas_event_taxonomies() {
				  $labels = array( 
					'name'              => __('Event Categories', 'bas'),
					'singular_name'     => __('Event Category', 'bas'),
					'search_items'      => __('Search Event Categories', 'bas'),
					'all_items'         => __('All Event Categories', 'bas'),
					'parent_item'       => __('Parent Event Category', 'bas'),
					'parent_item_colon' => __('Parent Event Category:', 'bas'),
					'edit_item'         => __('Edit Event Category', 'bas'), 
					'update_item'       => __('Update Event Category', 'bas'),
					'add_new_item'      => __('Add New Event Category', 'bas'),
					'new_item_name'     => __('New Event Category Name', 'bas'),
					'menu_name'         => __('Categories', 'bas'),
				  ); 	
					
				  register_taxonomy('event-category', array('event'), 
				  array( 
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				  ));
				} // end taxonomy
			} // end if function exists
			add_action('init', 'bas_event_taxonomies', 0);
		} // end event post type


		/**
		 * Register HR STAFF post type
		 */
		if ( !function_exists('bas_staff_register') ) {
			function bas_staff_register() {
				 
				$labels = array( 
					'name'               => __('Staff', 'bas'),
					'singular_name'      => __('Staff Member', 'bas'),
					'add_new'            => __('Add New', 'bas'),
					'add_new_item'       => __('Add New Staff Member', 'bas'),
					'edit_item'          => __('Edit Staff Member', 'bas'),
					'new_item'           => __('New Staff Member', 'bas'),
					'all_items'          => __('All Staff', 'bas'),
					'view_item'          => __('View Staff Member', 'bas'),
					'search_items'       => __('Search Staff Members', 'bas'),
					'not_found'          => __('Nothing found', 'bas'),
					'not_found_in_trash' => __('Nothing found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('HR Staff', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('staff-post', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail', 'excerpt'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('staff' , $args );
					
			}
			add_action('init', 'bas_staff_register');
		} // end bas faq register


		/**
		 * Register EXTENDED PROFILES post type
		 */
		if ( !function_exists('bas_extended_profile_register') ) {
			function bas_extended_profile_register() {
				 
				$labels = array( 
					'name'               => __('ExtendedProfiles', 'bas'),
					'singular_name'      => __('ExtendedProfiles', 'bas'),
					'add_new'            => __('Add New', 'ExtendedProfiles', 'bas'),
					'add_new_item'       => __('Add New ExtendedProfiles Entry', 'bas'),
					'edit_item'          => __('Edit ExtendedProfiles Entry', 'bas'),
					'new_item'           => __('New ExtendedProfiles Entry', 'bas'),
					'all_items'          => __('All ExtendedProfiless', 'bas'),
					'view_item'          => __('View ExtendedProfiles Entry', 'bas'),
					'search_items'       => __('Search ExtendedProfiles Items', 'bas'),
					'not_found'          => __('No ExtendedProfiles items found', 'bas'),
					'not_found_in_trash' => __('No ExtendedProfiles items found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('ExtendedProfiles', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('extended-profile', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('extended-profile' , $args );
					
			}
			add_action('init', 'bas_extended_profile_register');

			// taxonomies args => ExtendedProfiles_cats

		} // end bas extended profiles register


		/**
		 * Register EXTENDED DEPARTMENTS post type
		 */
		if ( !function_exists('bas_extended_departments_register') ) {
			function bas_extended_departments_register() {
				 
				$labels = array( 
					'name'               => __('ExtendedDepartments', 'bas'),
					'singular_name'      => __('ExtendedDepartments', 'bas'),
					'add_new'            => __('Add New', 'ExtendedDepartments', 'bas'),
					'add_new_item'       => __('Add New ExtendedDepartments Entry', 'bas'),
					'edit_item'          => __('Edit ExtendedDepartments Entry', 'bas'),
					'new_item'           => __('New ExtendedDepartments Entry', 'bas'),
					'all_items'          => __('All ExtendedDepartments', 'bas'),
					'view_item'          => __('View ExtendedDepartments Entry', 'bas'),
					'search_items'       => __('Search ExtendedDepartments Items', 'bas'),
					'not_found'          => __('No ExtendedDepartments items found', 'bas'),
					'not_found_in_trash' => __('No ExtendedDepartments items found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('ExtendedDepts', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('extended-department', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('extended-department' , $args );
					
			}
			add_action('init', 'bas_extended_departments_register');

			// taxonomies args => post_tag

		} // end bas extended departments register


		/**
		 * Register IDP post type
		 */
		if ( !function_exists('bas_idp_register') ) {
			function bas_idp_register() {
				 
				$labels = array( 
					'name'               => __('IDP', 'bas'),
					'singular_name'      => __('IDP', 'bas'),
					'add_new'            => __('Add New', 'IDP', 'bas'),
					'add_new_item'       => __('Add New IDP Entry', 'bas'),
					'edit_item'          => __('Edit IDP Entry', 'bas'),
					'new_item'           => __('New IDP Entry', 'bas'),
					'all_items'          => __('All IDP', 'bas'),
					'view_item'          => __('View IDP Entry', 'bas'),
					'search_items'       => __('Search IDP Items', 'bas'),
					'not_found'          => __('No IDP items found', 'bas'),
					'not_found_in_trash' => __('No IDP items found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('IDP', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('idp', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('idp' , $args );
					
			}
			add_action('init', 'bas_idp_register');

			// 'taxonomies' => array('IDP_cats')

		} // end bas idp register


		/**
		 * Register SuccessTree post type
		 */
		if ( !function_exists('bas_success_tree_register') ) {
			function bas_success_tree_register() {
				 
				$labels = array( 
					'name'               => __('SuccessTree', 'bas'),
					'singular_name'      => __('SuccessTree', 'bas'),
					'add_new'            => __('Add New', 'SuccessTree', 'bas'),
					'add_new_item'       => __('Add New SuccessTree Entry', 'bas'),
					'edit_item'          => __('Edit SuccessTree Entry', 'bas'),
					'new_item'           => __('New SuccessTree Entry', 'bas'),
					'all_items'          => __('All SuccessTree', 'bas'),
					'view_item'          => __('View SuccessTree Entry', 'bas'),
					'search_items'       => __('Search SuccessTree Items', 'bas'),
					'not_found'          => __('No SuccessTree items found', 'bas'),
					'not_found_in_trash' => __('No SuccessTree items found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('SuccessTree', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('success-tree', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('success-tree' , $args );
					
			}
			add_action('init', 'bas_success_tree_register');

			// 'taxonomies' => array('ST_cats')

		} // end bas success tree register


		/**
		 * Register Perks post type
		 */
		if ( !function_exists('bas_perks_register') ) {
			function bas_perks_register() {
				 
				$labels = array( 
					'name'               => __('Perks', 'bas'),
					'singular_name'      => __('Perks', 'bas'),
					'add_new'            => __('Add New', 'Perks', 'bas'),
					'add_new_item'       => __('Add New Perks Entry', 'bas'),
					'edit_item'          => __('Edit Perks Entry', 'bas'),
					'new_item'           => __('New Perks Entry', 'bas'),
					'all_items'          => __('All Perks', 'bas'),
					'view_item'          => __('View Perks Entry', 'bas'),
					'search_items'       => __('Search Perks Items', 'bas'),
					'not_found'          => __('No Perks items found', 'bas'),
					'not_found_in_trash' => __('No Perks items found in Trash', 'bas'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Perks', 'bas')
				 );
				 
				$args = array( 
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'menu_icon'          => false,
					'rewrite'	         => false,
					'capability_type'    => 'post',
					'taxonomies'         => false,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 8,
					'rewrite'            => array(  
						'slug'       => __('perks', 'bas'),  
						'with_front' => false,  
						'feed'       => true,  
						'pages'      => true ),
					'supports'           => array('title','editor','thumbnail','excerpt','custom-fields', 'tags','revisions'),
				  	'exclude_from_search' => true,
				  	'show_in_nav_menus'  => false,
				  ); 
				 
				register_post_type('perks' , $args );
					
			}
			add_action('init', 'bas_perks_register');

			// 'taxonomies' => array('post_tag')

		} // end bas perks register



	} // end function
} // end if function exists
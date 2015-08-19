<?php
/*--------------------------------------*/
/*	Taxonomies
/*--------------------------------------*/
add_action( 'init', 'it_create_tax', 0 );

//create taxonomies
function it_create_tax() {
	
	/** Global **/

	$tax = array(
		'name' => __( 'Categories', 'it' ),
		'singular_name' => __( 'Category', 'it' ),
		'search_items' =>  __( 'Search Categories', 'it' ),
		'all_items' => __( 'All Categories', 'it' ),
		'parent_item' => __( 'Parent Category', 'it' ),
		'parent_item_colon' => __( 'Parent Category:', 'it' ),
		'edit_item' => __( 'Edit  Category', 'it' ),
		'update_item' => __( 'Update Category', 'it' ),
		'add_new_item' => __( 'Add New  Category', 'it' ),
		'new_item_name' => __( 'New Category Name', 'it' ),
		'choose_from_most_used'	=> __( 'Choose from the most used categories', 'it' )
	);
	
	
	register_taxonomy('IDP_cats','IDP',array(
		'hierarchical' => true,
		'query_var' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'IDP Category', 'taxonomy general name' ),
			'singular_name' => _x( 'IDP Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search IDP Categories' ),
			'all_items' => __( 'All IDP Categories' ),
			'parent_item' => __( 'Parent IDP Category' ),
			'parent_item_colon' => __( 'Parent IDP Category:' ),
			'edit_item' => __( 'Edit IDP Category' ),
			'update_item' => __( 'Update IDP Category' ),
			'add_new_item' => __( 'Add New IDP Category' ),
			'new_item_name' => __( 'New IDP Category Name' ),
			'menu_name' => __( 'IDP Categories' ),
		),
	));


	register_taxonomy('ST_cats','SuccessTree',array(
		'hierarchical' => true,
		'query_var' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'SuccessTree Category', 'taxonomy general name' ),
			'singular_name' => _x( 'SuccessTree Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search SuccessTree Categories' ),
			'all_items' => __( 'All SuccessTree Categories' ),
			'parent_item' => __( 'Parent SuccessTree Category' ),
			'parent_item_colon' => __( 'Parent SuccessTree Category:' ),
			'edit_item' => __( 'Edit SuccessTree Category' ),
			'update_item' => __( 'Update SuccessTree Category' ),
			'add_new_item' => __( 'Add New SuccessTree Category' ),
			'new_item_name' => __( 'New SuccessTree Category Name' ),
			'menu_name' => __( 'SuccessTree Categories' ),
		),
	));

	
	register_taxonomy('ExtendedProfiles_cats','ExtendedProfiles',array(
		'hierarchical' => true,
		'query_var' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'BARD Departments', 'taxonomy general name' ),
			'singular_name' => _x( 'BARD Department', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search BARD Departments' ),
			'all_items' => __( 'All BARD Departments' ),
			'parent_item' => __( 'Parent BARD Department' ),
			'parent_item_colon' => __( 'Parent BARD Department:' ),
			'edit_item' => __( 'Edit BARD Department' ),
			'update_item' => __( 'Update BARD Department' ),
			'add_new_item' => __( 'Add New BARD Department' ),
			'new_item_name' => __( 'New BARD Department Name' ),
			'menu_name' => __( 'BARD Departments' ),
		),
	));

	
}

	// Add Filter

	function it_add_filters() {
		global $typenow;
	
		if( $typenow == 'IDP' || $typenow = 'ExtendedProfiles' || $typenow = 'SuccessTree'){
			if( $typenow == 'IDP') { $taxonomies = array('IDP_cats'); }
			if( $typenow == 'SuccessTree') { $taxonomies = array('ST_cats'); }
			if( $typenow == 'ExtendedProfiles') { $taxonomies = array('ExtendedProfiles_cats'); }
	
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if(count($terms) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>All Categories</option>";
					foreach ($terms as $term) { 
						echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
					}
					echo "</select>";
				}
			}
		}
	}

	add_action( 'restrict_manage_posts', 'it_add_filters' );

?>
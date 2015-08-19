<?php
/**
* Register Custom Post Menus */
 
$prefix = 'it_';
$it_meta_boxes = array();

/* ExtendedProfiles EXTRAS */
$it_meta_boxes[] = array(
	'id' => 'it_extendedprofiles_meta',
	'title' => __('ExtendedProfiles Options','it'),
	'pages' => array('ExtendedProfiles'),
	'fields' => array(
		array(
            'name' => __('WP User ID','it'),
            'desc' => __('The WP User ID','it'),
            'id' => $prefix . 'wpuser_id',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Employee ID','it'),
            'desc' => __('The BAS Employee ID','it'),
            'id' => $prefix . 'id',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Employment Start Date','it'),
            'desc' => __('Date of Hire','it'),
            'id' => $prefix . 'hiredate',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Supervisor','it'),
            'desc' => __('Is this person a supervisor? If so, enter the ID of their Department as listed in the BARD Departments menu listing.','it'),
            'id' => $prefix . 'supervisor',
            'type' => 'text',
            'std' => ''
        ),
	),

);

/* ExtendedDepartments EXTRAS */
$it_meta_boxes[] = array(
	'id' => 'it_ExtendedDepartments_meta',
	'title' => __('ExtendedDepartments Options','it'),
	'pages' => array('ExtendedDepartments'),
	'fields' => array(
		array(
            'name' => __('Tag ID','it'),
            'desc' => __('The Tag ID for this Department from the Extended Profiles page.','it'),
            'id' => $prefix . 'wpdepartment_id',
            'type' => 'text',
            'std' => ''
        ),
	),

);

/* Post EXTRAS */
$it_meta_boxes[] = array(
	'id' => 'it_post_meta',
	'title' => __('Post Options','it'),
	'pages' => array('post'),
	'fields' => array(
/*
		array(
            'name' => __('Featured Image', 'it'),
            'id' => $prefix . 'single_featured_image',
			'desc' => __('You can enable or disable the featured image', 'it'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
        ),
		array(
            'name' => __('Tags', 'it'),
            'id' => $prefix . 'single_tags',
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
            'desc' => __('You can enable or disable the tags.', 'it'),
        ),
*/
	)
);



// meta box ===> Page EXTRAS
$it_meta_boxes[] = array(
	'id' => 'it_meta_templates',
	'title' => __('Page Template Options','it'),
	'pages' => array('page'),
	'fields' => array(
/*
		array(
			'name' => __('Blog Category', 'it'),
			'id' => $prefix . 'blog_parent',
			'type' => 'taxonomy',
			'taxonomy' => 'category',
			'desc' => __('If a blog page, select a category.','it')
		),
		array(
            'name' => __('Results Per Page','it'),
            'desc' => __('Specify how many projects/team members you want to show per page on pages with pagination','it'),
            'id' => $prefix . 'template_posts_per_page',
            'type' => 'text',
            'std' => '-1'
        ),
*/
	)
);

foreach ($it_meta_boxes as $meta_box) {
	new it_meta_box($meta_box);
}
?>
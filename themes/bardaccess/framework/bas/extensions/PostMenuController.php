<?php

/*--------------------------------------*/
/* Customize Custom Post Menus
/*--------------------------------------*/

	$prefix = 'bas_';	

	// META BOX FOR EXTENDED PROFILES TYPE
	$profile_fields = array(
		array( 
			'label'	=> 'WordPress User Id', // <label>
			'desc'	=> 'The WP User ID', // description
			'id'	=> $prefix.'wpuser_id', // field id and name
			'type'	=> 'text' // type of field
		),
		array( 
			'label'	=> 'Employee ID', // <label>
			'desc'	=> 'The BAS Employee ID', // description
			'id'	=> $prefix.'basuser_id', // field id and name
			'type'	=> 'text' // type of field
		),
		array( 
			'label'	=> 'Supervisor ID', // <label>
			'desc'	=> 'Is this person a supervisor? If so, enter the ID of their Department as listed in the BARD Departments menu listing.', // description
			'id'	=> $prefix.'supervisor', // field id and name
			'type'	=> 'text' // type of field
		),
		array( // jQuery UI Date input
			'label'	=> 'BAS Start Date', // <label>
			'desc'	=> 'Date of Hire', // description
			'id'	=> $prefix.'hiredate', // field id and name
			'type'	=> 'date' // type of field
		),
	);
	carbon_add_meta_box( array('id' => 'extprofile_meta', 'label' => __('Profile Information', 'bas'), 'post_type' => 'extended-profile', 'position' => 'normal', 'priority' => 'default', 'fields' => $profile_fields) );
 
	// META BOX FOR EXTENDED DEPARTMENTS TYPE
	$department_fields = array(
		array( 
			'label'	=> 'Tag ID', // <label>
			'desc'	=> 'The Tag ID for this Department from the Extended Profiles page.', // description
			'id'	=> $prefix.'wpdepartment_id', // field id and name
			'type'	=> 'text' // type of field
		),
	);
	carbon_add_meta_box( array('id' => 'extdept_meta', 'label' => __('Department Information', 'bas'), 'post_type' => 'extended-department', 'position' => 'normal', 'priority' => 'default', 'fields' => $department_fields) );

	// META BOX FOR EVENTS POST TYPE
	$event_fields = array(
		array( // jQuery UI Date input
			'label'	=> 'Event Date', // <label>
			'desc'	=> 'What day does your event start?', // description
			'id'	=> $prefix.'date_start', // field id and name
			'type'	=> 'date' // type of field
		),
		array( // jQuery UI Date input
			'label'	=> 'Event End Date', // <label>
			'desc'	=> 'What day does your event end (you can leave this blank if it\'s a single day event)?', // description
			'id'	=> $prefix.'date_end', // field id and name
			'type'	=> 'date' // type of field
		),
	);
	carbon_add_meta_box( array('id' => 'event_meta', 'label' => __('Event Information', 'bas'), 'post_type' => 'event', 'position' => 'normal', 'priority' => 'high', 'fields' => $event_fields) );

	// META BOX FOR STAFF POST TYPE
	$staff_fields = array(
		array( // Text Input
			'label'	=> 'Title/Position', // <label>
			'desc'	=> 'Title or Position in the office (optional - leave blank if you don\'t want to show this).', // description
			'id'	=> $prefix.'text', // field id and name
			'type'	=> 'text' // type of field
		),
		array( // Text Input
			'label'	=> 'Years with Company', // <label>
			'desc'	=> 'Number of Years Working Here (optional - leave blank if you don\'t want to show this).', // description
			'id'	=> $prefix.'text', // field id and name
			'type'	=> 'text' // type of field
		),
		array( // Text Input
			'label'	=> 'Email', // <label>
			'desc'	=> 'Their email address (optional - leave blank if you don\'t want to show this).', // description
			'id'	=> $prefix.'text', // field id and name
			'type'	=> 'text' // type of field
		),
		array( // Text Input
			'label'	=> 'Phone', // <label>
			'desc'	=> 'Their phone number (optional - leave blank if you don\'t want to show this).', // description
			'id'	=> $prefix.'text', // field id and name
			'type'	=> 'text' // type of field
		),
	);
	carbon_add_meta_box( array('id' => 'staff_meta', 'label' => __('Extra Staff Information', 'bas'), 'post_type' => 'staff', 'position' => 'normal', 'priority' => 'high', 'fields' => $staff_fields) );

	// META BOX FOR SLIDE POST TYPE
	$slide_fields = array(
	 	array(
			'label'	=> __('URL', 'bas'),
			'desc'	=> __('If no content is added, this serves as a URL for the slide when clicked.', 'bas'),
			'id'	=> '_slide_url',
			'type'	=> 'url'
		),
		// array( // Image ID field
		// 	'label'	=> 'Mobile Image', // <label>
		// 	'desc'	=> 'The smaller version to use in the mobile slider.', // description
		// 	'id'	=> '_mobile_image', // field id and name
		// 	'type'	=> 'image' // type of field
		// ),
	);
	carbon_add_meta_box( array('id' => 'slide_meta', 'label' => __('Slide Information', 'bas'), 'post_type' => 'slide', 'position' => 'normal', 'priority' => 'high', 'fields' => $slide_fields) );
		
	// META BOX FOR POST/PAGE LAYOUTS
	$layout_fields = array(
	 	array(
			'label'	=> __('Select a template layout', 'bas'),
			'desc'	=> '',
			'id'	=> '_template_layout',
			'type'	=> 'radio',
			'std'   => '2c-l',
			'options' => array(
				'1c' => __('One Column', 'bas'),
				'2c-l' => __('Two Columns, Left', 'bas'),
				'2c-r' => __('Two Columns, Right', 'bas'),
				'3c-l' => __('Three Columns, Left', 'bas'),
				'3c-r' => __('Three Columns, Right', 'bas'),
				'3c-c' => __('Three Columns, Center', 'bas'),
			),
		),
	);
	carbon_add_meta_box( array('id' => 'layout_meta', 'label' => __('Layout', 'bas'), 'post_type' => array('post', 'page'), 'position' => 'side', 'priority' => 'default', 'fields' => $layout_fields) );
<?php

	/*
	 * // My Settings	
	 */
		$adminPanel = $titan->createAdminPanel( array(
		    'name' => 'Site Options',
		));

			/*
			 * // TAB: General Settings	
			 */
			$panel = $adminPanel->createTab( array(
		    	'name' => 'General Settings',
		    	'capability' => '',
		    	'icon' => 'fa fa-cog',
		    	'id' => 'settings',
			) );
				$panel->createOption( array(
				    'type' => 'save',
				) );
				$panel->createOption( array(
				    'name' => 'Site Logo',
				    'id' => 'site_logo',
				    'type' => 'upload',
				) );
				$panel->createOption( array(
				    'name' => 'Homepage Content',
				    'id' => 'homepage_row_order',
				    'type' => 'sortable',
				    'desc' => 'This is our option',
				    'options' => array(
				        'slider' => 'Sliders',
				        'feature-boxes' => 'Featured Content',
				        'testimony' => 'The third label',
				        'footer' => 'Footer Content',
				    )
				) );



			/*
			 * // TAB: CSS & JS	
			 */
			$overridesPanel = $adminPanel->createTab( array(
		    	'name' => 'CSS and JS',
		    	'capability' => '',
			) );
				$overridesPanel->createOption( array(
				    'type' => 'save',
				) );
				$overridesPanel->createOption( array(
				    'name' => 'Custom CSS',
				    'id' => 'custom_css',
				    'type' => 'code',
				    'desc' => 'Put your custom CSS rules here',
				    'lang' => 'css',
				) );
				$overridesPanel->createOption( array(
				    'name' => 'Custom Javascript',
				    'id' => 'additional_javascript',
				    'type' => 'code',
				    'desc' => 'Put your additional javascript rules here',
				    'lang' => 'javascript',
				) );
		
	
	/*
	 * // Site Wide Settings	
		$panel = $adminPanel->createTab( array(
	    	'name' => 'Site Wide Settings',
	    	'capability' => '',
	    	'icon' => 'fa fa-cog',
	    	'id' => 'settings',
		) );
			$panel->createOption( array(
			    'type' => 'save',
			) );
			// each homepage row
			$panel->createOption( array(
			    'name' => 'Row Layout',
			    'id' => 'construction_row_content_layout',
			    'type' => 'radio-image',
			    'desc' => 'To customize the css for this row, use class "construction_row_wrapper1"',
			    'options' => array(
			        'layout1' => get_template_directory_uri() . '/library/frameworks/img/admin/layout1.png',
			        'layout2' => get_template_directory_uri() . '/library/frameworks/img/admin/layout2.png',
			        'layout3' => get_template_directory_uri() . '/library/frameworks/img/admin/layout3.png',
			        'layout4' => get_template_directory_uri() . '/library/frameworks/img/admin/layout4.png',
			        'layout5' => get_template_directory_uri() . '/library/frameworks/img/admin/layout5.png',
			        'layout8' => get_template_directory_uri() . '/library/frameworks/img/admin/layout8.png',
			    ),
			) );
			$panel->createOption( array(
			    'name' => 'My Sortable Option',
			    'id' => 'my_sortable_option',
			    'type' => 'sortable',
			    'desc' => 'This is our option',
			    'options' => array(
			        'value1' => 'The first label',
			        'value2' => 'The second label',
			        'value3' => 'The third label',
			        'value4' => 'The fourth label',
			    )
			) );

			// NOTE
			$panel->createOption( array(
			    'type' => 'note',
			    'desc' => 'A note or an important reminder'
			) );

			// NUMBER
			$panel->createOption( array(
			    'name' => 'My Number Option',
			    'id' => 'my_number_option',
			    'type' => 'number',
			    'desc' => 'This is our option',
			    'default' => '10',
			    'max' => '100',
			) );

			// DATE
			$panel->createOption( array(
			    'name' => 'My Date Option',
			    'id' => 'my_date_option',
			    'type' => 'date',
			    'desc' => 'Choose a date',
			    'default' => '2010-12-20',
			) );

			// CHECKBOX
			$panel->createOption( array(
			    'name' => 'My Checkbox Option',
			    'id' => 'my_checkbox_option',
			    'type' => 'checkbox',
			    'desc' => 'This is our option',
			    'default' => false,
			) );

			// TEXT
			$panel->createOption( array(
				'name' => 'My Text Option',
				'id' => 'my_text_option',
				'type' => 'text',
				'desc' => 'This is our option'
			) );

			// TEXTAREA
			$panel->createOption( array(
			    'name' => 'My Textarea Option',
			    'id' => 'my_textarea_option',
			    'type' => 'textarea',
			    'desc' => 'This is our option'
			) );

			// UPLOAD
			$panel->createOption( array(
			    'name' => 'My Upload Option',
			    'id' => 'my_upload_option',
			    'type' => 'upload',
			    'desc' => 'Upload your image'
			) );

			// RADIO
			$panel->createOption( array(
			    'name' => 'My Radio Option',
			    'id' => 'my_radio_option',
			    'options' => array(
			        '1' => 'Option one',
			        '2' => 'Option two',
			        '3' => 'Option three',
			    ),
			    'type' => 'radio',
			    'desc' => 'Select one',
			    'default' => '2',
			) );

			// SELECT PAGES
			$panel->createOption( array(
				'name' => 'My Select Page Option',
				'id' => 'my_selectpage_option',
				'type' => 'select-pages',
				'desc' => 'Select a page'
			) );

			// SELECT POST TYPES (CUSTOM)
			$panel->createOption( array(
			    'name' => 'Select a post',
			    'id' => 'my_post_option',
			    'type' => 'select-posts',
			    'desc' => 'This is an option',
			    'post_type' => 'portfolio',
			) );

			// SELECT CATEGORIES
			$panel->createOption( array(
			    'name' => 'Post Categories',
			    'id' => 'my_categories_option',
			    'type' => 'select-categories',
			    'desc' => 'This is an option',
			    'taxonomy' => 'portfolio_category',
			) );

			// SELECT OPTION
			$panel->createOption( array(
			    'name' => 'My Select Option',
			    'id' => 'my_select_option',
			    'type' => 'select',
			    'desc' => 'This is our option',
			    'options' => array(
			        'Group 1' => array(
			            '1' => 'Option one',
			            '2' => 'Option two',
			        ),
			        'Group 2' => array(
			            '3' => 'Option three',
			        ),
			    ),
			    'default' => '2',
			) );

			// MULTI CHECK OPTION
			$panel->createOption( array(
			    'name' => 'My Multicheck Option',
			    'id' => 'my_multicheck_option',
			    'type' => 'multicheck',
			    'desc' => 'Check whichever applies',
			    'options' => array(
			        '1' => 'Option one',
			        '2' => 'Option two',
			        '3' => 'Option three',
			    ),
			    'default' => array( '2', '3' ),
			) );

			// MULTICHECK PAGES OPTION
			$panel->createOption( array(
			    'name' => 'My Pages',
			    'id' => 'my_multicheck_option_pages',
			    'type' => 'multicheck-pages',
			    'desc' => 'Check a page',
			) );

			// MULTICHECK POSTS (CUSTOM)
			$panel->createOption( array(
			    'name' => 'My Posts',
			    'id' => 'my_multicheck_option_posts',
			    'type' => 'multicheck-posts',
			    'desc' => 'Check a post',
			    'post_type' => 'portfolio_post',
			) );

			// MULTICHECK CATEGORIES
			$panel->createOption( array(
			    'name' => 'My Post Categories',
			    'id' => 'my_multicheck_option_categories',
			    'type' => 'multicheck-categories',
			    'desc' => 'Check a category',
			    'taxonomy' => 'portfolio_category',
			) );

	 */

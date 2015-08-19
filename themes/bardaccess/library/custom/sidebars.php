<?php

/*--------------------------------------*/
/* Sidebars
/*--------------------------------------*/
	
	// Sidebars & Widgetizes Areas
	function wp_bootstrap_register_sidebars() {
	    register_sidebar(array(
	    	'id' => 'sidebar1',
	    	'name' => 'Main Sidebar',
	    	'description' => 'Used on every page BUT the homepage page template.',
	    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    	'after_widget' => '</div>',
	    	'before_title' => '<h4 class="widgettitle">',
	    	'after_title' => '</h4>',
	    ));
	    
	    register_sidebar(array(
	    	'id' => 'sidebar2',
	    	'name' => 'Homepage Sidebar',
	    	'description' => 'Used only on the homepage page template.',
	    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    	'after_widget' => '</div>',
	    	'before_title' => '<h4 class="widgettitle">',
	    	'after_title' => '</h4>',
	    ));
	    
	    register_sidebar(array(
	      'id' => 'footer1',
	      'name' => 'Footer 1',
	      'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
	      'after_widget' => '</div>',
	      'before_title' => '<h4 class="widgettitle">',
	      'after_title' => '</h4>',
	    ));
	
	    register_sidebar(array(
	      'id' => 'footer2',
	      'name' => 'Footer 2',
	      'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
	      'after_widget' => '</div>',
	      'before_title' => '<h4 class="widgettitle">',
	      'after_title' => '</h4>',
	    ));
	
	    register_sidebar(array(
	      'id' => 'footer3',
	      'name' => 'Footer 3',
	      'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
	      'after_widget' => '</div>',
	      'before_title' => '<h4 class="widgettitle">',
	      'after_title' => '</h4>',
	    ));
	
	    register_sidebar(array(
	      'id' => 'footer4',
	      'name' => 'Footer 4',
	      'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
	      'after_widget' => '</div>',
	      'before_title' => '<h4 class="widgettitle">',
	      'after_title' => '</h4>',
	    ));
	    
	    
	 } // don't remove this bracket!
	

/*--------------------------------------*/
/* Sidebar MENUS
/*--------------------------------------*/

add_filter("manage_edit-IDP_columns", "edit_IDP_columns" );
add_action("manage_posts_custom_column", "custom_IDP_columns");

function edit_IDP_columns($IDP_columns){
        $IDP_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Title",
				"IDP_category" => "IDP Category",
                "IDP_image" => "Featured Image"
        );
        return $IDP_columns;
}

function custom_IDP_columns($IDP_column){
        global $post;
        switch ($IDP_column)
        {
				case "IDP_category":
					echo get_the_term_list( get_the_ID(), 'IDP_cats', ' ', ' , ', ' ');
				break;

				case 'IDP_description':
					the_excerpt();  
				break;  
				
                case "IDP_image":
						if(has_post_thumbnail()) {
                        	the_post_thumbnail( 'small-thumb' );
						} else { echo '-'; }
				break;
        }

}



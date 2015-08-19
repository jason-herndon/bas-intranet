<?php

/*--------------------------------------*/
/* Misc Functions
/*--------------------------------------*/

	// Enable shortcodes in widgets
	add_filter( 'widget_text', 'do_shortcode' );
	
	// Disable jump in 'read more' link
	function remove_more_jump_link( $link ) {
		$offset = strpos($link, '#more-');
		if ( $offset ) {
			$end = strpos( $link, '"',$offset );
		}
		if ( $end ) {
			$link = substr_replace( $link, '', $offset, $end-$offset );
		}
		return $link;
	}
	add_filter( 'the_content_more_link', 'remove_more_jump_link' );
	
	// Remove height/width attributes on images so they can be responsive
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
	
	function remove_thumbnail_dimensions( $html ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}
	
	// Add the Meta Box to the homepage template
	function add_homepage_meta_box() {  
		global $post;
	
		// Only add homepage meta box if template being used is the homepage template
		// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
		$post_id = $post->ID;
		$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	
		if ( $template_file == 'page-homepage.php' ){
		    add_meta_box(  
		        'homepage_meta_box', // $id  
		        'Optional Homepage Tagline', // $title  
		        'show_homepage_meta_box', // $callback  
		        'page', // $page  
		        'normal', // $context  
		        'high'); // $priority  
	    }
	}
	
	add_action( 'add_meta_boxes', 'add_homepage_meta_box' );
	
	// Field Array  
	$prefix = 'custom_';  
	$custom_meta_fields = array(  
	    array(  
	        'label'=> 'Homepage tagline area',  
	        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
	        'id'    => $prefix.'tagline',  
	        'type'  => 'textarea' 
	    )  
	);  
	
	// The Homepage Meta Box Callback  
	function show_homepage_meta_box() {  
	  global $custom_meta_fields, $post;
	
	  // Use nonce for verification
	  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
	    
	  // Begin the field table and loop
	  echo '<table class="form-table">';
	
	  foreach ( $custom_meta_fields as $field ) {
	      // get value of this field if it exists for this post  
	      $meta = get_post_meta($post->ID, $field['id'], true);  
	      // begin a table row with  
	      echo '<tr> 
	              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
	              <td>';  
	              switch($field['type']) {  
	                  // text  
	                  case 'text':  
	                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
	                          <br /><span class="description">'.$field['desc'].'</span>';  
	                  break;
	                  
	                  // textarea  
	                  case 'textarea':  
	                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
	                          <br /><span class="description">'.$field['desc'].'</span>';  
	                  break;  
	              } //end switch  
	      echo '</td></tr>';  
	  } // end foreach  
	  echo '</table>'; // end table  
	}  
	
	// Save the Data  
	function save_homepage_meta( $post_id ) {  
	
	    global $custom_meta_fields;  
	  
	    // verify nonce  
	    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )  
	        return $post_id;
	
	    // check autosave
	    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
	        return $post_id;
	
	    // check permissions
	    if ( 'page' == $_POST['post_type'] ) {
	        if ( !current_user_can( 'edit_page', $post_id ) )
	            return $post_id;
	        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
	            return $post_id;
	    }
	  
	    // loop through fields and save the data  
	    foreach ( $custom_meta_fields as $field ) {
	        $old = get_post_meta( $post_id, $field['id'], true );
	        $new = $_POST[$field['id']];
	
	        if ($new && $new != $old) {
	            update_post_meta( $post_id, $field['id'], $new );
	        } elseif ( '' == $new && $old ) {
	            delete_post_meta( $post_id, $field['id'], $old );
	        }
	    } // end foreach
	}
	add_action( 'save_post', 'save_homepage_meta' );
	
	// Add thumbnail class to thumbnail links
	function add_class_attachment_link( $html ) {
	    $postid = get_the_ID();
	    $html = str_replace( '<a','<a class="thumbnail"',$html );
	    return $html;
	}
	add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );
	
	// Add lead class to first paragraph
	function first_paragraph( $content ){
	    global $post;
	
	    // if we're on the homepage, don't add the lead class to the first paragraph of text
	    if( is_page_template( 'page-homepage.php' ) )
	        return $content;
	    else
	        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
	}
	add_filter( 'the_content', 'first_paragraph' );
	
	// Get <head> <title> to behave like other themes
	function wp_bootstrap_wp_title( $title, $sep ) {
	  global $paged, $page;
	
	  if ( is_feed() ) {
	    return $title;
	  }
	
	  // Add the site name.
	  $title .= get_bloginfo( 'name' );
	
	  // Add the site description for the home/front page.
	  $site_description = get_bloginfo( 'description', 'display' );
	  if ( $site_description && ( is_home() || is_front_page() ) ) {
	    $title = "$title $sep $site_description";
	  }
	
	  // Add a page number if necessary.
	  if ( $paged >= 2 || $page >= 2 ) {
	    $title = "$title $sep " . sprintf( __( 'Page %s', 'wpbootstrap' ), max( $paged, $page ) );
	  }
	
	  return $title;
	}
	add_filter( 'wp_title', 'wp_bootstrap_wp_title', 10, 2 );






/*--------------------------------------*/
/* TUMBNAIL SIZE OPTIONS
/*--------------------------------------*/
	
	// Thumbnail sizes
	add_image_size( 'wpbs-featured', 780, 300, true );
	add_image_size( 'wpbs-featured-home', 970, 311, true);
	add_image_size( 'wpbs-featured-carousel', 970, 400, true);



/*--------------------------------------*/
/* Check Image Function - This comes in handy!
/*--------------------------------------*/
	
	function has_image_attachment($post_id) {
		$args = array(
	    	'post_type' => 'attachment',
	    	'post_mime_type' => '',
	        'numberposts' => -1,
	        'post_status' => null,
	        'post_parent' => $post_id
	    ); 
	
	    $attachments = get_posts($args);
		
	    if(is_array($attachments) && count($attachments) > 0) {
	       	//Has image attachments
	    	    return true;
	    			} else {
		    	return false;
	    }
				
	}



/*--------------------------------------*/
/* Search Form Layout - Password Protected
/*--------------------------------------*/
	
	add_filter( 'the_password_form', 'custom_password_form' );
	
	function custom_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbootstrap') . '</p>' . '
		<label for="' . $label . '">' . __( "Password:" ,'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbootstrap' ) . '" /></div>
		</form></div>
		';
		return $o;
	}



/*--------------------------------------*/
/* Function to get Post Meta By Field
/*--------------------------------------*/
	
	function getMetaInfoByField($field) {
		global $post;

		$paramValue = get_post_meta($post->ID, $field, true);
		
		return $paramValue;
		
	}




/*--------------------------------------*/
/* Better Tag Cloud
/*--------------------------------------*/
	
	add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );
	
	function my_widget_tag_cloud_args( $args ) {
		$args['number'] = 20; // show less tags
		$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
		$args['smallest'] = 9.75;
		$args['unit'] = 'px';
		return $args;
	}
	
	// filter tag clould output so that it can be styled by CSS
	function add_tag_class( $taglinks ) {
	    $tags = explode('</a>', $taglinks);
	    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
	
	    foreach( $tags as $tag ) {
	    	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
	    }
	
	    $taglinks = implode('</a>', $tagn);
	
	    return $taglinks;
	}
	
	add_action( 'wp_tag_cloud', 'add_tag_class' );
	
	add_filter( 'wp_tag_cloud','wp_tag_cloud_filter', 10, 2) ;
	
	function wp_tag_cloud_filter( $return, $args )
	{
	  return '<div id="tag-cloud">' . $return . '</div>';
	}
	

	
/*--------------------------------------*/
/*	Custom Login Logo
/*--------------------------------------*/
	function prth_custom_login_logo() {
	    global $itdata;
	    if($itdata['custom_login_logo'] !='') {
	        $custom_login_logo_css = '';
	        $custom_login_logo_css .= '<style type="text/css">';
	        $custom_login_logo_css .= '.login h1 a {';
	        $custom_login_logo_css .= 'background-image:url('. $itdata['custom_login_logo'] .') !important;width: auto !important;background-size: auto !important;';
	        if($itdata['custom_login_logo_height']) {
	            $custom_login_logo_css .= 'height: '.$itdata['custom_login_logo_height'].' !important;';
	        }
	        $custom_login_logo_css .= '}</style>';
	
	        echo $custom_login_logo_css;
	    }
	}
	add_action('login_head', 'prth_custom_login_logo');
	


/*--------------------------------------*/
/* Disable the admin bar from showing
/*--------------------------------------*/
	
	if (!function_exists('disableAdminBar')) {  
	    function disableAdminBar(){  
	    remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page  
	    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end  
	    function remove_admin_bar_style_backend() {  // css override for the admin page  
	      echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';  
	    }  
	    add_filter('admin_head','remove_admin_bar_style_backend');  
	    function remove_admin_bar_style_frontend() { // css override for the frontend  
	      echo '<style type="text/css" media="screen"> 
	      html { margin-top: 0px !important; } 
	      * html body { margin-top: 0px !important; } 
	      </style>';  
	    }  
	    add_filter('wp_head','remove_admin_bar_style_frontend', 99);  
	  }  
	}  
	// add_filter('admin_head','remove_admin_bar_style_backend'); // Original version  
	add_action('init','disableAdminBar'); // New version 
	



/*--------------------------------------*/
/* Blog/Excerpt Functions
/*--------------------------------------*/
	
	//post excerpt length
	function new_excerpt_length($length) {
		global $it_data;
		return $it_data['blog_excerpt'];
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	//replace excerpt link
	function new_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');



/*--------------------------------------*/
/* Add Log For Debug Function
/*--------------------------------------*/
	
	if(!function_exists('_log')){
	  function _log( $message ) {
	    if( WP_DEBUG === true ){
	      if( is_array( $message ) || is_object( $message ) ){
	        error_log( print_r( $message, true ) );
	      } else {
	        error_log( $message );
	      }
	    }
	  }
	}
	

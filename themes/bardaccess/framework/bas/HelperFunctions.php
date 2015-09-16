<?php

/*--------------------------------------*/
/* Helper Functions
/*--------------------------------------*/

    /**
     * Gets the current logged in users role
     *
     * @return string
     */
	if ( !function_exists('bas_get_user_role') ) {
		function bas_get_user_role() 
		{
		    global $current_user;
		    $user_roles = $current_user->roles;
		    $user_role = array_shift($user_roles);
		
		    return $user_role;
		}
	}

    /**
     * Gets the current logged in users role
     *
     * @return string
     */
	if ( !function_exists('bas_get_logo') ) {
		function bas_get_logo() 
		{
			// check if isset logo, else 
			$siteLogo = get('site_logo');
			if (isset($siteLogo) && ($siteLogo != '')){
				return '<img src="'.wp_get_attachment_url($siteLogo).'" class="site-logo">';
			}

		    return get_bloginfo('name');
		}
	}


	/**
	 * Get the BAS Sidebars
	 * 
	 * @return var
	 */
	if ( !function_exists('bas_get_sidebar') ) {
		function bas_get_sidebar($name='sidebar', $class='') {
			if( is_active_sidebar( $name ) ) {
				?>
				<div class="widget-wrap">
					<div class="container">
						<div class="<?php echo $class; ?> widget-area clearfix">
						<?php dynamic_sidebar( $name ); ?>
						</div><!-- .widget-area -->
					</div><!-- .container -->
				</div><!-- .widget-wrap -->
				<?php
			}
		}
	}	


	/**
	 * Customize the Read More Link
	 * 
	 * @return string
	 */
	if ( !function_exists('bas_customize_read_more') ) {
		function bas_customize_read_more($output) {
			return $output . '<a class="more-link" href="' . get_permalink() . '">Read More</a>';
		}
		add_filter( 'the_content_more_link', 'bas_customize_read_more' );
		add_filter( 'the_excerpt', 'bas_customize_read_more' );
	}
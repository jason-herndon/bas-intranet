<?php

/*--------------------------------------*/
/* ADD BP FRAMEWORK TO MY PAGES
/*--------------------------------------*/

	define('BP_MYIDP_SLUG', 'myidp');

	function bp_show_myidp_page() {
		
		global $bp, $current_blog;
	
		if ( $bp->current_component == BP_MYIDP_SLUG && $bp->current_action == '' ) {
		
			// The first variable here must match the name of your template file below
			bp_core_load_template( 'myidp', true );
		
		}
	
	}
	
	add_action( 'wp', 'bp_show_myidp_page', 2 );



/*--------------------------------------*/
/* Custom BP Layout
/*--------------------------------------*/

	function tricks_change_bp_tag_position()
	{
		global $bp;
		$bp->bp_nav['activity']['position'] = 10;
		$bp->bp_nav['messages']['position'] = 30;
		$bp->bp_nav['notifications']['position'] = 40;
		$bp->bp_nav['friends']['position'] = 50;
		$bp->bp_nav['groups']['position'] = 60;
		//$bp->bp_nav['profile']['position'] = 20;
		//$bp->bp_nav['forum']['position'] = 20;
		//$bp->bp_nav['posts']['position'] = 40;
		//$bp->bp_nav['blogs']['position'] = 60;
		$bp->bp_nav['settings']['position'] = 100;
		
		$bp->bp_nav['profile']['css_id'] = 'hide';
		$bp->bp_nav['author']['css_id'] = 'hide';
	
	}
	
	add_action( 'bp_init', 'tricks_change_bp_tag_position', 999 );

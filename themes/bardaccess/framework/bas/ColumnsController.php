<?php 
/**
 * Figures Dynamic Column Width
 */

if ( !function_exists('bas_columns') ) {
	function bas_columns( $columns = '', $echo = true, $sidebar = false, $sidebar_id = null, $push_pull = 0 ) {

		// add push/pull columns
		$pushpull = '';
		if ( $push_pull > 0 ) {
			$pushpull = ' push-' . intval( $push_pull );
		} elseif ( $push_pull < 0 ) {
			$pushpull = ' pull-' . intval( abs( $push_pull ) );
		}

		// if array of 2 numbers is passed to the function
		if ( $columns && is_array( $columns ) ) {
			echo 'large-' . intval( $columns[0] ) . ' small-' . intval( $columns[1] ) . $pushpull . ' columns';
			return;
		}
		// if just a number is passed to the function
		elseif ( $columns ) {
//			echo 'large-' . intval( $columns ) . ' small-12' . $pushpull . ' columns';
			echo 'large-' . intval( $columns ) . ' medium-' . intval( $columns) . ' small-12' . $pushpull . ' columns';
			return;
		}

		
		// get the template layout from meta
		$default = bas_option('page_layout', '2c-l');
		$layout = bas_option('', $default, '_template_layout');
		
		if ( is_page_template('page-templates/side-menu.php') ) {
			$layout = 'side-menu';
		}
		
		// check if tumblog icons are used in blog
		$tumblog = bas_option('tumblog_icons', false);
			
		// else check if columns are for a sidebar
		if ( true == $sidebar ) {

			// sidebar columns based on layout
			switch ( $layout ) {
				case '1c': 
					$classes[] = '';
					break;
				case '3c-l':
				case '3c-r':
				case '3c-c':
					$classes[] = 'large-3';
					break;
				case 'side-menu':
					if ( 'accordion' == bas_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-3';
					} elseif ( 'side_nav' == bas_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-2';
					}
					break;
				default:
					// 4 is the default number of columns for 1 sidebar
					$classes[] = 'large-4 medium-4 small-12';
					break;
			}
				
			// pull the content above left sidebar on small screens
			if ( '3c-r' == $layout ) {
				$classes[] = 'pull-6';
			}
			elseif ( '3c-c' == $layout && 1 == $sidebar_id ) {
				$classes[] = 'pull-6';
			}
			elseif ( '2c-r' == $layout ) {
				$classes[] = 'pull-8';
			}

		// else apply columns based on template layout or meta
		} else {

			// number of columns for main content based on layout		
			switch ( $layout ) {
				case '1c':
					// subtract 1 and offset by 1 if using tumblog icons
					if ( $tumblog && is_home() ) {
						$classes[] = 'large-11';
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-12';
					}
					break;
				case '3c-l':
				case '3c-r':
				case '3c-c':
					// subtract 1 and offset by 1 if using tumblog icons
					if ( $tumblog && is_home() ) {
						$classes[] = 'large-5';
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-6';
					}
					break;
				case 'side-menu':
					if ( 'accordion' == bas_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-9';
					} elseif ( 'side_nav' == bas_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-10';
					}
					break;
				default:
					/* 8 is the default number of columns for a page with 1 sidebar
					subtract 1 and offset by 1 if using tumblog icons */
					if ( $tumblog && is_home() ) {
						$classes[] = 'large-7';
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-8 medium-8 small-12';
					}
					break;
			}
				
			// push columns for left sidebars	
			switch ( $layout ) {
				case '3c-r':
					$classes[] = 'push-6';
					break;
				case '3c-c':
					$classes[] = 'push-3';
					break;
				case '2c-r':
					$classes[] = 'push-4';
					break;
			}
		}
		
		//always add the columns class
		$classes[] = 'columns';
		
		// remove empty values
		$classes = array_filter( $classes );
			
		// add spaces
		$columns = implode( ' ', array_map( 'esc_attr', $classes ) );
		
		// echo classes unless echo false
		if ( false == $echo ) {
			return apply_filters('content_cols', $columns);
		} else {
			echo apply_filters('content_cols', $columns);
		}
	}
}
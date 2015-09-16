<?php
/**
 * Menu Walkers
 * @package BAS
 * adapted from the now-depricated bas package
 */

/**
 * Nav Bar Walker
 */
class Nav_Bar_Walker extends Walker_Nav_Menu {
	
	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	*/
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul class="dropdown">';
    }	
	
	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		// close .side-nav .content and .section
		$output .= '</ul>';
	}
	
    /**
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  
		  // Slugify the Title
		  $title = strtolower(str_replace(' ', '-', $item->title));

          $class_names = $value = '';
  
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-hover-' . $title;
          $classes[] = 'menu-item-' . $item->ID;
		  $classes[] = ( $depth == 0 ) ? 'title' : '';
		  $classes[] = ( $args->has_children ) ? 'has-dropdown' : '';
		  $classes[] = ( in_array('current-menu-item', $classes) && !in_array('active', $classes) ) ? 'active' : '';
		  
  
          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
  
          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
  		  
		  // create sections
		  // $section_class = ( $depth == 0 && in_array('active', $classes) ) ? 'section active' : 'section';
		  $output .= ( $depth == 0 ) ? '<li class="divider">' : '';

		  // if top level use p.title else use li in dropdown
          $output .= ( $depth == 0 ) ? '<li data-section-title="'.$title.'"' . $id . $value . $class_names .'>' : '<li' . $id . $value . $class_names .'>';
  
          $attributes  = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
          $attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
          $attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		  
		  // if top level and has dropdown do not use url
		  if ( $depth == 0 && $args->has_children ) {
          	$attributes .= ' href="#"';
		  }
		  // else use url
		  elseif ( !empty( $item->url ) ) {
		  	$attributes .= ' href="' . esc_attr( $item->url ) . '"';
		  }
  		
          $item_output = $args->before;
          $item_output .= '<a'. $attributes .'>';
          $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
          $item_output .= '</a>';
          $item_output .= $args->after;
		  
		  // close .section if there is no dropdown
		  $item_output .= ( $depth == 0 && !$args->has_children ) ? '</li>' : '';
  
          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth > 0 ) {
			$output .= "</li>";
		}
	}
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
		$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    } 	  
	
}



/**
 * Nav Bar Walker
 */
class Nav_Bar_Footer_Walker extends Walker_Nav_Menu {
	
	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	*/
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul class="dropdown">';
    }	
	
	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		// close .side-nav .content and .section
		$output .= '</ul>';
	}
	
    /**
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  
          $class_names = $value = '';
  
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-item-' . $item->ID;
		  $classes[] = ( $depth == 0 ) ? 'title' : '';
		  $classes[] = ( $args->has_children ) ? 'has-dropdown' : '';
		  $classes[] = ( in_array('current-menu-item', $classes) && !in_array('active', $classes) ) ? 'active' : '';
		  
  
          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
  
          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
  		  
		  // create sections
		  // $section_class = ( $depth == 0 && in_array('active', $classes) ) ? 'section active' : 'section';
		  $output .= ( $depth == 0 ) ? '<li class="divider">' : '';
		  
		  // if top level use p.title else use li in dropdown
          $output .= ( $depth == 0 ) ? '<li data-section-title' . $id . $value . $class_names .'>' : '<li' . $id . $value . $class_names .'>';
  
          $attributes  = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
          $attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
          $attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		  
		  // if top level and has dropdown do not use url
		  if ( $depth == 0 && $args->has_children ) {
          	$attributes .= ' href="#"';
		  }
		  // else use url
		  elseif ( !empty( $item->url ) ) {
		  	$attributes .= ' href="' . esc_attr( $item->url ) . '"';
		  }
  		
          $item_output = $args->before;
          $item_output .= '<a'. $attributes .'>';
          $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
          $item_output .= '</a>';
          $item_output .= $args->after;
		  
		  // close .section if there is no dropdown
		  $item_output .= ( $depth == 0 && !$args->has_children ) ? '</li>' : '';
  
          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth > 0 ) {
			$output .= "</li>";
		}
	}
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
		$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    } 	  
	
}

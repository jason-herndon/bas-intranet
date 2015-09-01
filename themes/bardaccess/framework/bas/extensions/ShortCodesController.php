<?php
/*--------------------------------------*/
/* Register Custom Shortcodes
 *
 * Alerts
 * Buttons
 * Columns
 * Flex Video
 * Gallery ( replaces WP shortcode of the same name for a Foundation friendly one )
 * Labels
 * Panels
 * Price Tables
 * Price Table Items
 * Progress Bars
 * Reveal Modals
 * Section Groups
 * Sections
 * Tooltips
 * Event
 * FAQ
 * Slider
 * (Filter for adding shortcodes in the_content loops)
/*--------------------------------------*/

/**
 * Alerts
 */
if ( !function_exists('bas_add_alerts') ) {
	function bas_add_alerts( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'type'  => '',     // standard, success, alert, secondary
			'shape' => '',     // radius, round
			'close' => 'true', // add X to close alert
			'class' => ''
		 ), $atts ) );
		 
		$class_array[] = ( $shape ) ? $shape : '';
		$class_array[] = ( $type ) ? $type : '';
		$class_array[] = ( $class ) ? $class : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );
		 
		$output  = '<div class="alert-box ' . $classes . '">';
		$output .= do_shortcode( $content );
		$output .= ( 'false' != $close ) ? '<a class="close" href="">&times;</a>' : '';
		$output .= '</div>';
			
		return $output;
	}
}

/** 
 * Buttons
 */
if ( !function_exists('bas_add_buttons') ) {
	function bas_add_buttons( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'url'     => '#',      // target for the button
			'size'     => 'medium', // tiny, small, medium, large
			'shape'    => '',       // radius, round
			'type'     => '',       // standard, success, alert, secondary
			'disabled' => 'false',
			'expand'   => 'false',
			'class'    => '',       // optional CSS class
			'target'   => '',
		 ), $atts ) );
		
		$class_array = array();
		$class_array[] = ( $size ) ? $size : '';
		$class_array[] = ( $shape ) ? $shape : '';
		$class_array[] = ( $type ) ? $type : '';
		$class_array[] = ( $class ) ? $class : '';
		$class_array[] = ( 'true' == $disabled ) ? 'disabled' : '';
		$class_array[] = ( 'true' == $expand ) ? 'expand' : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );
		
		$target = ( $target ) ? ' target="' . $target . '"' : '';
		
		$output  = '<a class="' . $classes . ' button" href="' . $url . '"' . $target .'>';
		$output .= $content;
		$output .= '</a>';
			
		return $output;
	}
}

/**
 * Columns
 */
if ( !function_exists('bas_add_columns') ) {
	function bas_add_columns( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'first_last' => '', // first or last
			'large' => '',
			'small' => ''
			 ), $atts ) );
		 
		switch( $large ) {
			case '12'   : $large = 'large-12'; break;
			case '11'   : $large = 'large-11'; break;
			case '10'   : $large = 'large-10'; break;
			case '9'    : $large = 'large-9'; break;
			case '8'    : $large = 'large-8'; break;
			case '7'    : $large = 'large-7'; break;
			case '6'    : $large = 'large-6'; break;
			case '5'    : $large = 'large-5'; break;
			case '4'    : $large = 'large-4'; break;
			case '3'    : $large = 'large-3'; break;
			case '2'    : $large = 'large-2'; break;
			case '1'    : $large = 'large-1'; break;
		}
		
		switch( $small ) {
			case '12'   : $small = ' small-12'; break;
			case '11'   : $small = ' small-11'; break;
			case '10'   : $small = ' small-10'; break;
			case '9'    : $small = ' small-9'; break;
			case '8'    : $small = ' small-8'; break;
			case '7'    : $small = ' small-7'; break;
			case '6'    : $small = ' small-6'; break;
			case '5'    : $small = ' small-5'; break;
			case '4'    : $small = ' small-4'; break;
			case '3'    : $small = ' small-3'; break;
			case '2'    : $small = ' small-2'; break;
			case '1'    : $small = ' small-1'; break;
		}
		
		$output  = '';
		$output .= ( $first_last == 'first' || $first_last == 'both') ? '<div class="row">' : '';
		$output .= '<div class="' . $large . $small . ' columns">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= ( $first_last == 'last' || $first_last == 'both' ) ? '</div>' : '';
			
		return $output;
	}
}

/**
 * Flex Videos
 */
if ( !function_exists('bas_add_flex_video') ) {
	function bas_add_flex_video( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'widescreen' => 'true',
			'vimeo'      => 'false'
		 ), $atts ) );
		
		$class_array = array();
		$class_array[] = ( $widescreen == 'true' ) ? 'widescreen' : '';
		$class_array[] = ( $vimeo == 'true' ) ? 'vimeo' : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );	
		
		$output  = '<div class="flex-video ' . $classes . '">';
		$output .= $content;
		$output .= '</div>';
			
		return $output;
	}
}

/**
 * Gallery
 */
remove_shortcode('gallery');
if ( !function_exists('bas_add_custom_gallery') ) {
	function bas_add_custom_gallery( $attr ) {
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( !empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters( 'post_gallery', '', $attr );
		if ( $output != '' )
			return $output;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract( shortcode_atts( array( 
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'ul',
			'icontag'    => 'li',
			'captiontag' => 'li',
			'columns'    => 4,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		 ), $attr ) );

		$id = intval( $id );
		if ('RAND' == $order )
			$orderby = 'none';

		if ( !empty( $include ) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		}elseif ( !empty( $exclude ) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}else{
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}

		if ( empty( $attachments ) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			return $output;
		}

		$itemtag = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$columns = intval( $columns );
		$itemwidth = $columns > 0 ? floor( 100/$columns ) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$selector = "gallery-{$instance}";

		$size_class = sanitize_html_class( $size );
		$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		$output = apply_filters('gallery_style', $gallery_div );

		$i = 0;
		$grid = $columns;
		$clearing = ( isset( $attr['link'] ) && 'file' == $attr['link'] ) ? 'data-clearing' : '';
		
		$output .= "<{$itemtag} class='large-block-grid-{$grid} small-block-grid-2 gallery-item clearing-thumbs' {$clearing}>";
		
		foreach ( $attachments as $id => $attachment ) {
			$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
			
			$output .= "
				<{$icontag} class='gallery-icon'>
					$link
				</{$icontag}>";
			if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					".wptexturize( $attachment->post_excerpt )."
					</{$captiontag}>";
			}
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<br style="clear: both" />';
		}

		$output .= "</{$itemtag}>";
		$output .= "</div>\n";

		return $output;
	}
}


/**
 * Labels
 */
if ( !function_exists('bas_add_labels') ) {
	function bas_add_labels( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'type'  => '', // standard, success, alert, secondary
			'shape' => '', // radius, round
			'class' => ''
		 ), $atts ) );
		 
		$class_array[] = ( $shape ) ? $shape : '';
		$class_array[] = ( $type ) ? $type : '';
		$class_array[] = ( $class ) ? $class : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );	
		
		$output  = '<span class="' . $classes . ' label">';
		$output .= do_shortcode( $content );
		$output .= '</span>';
			
		return $output;
	}
}

/**
 * Panels
 */
if ( !function_exists('bas_add_panels') ) {
	function bas_add_panels( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'shape'   => '',      // square, radius
			'callout' => 'false', // true for a brighter panel
			'class'   => ''
			 ), $atts ) );
			
		$class_array = array();
		$class_array[] = ( $shape ) ? $shape : '';
		$class_array[] = ( $callout == 'true') ? 'callout' : '';
		$class_array[] = ( $class ) ? $class : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );	

		$output  = '<div class="' . $classes . ' panel">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
			
		return $output;	
	}
}

/**
 * Price Tables
 */
if ( !function_exists('bas_add_price_tables') ) {
	function bas_add_price_tables( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'title' => 'Title',
			'price' => '0.00',
			'desc'  => '',
			'url'   => '#',
			'button' => 'Buy Now'
		 ), $atts ) );
		 
		$output  = '<ul class="pricing-table">';
		$output .= '<li class="title">' . $title . '</li>';
		$output .= '<li class="price">' . $price . '</li>';
		$output .= ( $desc ) ? '<li class="description">' . $desc . '</li>' : '';
		$output .= do_shortcode( $content );
		$output .= '<li class="cta-button"><a class="button" href="' . $url . '">' . $button . '</a></li>';
		$output .= '</ul>';
			
		return $output;
	}
}

/**
 * Price Table Items
 */
if ( !function_exists('bas_add_price_table_items') ) {
	function bas_add_price_table_items( $atts, $content = null ) {
		extract( shortcode_atts( array( 
		 ), $atts ) );
		 
		$output  = '<li class="bullet-item">';
		$output .= do_shortcode( $content );
		$output .= '</li>';
			
		return $output;
	}
}

/**
 * Progress Bars
 */
if ( !function_exists('bas_add_progress_bars') ) {
	function bas_add_progress_bars( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'shape'   => '', // square, radius, round
			'type'    => '', // standard, success, alert, secondary
			'columns' => '', // number of grid columns for overall length
			'fill'    => ''  // width of the fill meter in percent
		 ), $atts ) );
		
		$class_array = array();
		$class_array[] = ( $shape ) ? $shape : '';
		$class_array[] = ( $type ) ? $type : '';
		$class_array[] = ( $columns ) ? 'large-' . $columns : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );
		
		$output  = '<div class="progress ' . $classes . '">';
		$output .= '<span class="meter" style="width:' . $fill . '">';
		$output .= do_shortcode( $content );
		$output .= '</span>';
		$output .= '</div>';
			
		return $output;
	}
}

/**
 * Reveal Modals
 */
if ( !function_exists('bas_add_reveal_modals') ) {
	function bas_add_reveal_modals( $atts, $content = null ) {
		global $post;
		extract( shortcode_atts( array( 
			'button'         => 'false', // whether or not the link is a button
			'text'           => 'Click here', // text for link or button
			'size'           => '' // tiny, small, medium, large, xlarge
			 ), $atts ) );
			
		$unique_id = $post->ID . '-' . rand( 1000, 9999 );
		$class = ( $button == 'true') ? 'class="button"' : '';
		$output  = '<a href="#" ' . $class . ' data-reveal-id="' . $unique_id . '">' . $text . '</a>';
	        
		$reveal_output  = '<div id="' . $unique_id . '" class="reveal-modal ' . $size . ' shortcode-modal">';
		$reveal_output .= do_shortcode( $content );
		$reveal_output .= '<a class="close-reveal-modal">&#215;</a>';
		$reveal_output .= '</div>';

		$GLOBALS['reveal_content'][] = $reveal_output;
			
		return $output;
	}

	if ( !function_exists('reveal_footer_content') ) {
		function reveal_footer_content() {
		    if ( !empty( $GLOBALS['reveal_content'] ) ) {
		        echo "\n".'<!-- [reveal_modal] shortcode output -->';
		       
			    foreach ( $GLOBALS['reveal_content'] as $output ) {
		            echo "\n" . $output;
		        }
		       
			    echo "\n" . '<!-- / end [reveal_modal] output -->' . "\n";
		    }
		}
	}
	add_action('wp_footer', 'reveal_footer_content');
}

/**
 * Section Groups
 */
if ( !function_exists('bas_add_section_groups') ) {
	function bas_add_section_groups( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'type' => 'tabs', // tabs, accordion, veritcal-nav, horizontal-nav
			'options' => ''
			 ), $atts ) );
		
		$GLOBALS['tab_count'] = 1;
		$GLOBALS['tabs'] = '';
		$output = ''; $count = 1;
		
		$type = ( 'vertical' == $type ) ? 'vertical-nav' : $type;
		$data_options = ( $options ) ? ' data-options="' . $options . '"' : '';
		
		do_shortcode( $content );

		if ( is_array( $GLOBALS['tabs'] ) ) {
			foreach ( $GLOBALS['tabs'] as $tab ) {
				$tabs[] = '<div class="section' . $tab['active'] .'">
				<p class="title' . $tab['active'] . '"><a class="" href="#panel' . $count . '">' . $tab['title'] . '</a></p>
				<div class="content" data-slug="panel' . $count . '">' . $tab['content'] . '</div>
				</div>';
				$count++;
			}
			$output .= '<div class="section-container ' . $type . '" data-section="' . $type . '"' . $data_options . '>';
			$output .= implode( "\n", $tabs );
			$output .= '</div>';
		}
		return $output;
	}
}

/**
 * Sections
 */
if ( !function_exists('bas_add_sections') ) {
	function bas_add_sections( $atts, $content = null ) {
	extract( shortcode_atts( array( 
		'active' => 'false',
		'title'  => 'Section %d'
		 ), $atts ) );
		 
		$active = ( $active == 'true' ) ? ' active' : '';
		
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array('active' => $active, 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content);
		$GLOBALS['tab_count']++;
	}
}

/**
 * Tooltips
 */
if ( !function_exists('bas_add_tooltips') ) {
	function bas_add_tooltips( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'position' => '', // bottom ( deftault ), top, right, left
			'width'    => '', // set the width
			'class'    => '',
			'text'     => 'Add some tooltip text' // add text to the tooltip
		 ), $atts ) );
		
		$class_array = array();
		$class_array[] = ( $position ) ? 'tip-' . $position : '';
		$class_array[] = ( $class ) ? $class : '';
		$class_array = array_filter( $class_array );
		$classes = implode( ' ', $class_array );
		
		$output  = '<span data-tooltip class="has-tip ' . $classes . '"';
		if ( $width ) {$output .= ' data-width="' . $width . '"';}
		$output .= ' title="' . $text . '">';
		$output .= do_shortcode( $content );
		$output .= '</span>';
			
		return $output;
	}
}

/**
 * Events
 */
if ( !function_exists('bas_add_events') ) {
	function bas_add_events($atts, $content = null) {
		// Get the attributes
	    extract(shortcode_atts(array(
	        "only" => '',
	        "category" => '',
	        "div_wrapper" => '',
	        "event_class" => '',
	        "style" => '',
	        "exclude" => '',
	    ), $atts));

		if ((isset($atts['exclude'])) && ($atts['exclude'] != '')) { $exclude = explode(',', $atts['exclude']); }
		if ((isset($atts['only'])) && ($atts['only'] != '')) { $only = explode(',', $atts['only']); }
		if ((isset($atts['category'])) && ($atts['category'] != '')) { $category = explode(',', $atts['category']); }
		if (isset($atts['div_wrapper'])) { $divClass = $atts['div_wrapper']; } else { $divClass = ''; }
		if (isset($atts['event_class'])) { $eventClass = $atts['event_class']; } else { $eventClass = ''; }

	    // Do the query
	    $args = array( 
			'post_type'           => 'event',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => 1,
			'post__in'		  	  => $only,
			'post__not_in'		  => $exclude,
			'category__in'		  => $category,
			);
		
		global $event_query;
	    $event_query = new WP_Query( $args );
	    $numPosts = count($event_query);    
	    
	    $eventOutput = '';
	    if ( $event_query->have_posts() ) :
			?><div class="event-wrapper <?php echo $divClass; ?>"><?php
	            while ( $event_query->have_posts() ) : $event_query->the_post(); 
					?><div class="event-box <?php echo $eventClass; ?>"><a href=""><?php the_title(); ?></a></div><?php
	            endwhile; // end of the loop 
			  ?></div><?php // close the block-grid
	            
	    // if no posts are found
		else :
	    endif; // end have_posts() check
	     wp_reset_query();

	    // Return the data
	    return $eventOutput;
	}
}

/**
 * FAQs
 */
if ( !function_exists('bas_add_faqs') ) {
	function bas_add_faqs($atts, $content = null) {
		// Get the attributes
	    extract(shortcode_atts(array(
		    'div_class' => '',
		    'faq_class' => '',
	    ), $atts));

	    // Do the query
	    $args = array( 
			'post_type'           => 'faq',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => 1,
		);

		if (isset($atts['div_class'])) { $divClass = $atts['div_class']; } else { $divClass = ''; }
		if (isset($atts['faq_class'])) { $faqClass = $atts['faq_class']; } else { $faqClass = ''; }
		
		global $faq_query;
	    $faq_query = new WP_Query( $args );
	    $numPosts = count($faq_query);    
	       
	    if ( $faq_query->have_posts() ) :
			?><div class="faq-wrapper section-container accordion <?php echo $divClass; ?>" data-section="accordion"><?php
	            while ( $faq_query->have_posts() ) : $faq_query->the_post(); 
					?>
					  <section class="<?php echo $faqClass; ?>">
					    <p class="title" data-section-title><a href="#"><?php the_title(); ?></a></p>
					    <div class="content" data-section-content>
					      <p><?php the_content(); ?></p>
					    </div>
					  </section>
					<?php
	            endwhile; // end of the loop 
			?></div><?php // close the block-grid
	            
	    // if no posts are found
		else : 
	    endif; // end have_posts() check
	    wp_reset_query();

	}
}



/**
 * Sliders
 */
if ( !function_exists('bas_add_sliders') ) {
	function bas_add_sliders($atts, $content = null) {
		// Get the attributes - See http://www.owlgraphic.com/owlcarousel/index.html for more options for OWL JS and Wordpress.org for more on the WP Query
	    extract(shortcode_atts(array(
	    	// Core Features
		    'items' => '', // Number of Items
		    'itemsCustom' => '', // True or False
		    'itemsDesktop' => '',
		    'itemsDesktopSmall' => '',
		    'itemsTabletSmall' => '',
		    'itemsMobile' => '',
		    'singleItem' => '', // True or False to show one item
		    'itemsScaleUp' => '',

		    // Basic Speeds
		    'slideSpeed' => '', // Slide Speed in miliseconds (eg. 300)
		    'paginationSpeed' => '', // Speed at which pages change (eg. 400)
		    'rewindSpeed' => '', // (eg. 1000)

		    // Autoplay
		    'autoPlay' => '', // True or False to Autoplay
		    'stopOnHover' => '', // True or False to stop slider on mouse hover

		    // Navigation
		    'navigation' => '', // True or False to show/hide the navigation
		    'navigationText' => '', // Array of values to use for nav (eg. ["next", "prev"])
		    'rewindNav' => '',
		    'scrollPerPage' => '',

		    // Pagination
		    'pagination' => '', // True or False
		    'paginationNumbers' => '', // True or False

		    // Responsive
		    'responsive' => '', // True or False to make slider repsonsive
		    'responsiveRefreshRate' => '', // (eg. 200)
		    'responsiveBaseWidth' => '', // (eg. window)

		    // CSS Styles
		    'baseClass' => '', // Class to use for the base (eg. owl-carousel)
		    'theme' => '', // (eg. owl-theme)

		    // Lazy load
		    'lazyLoad' => '', // True or False
		    'lazyFollow' => '', // True or False
		    'lazyEffeect' => '', // (eg: fade)

		    // Auto Height
		    'autoHeight' => '', // True or False to resize slider to each image height

		    // JSON
		    'jsonPath' => '', // True or False
		    'jsonSuccess' => '', // True or False

		    // Mouse Events
		    'dragBeforeAnimFinish' => '', // True or False
		    'mouseDrag' => '', // True or False
		    'touchDrag' => '', // True or False

		    // Transitions
		    'transitionStyle' => '', // True or False

		    // Other
		    'addClassActive' => '', // True or False

		    // Callbacks
		    'beforeUpdate' => '', // True or False
		    'afterUpdate' => '', // True or False
		    'beforeInit' => '', // True or False
		    'afterInit' => '', // True or False
		    'beforeMove' => '', // True or False
		    'afterMove' => '', // True or False
		    'afterAction' => '', // True or False
		    'startDragging' => '', // True or False
		    'afterLazyLoad' => '', // True or False

		    // WP Query
		    'category' => '', // Name of category
		    'id' => '', // ID to give to the slider
		    'only' => '', // IDs of posts to include
		    'exclude' => '', // IDs of posts to exclude
	    ), $atts));

		if ((isset($atts['exclude'])) && ($atts['exclude'] != '')) { $exclude = explode(',', $atts['exclude']); } else { $only = ''; }
		if ((isset($atts['only'])) && ($atts['only'] != '')) { $only = explode(',', $atts['only']); } else { $only = ''; }
		if ((isset($atts['category'])) && ($atts['category'] != '')) { $category = explode(',', $atts['category']); } else { $category = ''; }

	    // Do the query
	    $slider_args = array( 
			'post_type'           => 'slide',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => 1,
			'post__in'		  	  => $only,
			'post__not_in'		  => $exclude,
			'category__in'		  => $category,
		);

		global $slider_query;
	    $slider_query = new WP_Query( $slider_args );
	       
	    if ( $slider_query->have_posts() ) :
			?><div id="<?php echo $atts['id']; ?>" class="owl-carousel owl-theme"><?php
	            while ( $slider_query->have_posts() ) : $slider_query->the_post();
					?>
					<div class="item">
						<div class="item-caption">
							<?php the_title(); ?>
							<?php the_content(); ?>
						</div>					                		
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('full');
						} ?>
					</div>
					<?php
	            endwhile; // end of the loop 
			?></div>
			<style>
			    #slider-homepage .item img{
			        display: block;
			        width: 100%;
			        height: auto;
			    }
			</style>
			<?php // close the block-grid
    		// ADD THE JAVASCRIPT
			bas_create_owl_slider_javascript($atts);	            
	    // if no posts are found
		else : 
	    endif; // end have_posts() check
	    wp_reset_query();

	}
}


function register_shortcodes() {
	add_shortcode('alert', 'bas_add_alerts');
	add_shortcode('button', 'bas_add_buttons');
	add_shortcode('column', 'bas_add_columns');
	add_shortcode('flex_video', 'bas_add_flex_video');
	add_shortcode('gallery', 'bas_add_custom_gallery');
	add_shortcode('label', 'bas_add_labels');
	add_shortcode('panel', 'bas_add_panels');
	add_shortcode('price_table', 'bas_add_price_tables');
	add_shortcode('pt_item', 'bas_add_pt_items');
	add_shortcode('progress_bar', 'bas_add_progress_bars');
	add_shortcode('reveal_modal', 'bas_add_reveal_modals');
	add_shortcode('section_group', 'bas_add_section_groups');
	add_shortcode('section', 'bas_add_sections');
	add_shortcode('tooltip', 'bas_add_tooltips');
	add_shortcode("events", "bas_add_events");
	add_shortcode("faqs", "bas_add_faqs");
	add_shortcode("slider", "bas_add_sliders");
}
add_action('init', 'register_shortcodes');

/**
 * Remove br and p tags around shorcodes
 */
if ( !function_exists('bas_clean_shortcodes') ) {
	function bas_clean_shortcodes( $content ) {   
		$array = array ( 
			'<p>['    => '[', 
			']</p>'   => ']', 
			']<br />' => ']'
		);
		$content = strtr( $content, $array );
		return $content;
	}
	add_filter('the_content', 'bas_clean_shortcodes');
}

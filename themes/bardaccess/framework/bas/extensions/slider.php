
<?php

if ( !function_exists('reactor_slider') ) {
	function reactor_slider( $args = '' ) {

		$defaults = array(
			'orderby'        => 'date',
			'order'          => 'DESC',
			'category'       => '',
			'field'          => 'id',
			'posts_per_page' => -1,
			'slider_id'      => '',
			'data_options'   => '',
			'echo'           => true,
			'bullets'		 => false,
			'small'			 => false,
		 );
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'reactor_slider_args', $args );
		
		// customizer can return a value of -1
		if ( -1 == $args['category'] ) {
			 $args['category'] = '';
		}
		
		$slider_id = ( $args['slider_id'] ) ? ' id="' . $args['slider_id'] . '"' : '';
		$isMobile = $args['small'];
		
  		// if specific category is passed to args use tax_query
		if ( $args['category'] ) {
			$tax_args = array( 
				array( 
					'taxonomy' => 'slide-category',
					'field'    => $args['field'],
					'terms'    => $args['category'],
					'operator' => 'IN'
				 )
			 );
		} else {
			$tax_args = false;
		}
		
		// start the slider loop
		$query_args = array( 
			'post_type'      => 'slide',
			'orderby'        => $args['orderby'],
			'order'          => $args['order'],
			'posts_per_page' => $args['posts_per_page'],
			'tax_query'      => $tax_args
		 );
		
		global $slider_query;
		$slider_query = new WP_Query( $query_args );
		$output = ''; $slide = ''; $caption = '';
		
		if ( is_array( $args['data_options'] ) ) {
			$options_array = array();
			foreach ( $args['data_options'] as $key => $value ) {
				$options_array[] = $key . ':' . $value;
			}
			$options = implode( '; ', $options_array );
			$data_options = ' data-options="' . $options . '"';
		} else {
			$data_options = '';
		}
		
		if ( $slider_query->have_posts() ) : 
			$output .= '<div class="slideshow-wrapper">';
			$output .= '<div class="preloader"></div>';
            $output .= '<ul' . $slider_id . ' data-orbit' . $data_options . '>';
			
            while ( $slider_query->have_posts() ) : $slider_query->the_post();
			    $post_id = get_the_ID();
				$slide_url = get_post_meta( $post_id, '_slide_url', true );
				$mobile_url = get_post_meta( $post_id, '_mobile_image', true );
				
				$output .= '<li>';
				if ( $slide_url ) {
					$slide_title = '<a href="' . $slide_url . '">';
				}

					// if slide post has a thumbnail use that as the slide
	                if ( has_post_thumbnail() ) {			
	                    $img_id = get_post_thumbnail_id( $post_id );
						$img_url = wp_get_attachment_url( $img_id );
					    $mobile_img = wp_get_attachment_url( $mobile_url );
	                    $alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
						
						//$output .= '<img data-interchange="['.$mobile_img.', (default)], ['.$img_url.', (only screen and (min-width:421px))]">';
						$output .= '<img data-interchange="['.$mobile_img.', (default)], ['.$img_url.', (only screen and (min-width:421px))]" src="'.$img_url.'">';
						
					// else use the content of the post for the slide	
	                } else {
	                    $output .= '<div class="slide-content">' . get_the_content() . '</div>';
	                }				
				
				if ( $slide_url ) {
					$slide_title = '<h4 class="slide-title"><a href="' . $slide_url . '">' . get_the_title() . '</a></h4>';
				} else {
					$slide_title = '<h4 class="slide-title">' . get_the_title() . '</h4>';
				}
				
				// if slide post has excerpt use it for the caption
					$output .= '<div class="orbit-caption hide-for-small">';
//					$output .= $slide_title;
// 					$output .= '<p class="slide-excerpt">' . get_the_excerpt() . '</p>';
					$output .= '<p class="slide-excerpt">' . get_the_content() . '</p>';
					$output .= '</div>';
				
				if ( $slide_url ) {
					$slide_title = '</a>';
				}
				
				$output .= '</li>';
				
        	endwhile; 
			$output .= '</ul></div>';
			
			if ( false == $args['echo'] ) {
				return apply_filters('reactor_slider', $output, $args);
			} else {
				echo apply_filters('reactor_slider', $output, $args);
			}
			
        endif; 
		wp_reset_postdata();
    }
}
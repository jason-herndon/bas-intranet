<?php
/**
 * The default sidebar
 * @package Bas
 */
?>

<!-- INCLUDE THE TOP BUTTONS -->
<div id="sidebar-bas-buttons">
	<ul class="stack button-group">
		<li><a href="#" class="button bas-btn btn-acct">My Account</a></li>
	  	<li><a href="#" class="button bas-btn btn-idp">My IDP/Success Tree</a></li>
	  	<li><a href="#" class="button bas-btn btn-training">My Training</a></li>
	</ul>
</div>


<!-- INCLUDE THE SIDEBAR BUTTONS -->
<div class="">
	<?php
	    // Do the query
	    $sidebar_images_args = array( 
			'post_type'           => 'sidebar-images',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => 1,
		);

		global $sidebar_images_query;
	    $sidebar_images_query = new WP_Query( $sidebar_images_args );
	       
	    if ( $sidebar_images_query->have_posts() ) :
			?><div id="sidebar-ads" class=""><?php
	            while ( $sidebar_images_query->have_posts() ) : $sidebar_images_query->the_post();
					?>
					<div class="ad-item">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('full');
						} ?>
					</div>
					<?php
	            endwhile; // end of the loop 
			?></div><?php // close the block-grid

	    // if no posts are found
		else : 
	    endif; // end have_posts() check
	    wp_reset_query();
	?>
</div>

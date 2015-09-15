<?php
/**
 * Footer file for blog posts
 */
?>

	<div class="older-posts">
		<?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); ?>
	</div>
	<div class="newer-posts">
		<?php echo get_previous_posts_link( 'Newer Entries' ); ?>
	</div>

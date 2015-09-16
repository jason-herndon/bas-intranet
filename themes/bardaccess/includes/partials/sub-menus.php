<?php
/* Template Part - Sub Menus
 * @package Bas
*/
?>

<div class="bas-sub-menu about-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_about_left_menu(); ?>
					<?php bas_get_about_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					<?php echo get('about_menu_feature'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bas-sub-menu news-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_news_left_menu(); ?>
					<?php bas_get_news_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					
					<?php 
					$newsArgs = array(
						'posts_per_page' => '1',
					);

					global $newsQuery;
					$newsQuery = new WP_Query( $newsArgs );

			        // The Wordpress Loop - if whave posts, while have posts, the post
			        if ( $newsQuery->have_posts() ) :
			            while ( $newsQuery->have_posts() ) :
			                $newsQuery->the_post();

			                // Post Content here
			            	?>
			            		<div class="menu-ad-header">
			            			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			            		</div>
			            		<div class="menu-ad-img">
					            	<?php if ( has_post_thumbnail() ) { the_post_thumbnail('small'); } ?>
			            		</div>
			            		<div class="menu-ad-desc">
			            			<?php 
			            				$excerpt = get_the_excerpt();
			            				echo substr($excerpt,0,120) . '... <a href="'.get_the_permalink().'">Read More</a>'; 
			            			?>
			            		</div>
			            	<?php

			            // end while loop
			            endwhile; 
			            // reset post data
			            wp_reset_postdata(); ?>
			        <?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="bas-sub-menu team-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_team_left_menu(); ?>
					<?php bas_get_team_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					<?php echo get('team_menu_feature'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bas-sub-menu faqs-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_faqs_left_menu(); ?>
					<?php bas_get_faqs_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					<div class="menu-ad-header">
            			<h3>Have a Question?</h3>
            		</div>
            		<div class="menu-ad-form">
            			<form action="">
            			<textarea></textarea>
            			<button class="button tiny" type="submit">Submit</button>
            			</form>
            		</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bas-sub-menu forms-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_forms_left_menu(); ?>
					<?php bas_get_forms_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					<?php echo get('forms_menu_feature'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bas-sub-menu resources-sub-menu">
	<div class="row">
		<div class="<?php bas_columns(12); ?>">
			<div class="row">
				<div class="<?php bas_columns(8); ?>">
					<?php bas_get_resources_left_menu(); ?>
					<?php bas_get_resources_right_menu(); ?>
				</div>
				<div class="menu-ad-item <?php bas_columns(4); ?>">
					<?php echo get('resources_menu_feature'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
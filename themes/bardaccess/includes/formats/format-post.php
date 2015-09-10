<?php
/**
 * The template for displaying post content
 * @package Carbon
 */
?>

<article id="post-<?php the_ID(); ?>">
    <div class="entry-body">
        
        <header class="entry-header">
        	<?php the_title(); ?>
        </header><!-- .entry-header -->

        <?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php elseif ( is_single() ) : ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array('before' => '<div class="page-links">' . __('Pages:', 'bas'), 'after' => '</div>') ); ?>
        </div><!-- .entry-content --> 
        <?php else : ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>

        <footer class="entry-footer">
        	<?php bas_get_post_footer(); ?>
        </footer><!-- .entry-footer -->
        
    </div><!-- .entry-body -->
</article><!-- #post -->
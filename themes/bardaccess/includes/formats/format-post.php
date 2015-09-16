<?php
/**
 * The template for displaying post content
 * @package BAS
 */
?>

<article id="post-<?php the_ID(); ?>" class="<?php bas_columns(12); ?>">
    <div class="entry-body">
        
        <header class="entry-header">
            <div class="post-meta">
                <h1><?php the_title(); ?></h1>
                <h4><?php the_date('F jS, Y', '<span class="meta-detail">Posted</span> ', ''); ?> &middot; <?php echo get_the_term_list(get_the_ID(), 'category', '<span class="meta-detail">In</span> ', ', '); ?></h4>
            </div>
        </header><!-- .entry-header -->

        <?php 
        // IF COMING FROM SEARCH.php or ARCHIVE.php
        if ( is_search() || is_archive() ) : ?>
         
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
        
        <?php 
        // IF COMING FROM SINGLE.php
        elseif ( is_single() ) : ?>
          
            <div class="entry-featured">
                <?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content --> 
    
        <?php 
        // IF COMING FROM INDEX or Post Query
        else : ?>

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
    
        <?php endif; ?>

        <footer class="entry-footer">
            <?php get_template_part('includes/partials/post-footer'); ?>
        </footer><!-- .entry-footer -->
        
    </div><!-- .entry-body -->
</article><!-- #post -->
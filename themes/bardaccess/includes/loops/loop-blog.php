<?php
/**
 * Loop for blog posts
 */
?>

    <div class="row">
        <?php 
        // The Wordpress Loop - if whave posts, while have posts, the post
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                // Post Content here
                if ( !get_post_format() ) 
                {
                    get_template_part('includes/formats/format', 'post'); 
                } else {
                    get_template_part('includes/formats/format', get_post_format() ); 
                }

            // end while loop
            endwhile; ?>
        <?php else : ?>
            get_template_part('includes/partials/no-content'); 
        <?php endif; ?>
    </div>
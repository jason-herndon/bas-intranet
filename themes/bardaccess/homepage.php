<?php
/**
* Template Name: Homepage
* @package Carbon
*/
?>

<?php get_header(); ?>

    <?php

        $enabledHomePageRows = get('homepage_row_order');

        // Check to see if Homepage rows are extended
        if (count($enabledHomePageRows) > 0)
        {
            // Loop through each content type
            foreach ($enabledHomePageRows as $content)
            {
                // Include Homepage Content
                get_template_part('includes/partials/' . $content, 'home');   
            }
        }

    ?>

    <!-- Homepage Content Area -->
    <div class="row"> 

        <!-- Homepage Blog -->
        <div class="large-9 medium-9 small-12 columns">
    
            <!-- Include Homepage Blog Area -->
            <?php get_template_part('includes/loops/loop', 'blog') ?>        
    
        </div>

        <!-- Homepage Sideabar -->
        <div class="large-3 medium-3 small-12 columns">

            <?php get_sidebar('home'); ?>
   
        </div>

    </div>

    <?php get_footer(); ?>  
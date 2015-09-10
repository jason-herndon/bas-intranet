<?php
/**
 * The default homepage file
 * @package BAS
 */
?>

<?php get_header(); ?>

    <?php
        if ( is_front_page() )
        {

            // Include Homepage Slider Area
            get_template_part('includes/partials/slider', 'home');      

            // Include Homepage Feature Boxes Area
            get_template_part('includes/partials/feature-boxes', 'home');      

        // end if is front page
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
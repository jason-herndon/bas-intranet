<?php
/**
 * The default template file
 * @package BAS
 */
?>

<?php get_header(); ?>

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
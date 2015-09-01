<?php
/**
* Template Name: Homepage
* @package BAS
*/
?>

<?php get_header(); ?>

   <!-- Include Homepage Slider Area -->
    <?php get_template_part('includes/partials/slider', 'home') ?>        
 
   <!-- Include Homepage Feature Boxes Area -->
    <?php get_template_part('includes/partials/feature-boxes', 'home') ?>        

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
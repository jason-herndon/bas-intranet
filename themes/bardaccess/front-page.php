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

        <div class="homepage-content"></div>

        <!-- Homepage Blog -->
        <div class="homepage-blog <?php bas_columns(8); ?>">

            <?php 
                $homepageBlogImage = get('homepage_blog_header_image');
                if (isset($homepageBlogImage) && ($homepageBlogImage != '')) 
                {
                    ?>
                    <div class="homepage-blog-header">
                        <img src="<?php echo wp_get_attachment_url($homepageBlogImage); ?>">
                    </div>
                    <?php
                }
            ?>

            <h1>Other News</h1>
    
            <!-- Include Homepage Blog Area -->
            <?php get_template_part('includes/loops/loop', 'blog') ?>        

            <div class="button other-news-btn"><a href="/blog">Other News</a></div>
    
        </div>

        <!-- Homepage Sideabar -->
        <div class="<?php bas_columns(4); ?>">

            <?php get_sidebar(); ?>
   
        </div>

    </div>

<?php get_footer(); ?>  
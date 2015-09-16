<?php
/**
 * Slider template for the homepage
 * @package Bas
 */
?>
<div class="homepage-slider row">
	<div class="large-12 columns">
		<div class="menu-touch-area">
			<div class="slider-overlay"></div>
			<div class="slider-overlay-bottom">
				<?php get_template_part('includes/partials/sub-menus'); ?>
			</div>
		</div>
        <?php echo do_shortcode('[slider category="" id="slider-homepage" navigation="false" responsive="true" class="homepage-slider"][/slider]'); ?>
	</div>
</div>
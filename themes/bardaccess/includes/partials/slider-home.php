<?php
/**
 * Slider template for the homepage
 * @package Bas
 */
?>
<div class="homepage-slider row">
	<div class="large-12 columns">
		<div class="slider-overlay">
		</div>
        <?php echo do_shortcode('[slider category="" id="slider-homepage" navigation="false" responsive="true" baseClass="owl-carousel"][/slider]'); ?>
	</div>
</div>
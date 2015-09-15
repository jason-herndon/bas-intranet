jQuery(function(){
  "use strict";
  jQuery("a[rel^='prettyPhoto']").prettyPhoto({
  	social_tools:false,
  	theme: 'dark_square',
  });
  jQuery.noConflict();
  jQuery(document).foundation();
   	jQuery(document).ready(function() {
		jQuery('#slider-homepage').owlCarousel({
		    loop:true,
		    margin:10,
		    singleItem:true,
		    navigation:false,
		   // pagination:false,
		    autoPlay: true,
		    rewindSpeed: 1,
		    slideSpeed: 200,
		    transitionStyle: 'fade',
		});

		jQuery('#featured-content').owlCarousel({
		    autoPlay: 8000, //Set AutoPlay to 3 seconds
			navigation:true,
			navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
			pagination:false,
		    items : 4,
		    itemsDesktop : [1199,3],
		    itemsDesktopSmall : [979,3]
		});
	});
});

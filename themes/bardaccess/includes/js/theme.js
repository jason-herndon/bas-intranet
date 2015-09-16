jQuery(function(){
  "use strict";

  // MENU HOVER EFFECTS
  jQuery('.menu-touch-area').hover(
  	function() {
  		// jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  	},
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 600, 0);
  	}
  );

  jQuery('.menu-hover-home').hover(
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 600, 0);
  	},
  	function() {
  	}
  );

  jQuery('.menu-hover-about').hover(
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.news-sub-menu').fadeTo( 10, 0);
   		jQuery('.faqs-sub-menu').fadeTo( 10, 0);
		jQuery('.team-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 0);
  		jQuery('.about-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
  		// jQuery('.about-sub-menu').fadeTo( 10, 0);
  	}
  );

  jQuery('.menu-hover-news').hover(
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.about-sub-menu').fadeTo( 10, 0);
   		jQuery('.faqs-sub-menu').fadeTo( 10, 0);
		jQuery('.team-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 0);
  		jQuery('.news-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
  		// jQuery('.news-sub-menu').fadeTo( 10, 0);
  	}
  );

  jQuery('.menu-hover-team').hover(
  	function() {
   		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.about-sub-menu').fadeTo( 10, 0);
  		jQuery('.news-sub-menu').fadeTo( 10, 0);
   		jQuery('.faqs-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 0);
		jQuery('.team-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
   		// jQuery('.team-sub-menu').fadeTo( 10, 0);
 	}
  );

  jQuery('.menu-hover-faqs').hover(
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.about-sub-menu').fadeTo( 10, 0);
  		jQuery('.news-sub-menu').fadeTo( 10, 0);
 		jQuery('.team-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 0);
  		jQuery('.faqs-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
   		// jQuery('.faqs-sub-menu').fadeTo( 10, 0);
 	}
  );

  jQuery('.menu-hover-forms').hover(
  	function() {
  		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.about-sub-menu').fadeTo( 10, 0);
  		jQuery('.news-sub-menu').fadeTo( 10, 0);
 		jQuery('.team-sub-menu').fadeTo( 10, 0);
   		jQuery('.faqs-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
  		// jQuery('.forms-sub-menu').fadeTo( 10, 0);
  	}
  );

  jQuery('.menu-hover-resources').hover(
  	function() {
   		jQuery('.slider-overlay-bottom').fadeTo( 400, 1);
  		jQuery('.about-sub-menu').fadeTo( 10, 0);
  		jQuery('.news-sub-menu').fadeTo( 10, 0);
 		jQuery('.team-sub-menu').fadeTo( 10, 0);
   		jQuery('.faqs-sub-menu').fadeTo( 10, 0);
  		jQuery('.forms-sub-menu').fadeTo( 10, 0);
 		jQuery('.resources-sub-menu').fadeTo( 10, 1);
  	},
  	function() {
 		// jQuery('.resources-sub-menu').fadeTo( 10, 0);
  	}
  );

  // PRETTY PHOTO
  jQuery("a[rel^='prettyPhoto']").prettyPhoto({
  	social_tools:false,
  	theme: 'dark_square',
  });

  // NO CONFLICT
  jQuery.noConflict();

  // INITALIZE JQUERY
  jQuery(document).foundation();
   	jQuery(document).ready(function() {
   		// HOMEPAGE SLIDER SETUP
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
		// FEATURED CONTENT SLIDER SETUP
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

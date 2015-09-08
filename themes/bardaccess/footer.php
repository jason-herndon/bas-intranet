    	<!-- FOOTER -->
		<footer class="row">
			<div class="large-12 columns"><hr/>
			  <div class="row">

			    <div class="large-6 columns">
			        <p>© Copyright no one at all. Go to town.</p>
			    </div>

			    <div class="large-6 columns">
			        <ul class="inline-list right">
			          <li><a href="#">Link 1</a></li>
			          <li><a href="#">Link 2</a></li>
			          <li><a href="#">Link 3</a></li>
			          <li><a href="#">Link 4</a></li>
			        </ul>
			    </div>

			  </div>
			</div>
		</footer>
	<?php wp_footer(); // js scripts are inserted using this function ?>
	<script type="text/javascript">
	  jQuery(document).foundation();
	   	jQuery(document).ready(function() {
			jQuery('#slider-homepage').owlCarousel({
			    loop:true,
			    margin:10,
			    singleItem:true,
			    navigation:false,
			    pagination:false,
			    autoPlay: true,
			    rewindSpeed: 1,
			    slideSpeed: 200,
			    transitionStyle: 'fade',
			});

			jQuery('#featured-content').owlCarousel({
			    autoPlay: 8000, //Set AutoPlay to 3 seconds
				navigation:false,
				pagination:false,
			    items : 4,
			    itemsDesktop : [1199,3],
			    itemsDesktopSmall : [979,3]
			});
		});
	</script>	
  </body>
</html>
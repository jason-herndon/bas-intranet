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
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/includes/js/vendor/jquery.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/includes/js/vendor/owl.carousel.min.js'; ?>"></script>
	<script type="text/javascript">
			    $(document).ready(function() {
			     
			      $("#slider-homepage").owlCarousel(
			      	      navigation : true,
					      slideSpeed : 300,
					      paginationSpeed : 400,
					      singleItem : true

					);
			     
			    });</script>

  </body>
</html>
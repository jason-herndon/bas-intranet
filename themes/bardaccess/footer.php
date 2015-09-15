    	<!-- FOOTER -->
		<footer class="footer row">
			<div class="<?php bas_columns(12); ?>"><hr/>
			  <div class="row">

			    <div class="<?php bas_columns(9); ?>">
					<?php echo bas_get_footer_menu(); ?>
			    </div>

			    <div class="<?php bas_columns(3); ?>">
			    	<div class="copyright right">
				        <p>&copy; <?php echo date("Y"); ?> C. R. Bard, Inc. All rights reserved.</p>
				    </div>
			    </div>

			  </div>
			</div>
		</footer>
	<?php wp_footer(); // js scripts are inserted using this function ?>
	<script type="text/javascript">
		<?php echo get('carbon_custom_js'); ?>
	</script>	
	<script type="text/javascript">
		
		
	</script>	
  </body>
</html>
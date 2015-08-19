<?php get_header(); ?>
	
	<div id="content" class="clearfix row">

		<div id="main" class="col-sm-8 clearfix" role="main">
				
			<?php do_action( 'bp_before_member_home_content' ); ?>
		
			<div id="item-header" class="well well-sm media clearfix" style="border: medium none;margin-bottom:0px" role="complementary">
		
				<?php bp_get_template_part( 'members/single/member-header' ) ?>
		
			</div><!-- #item-header -->
		    
		    <nav id="item-nav" class="navbar navbar-profile" role="navigation">
		      <div class="">
		        <div class="item-list-tabs no-ajax collapse navbar-collapse tabs-top" id="object-nav">
		          <ul class="nav navbar-nav">
		
						<?php bp_get_displayed_user_nav(); ?>
		
						<?php do_action( 'bp_member_options_nav' ); ?>
		
		          </ul>
		        </div><!-- /.navbar-collapse -->
		      </div><!-- /.container-fluid -->
		    </nav><!-- #item-nav -->
		    
			<?php 
				
				do_action( 'bp_before_member_body' );
			
					if ( bp_is_user_activity() || !bp_current_component() ) :
						bp_get_template_part( 'members/single/activity' );
			
					elseif ( bp_is_user_blogs() ) :
						bp_get_template_part( 'members/single/blogs'    );
			
					elseif ( bp_is_user_friends() ) :
						bp_get_template_part( 'members/single/friends'  );
			
					elseif ( bp_is_user_groups() ) :
						bp_get_template_part( 'members/single/groups'   );
			
					elseif ( bp_is_user_messages() ) :
						bp_get_template_part( 'members/single/messages' );
			
					elseif ( bp_is_user_profile() ) :
						bp_get_template_part( 'members/single/profile'  );
			
					elseif ( bp_is_user_forums() ) :
						bp_get_template_part( 'members/single/forums'   );
			
					elseif ( bp_is_user_notifications() ) :
						bp_get_template_part( 'members/single/notifications' );
			
					elseif ( bp_is_user_settings() ) :
						bp_get_template_part( 'members/single/settings' );
			
					// If nothing sticks, load a generic template
					else :
						bp_get_template_part( 'members/single/plugins'  );
			
					endif;
			
				do_action( 'bp_after_member_body' ); 
				
				do_action( 'bp_after_member_home_content' ); 
			
			?>
	
		</div><!-- #main -->
	
	<!-- BEGIN SIDEBAR -->
	<?php get_sidebar(); // sidebar 1 ?>

	</div><!-- #content -->
	
	
<?php get_footer(); ?>
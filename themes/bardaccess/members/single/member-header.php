<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
 
 		// get current user object
	    $current_user = wp_get_current_user();
	
		// declare user variables as global
	    global $current_user_username;
	    global $current_user_email;
	    global $current_user_firstname;
	    global $current_user_lastname;
	    global $current_user_displayname;
	    global $current_user_id;
	    global $myprofile;
	    global $wpdb;

		// set global variables
	    $current_user_username = $current_user->user_login;
	    $current_user_email = $current_user->user_email;
	   	$current_user_firstname = $current_user->user_firstname;
	    $current_user_lastname = $current_user->user_lastname;
	    $current_user_displayname = $current_user->display_name;
	    $current_user_id = $current_user->ID;
	    
	    // get the current users role
	    $user_role = get_user_role();

		// get avatars
		$avatar	= get_avatar( $current_user_email, 20 );
		$avatar_200	= get_avatar( $current_user_email, 220 );

		// set an empty $strenghts str var so that we can add it to the profile after the supevisor
		$strengths = '';

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar" class="col-xs-3 col-md-3 fs-content-thumbnail">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full&width=170&height=170' ); ?>

	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content" class="col-xs-9 col-md-9 fs-have-thumbnail">

	<h2>
		<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
	</h2>
    
    <?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
		<span class="user-nicename label label-info">@<?php bp_displayed_user_mentionname(); ?></span>
	<?php endif; ?>

	<span class="label label-default"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

	<?php do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>


			<?php /*
			<blockquote id="latest-update">

				<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>
			
			</blockquote>
			*/ ?>
			
			<div id="item-profile-extended" style="width:1200px;overflow: auto;">	
				
				<?php 
					
					// set the id of the current profile
					$current_profile_id = bp_displayed_user_id();

					// find the extended profile
				    $final_args = array(
				        'post_in'=> $mypostids,
				        'post_type'=>'ExtendedProfiles',
						'posts_per_page' => '-1', 
						'post_status' => 'publish',
					    'meta_query' => array(
					        array(
					            'key' => 'it_wpuser_id',
					            'value' => $current_profile_id,
					            'compare' => '='					        
					        )
                        )
					);

					// run the querys
					$EP_wp_query_assigned = new WP_Query($final_args); 
	
						// loop through the results -> BUILD PROFILE
				        if ( $EP_wp_query_assigned->have_posts() ) :

							while ($EP_wp_query_assigned->have_posts()) : $EP_wp_query_assigned->the_post();

								// get terms/cats -> DEPARTMENT
								$terms_list = get_the_term_list( get_the_ID(), 'ExtendedProfiles_cats', '', ' / ', '' );
								$term_ids = wp_get_post_terms(get_the_ID(), 'ExtendedProfiles_cats', array("fields" => "ids"));
								$last_term_id = array_pop($term_ids);
								$second_level_up_id = array_pop($term_ids);
	
								// get meta
								$employeeID = getMetaInfoByField('it_id');
								$employeeStartDate = getMetaInfoByField('it_hiredate');
								$employeeSupervisor = getMetaInfoByField('it_supervisor');
														
								// echo out the statements we need to build the profile
								$profile = '<strong>Worked at BARD Since:</strong> '.$employeeStartDate.'<br/>
								<strong>Department:</strong> '.$terms_list.'<br/>
								<strong>Supervisor:</strong> ';
	
								// echo the tags -> STRENGTHFINDERS
								$posttags = get_the_tags();
								$strengths = '<strong>StrengthFinders:</strong> ';
								
									// build an array
									if ($posttags) {
										$i = 0;								
										foreach($posttags as $tag) {
										    if ($i != 0) { $strengths .= ', '; }
										    $strengths .= $tag->name;
											$i++;
										}
									}
	
							endwhile;
						
						else :
						
							$profile = '<strong>This employee has not filled out their profile yet.</strong>';
						
						endif;
						//reset the custom query
						wp_reset_query(); 


			// IF THE EMPLOYEE IS A SUPERVISOR (AS EVIDENCED BY A VALUE TO $EMPLOYEESUPERVISOR) 
			// USE THE $SECOND_LEVEL_UP_ID AS CATEGORY FOR ID
			// OTHERWISE - USE THE $LAST_TERM_ID

			if ((isset($employeeSupervisor)) && ($employeeSupervisor != ''))
			{
					// supply the args to find a supervisor
	                $SUPER_args = array(
	                    'post_type'=>'ExtendedProfiles',
	                    'post_status'=>'publish',
					    'meta_query' => array(
					        array(
					            'key' => 'it_supervisor',
					            'value' => $second_level_up_id,
					            'compare' => '='					        
					        )
                        )
	                );
	        
	        } else {
		        
					// supply the args to find a supervisor
	                $SUPER_args = array(
	                    'post_type'=>'ExtendedProfiles',
	                    'post_status'=>'publish',
					    'meta_query' => array(
					        array(
					            'key' => 'it_supervisor',
					            'value' => $last_term_id,
					            'compare' => '='					        
					        )
                        )
	                );		        
		        
	        }
	                
	                // find the supervisor
	                $SUPER_query = new WP_Query( $SUPER_args );
	                
	                // BUILD THE SUPERVISOR TO THE PROFILE
			        if ( $SUPER_query->have_posts() ) :

		                //start loop
		                while ($SUPER_query->have_posts()) : $SUPER_query->the_post();
		    
		                    $supervisorID = getMetaInfoByField('it_wpuser_id');

							// get the user with that ID
							$supervisor = get_user_by( 'id', $supervisorID );
		
							// ADD SUPERVISOR TO THE PROFILE
							$profile .= "<a href='../" . $supervisor->display_name . "'>" . $supervisor->first_name . " " . $supervisor->last_name . "</a><br/>";
		                    
		                endwhile;
		
					else :
					
						// if nothing is found - just return a new line
						$profile .= "<br/>";

					endif;
					//reset the custom query
	                wp_reset_query(); 
					
					// ADD STRENGTHS TO THE PROFILE -> BUT AFTER THE SUPERVISOR
					$profile .= $strengths;

					// return the profile
					echo $profile;

				?>

			</div>

		<?php endif; ?>

		<div id="item-buttons" class="clearfix">

			<?php do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<?php
		/***
		 * If you'd like to show specific profile fields here use:
		 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		 */
		 do_action( 'bp_profile_header_meta' );

		 ?>
         
		<?php do_action( 'template_notices' ); ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ); ?>


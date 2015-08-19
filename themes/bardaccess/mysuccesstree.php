<?php
/**
 * Template Name: MySuccessTree
 * @package BuddyPress
 * @subpackage bp-legacy
  */


// initialize variables
$hasError = false;

// process form
if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
	
	// SET THE GOAL
	if(trim($_POST['goal']) === '') {
		$errormsg = 'Please enter a goal.';
		$hasError = true;
	} else {
		$goal = trim($_POST['goal']);
	}

	// SET SOME NEW POST TITLE
	$postTitle = substr($goal, 0, 80);
	$postTitle .= '...';

	// SET THE CATEGORY
	if(($_POST['cat']) === '') {
	} else {
		$cat = $_POST['cat'];
	}

	// IF THERE ARE NO ERRORS
	if (isset($hasError) && ($hasError == true)){ } else {

		// BUILD THE POST ARRAY
		$post_information = array(
			//'ID' => esc_attr(strip_tags($_POST['postid'])),
			'post_title' => $postTitle,
			'post_content' => $goal,
			'post_type' => 'SuccessTree',
			'post_status' => 'publish',
			'post_author' => $current_user_id,
			// 'post_status' => 'private',
			'comment_status' => closed,
		);
	
		// ADD THE POST
		$post_id = wp_insert_post($post_information);

		if ($post_id)
		{
	
			// Update Custom Meta
			// update_post_meta($post_id, 'it_projects_deadline', esc_attr(strip_tags($_POST['deadline_date'])));
	
			// Add categories
			wp_set_post_terms($post_id, $cat, 'ST_cats' );
			
		} // end if post
		
	} // end if no error

} // end if post

/* PAGE VARIABLES */
$pageTitle = 'SuccessTree';

//get template header
get_header();




/*--------------------------------------*/
/* SET GLOBALS FOR CURRENT USER
/*--------------------------------------*/

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
		$avatar_100	= get_avatar( $current_user_email, 100 );



/*--------------------------------------*/
/* GET EXTENDED PROFILE INFO
/*--------------------------------------*/

		// find the extended profile
	    $final_args = array(
	        'post_in'=> $mypostids,
	        'post_type'=>'ExtendedProfiles',
			'posts_per_page' => '-1', 
			'post_status' => 'publish',
		    'meta_query' => array(
		        array(
		            'key' => 'it_wpuser_id',
		            'value' => $current_user_id,
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
					$term_desc = wp_get_post_terms(get_the_ID(), 'ExtendedProfiles_cats', array("fields" => "all"));
					$last_term_id = array_pop($term_ids);
					$second_level_up_id = array_pop($term_ids);

					// THE THIRD LEVEL UP ID'S (THE PARENT OF THE SECOND LEVEL UP) IS THE BARD DEPARTMENT, SO LET'S GET THAT ID, we'll need it later
					$main_department_id = $term_desc[0]->parent;
					
					// get meta
					$employeeID = getMetaInfoByField('it_id');
					$employeeSupervisor = getMetaInfoByField('it_supervisor');
														
					// echo out the statements we need to build the profile
					$profile = "<strong>Department:</strong> ";
					$profile .= $terms_list;

				endwhile;
			
			else :
			
				$profile = '<strong>This employee has not filled out their profile yet.</strong>';
			
			endif;
			//reset the custom query
			wp_reset_query(); 

		

/*--------------------------------------*/
/* GET DEPT INFO
/*--------------------------------------*/

			// department profiles -> arguements
		    $Department_args = array(
		        'post_type'=>'ExtendedDepartments',
				'posts_per_page' => '-1', 
				'post_status' => 'publish',
			    'meta_query' => array(
			        array(
			            'key' => 'it_wpdepartment_id',
			            'value' => $main_department_id,
			            'compare' => '='					        
			        )
		        )
			);
		
		    // department profiles -> query
		    $Department_query = new WP_Query( $Department_args );
		    if ( $Department_query->have_posts() ) :
		        while ($Department_query->have_posts()) : $Department_query->the_post();
		            $dept_name = get_the_title();
		            $dept_description = get_the_content();
		        endwhile;
			else :
			
				// if nothing is found - just return a new line
				$profile .= "";
		
			endif;
			//reset the custom query
		    wp_reset_query(); 
		
		
			// MOVE THIS ELSEWHERE
			$values = "<strong>Guiding Values</strong><br/><em>Innovation • Quality • Integrity • Service • Passion • Courage • Teamwork • Fun</em>";
			$policy = "<strong>Guiding Policy</strong><br/><em>Bard Access Systems adheres to a Quality Policy which is consistent with the central principles of the C.R. Bard Mission Statement: Quality, Integrity, Service, and Innovation.</em>";


/*--------------------------------------*/
/* GET SUPERVISOR INFO
/*--------------------------------------*/

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
					$profile .= "&nbsp; &middot; &nbsp;<strong>Supervisor:</strong> <a href='../" . $supervisor->display_name . "'>" . $supervisor->first_name . " " . $supervisor->last_name . "</a>";
                    
                endwhile;

			else :
			
				// if nothing is found - just return a new line
				$profile .= "";

			endif;
			//reset the custom query
            wp_reset_query(); 
					
					
					
/*--------------------------------------*/
/* ADD SOME JAVASCRIPT AND STYLING
/*--------------------------------------*/
	
	
	//add_action( 'enqueue_scripts', array( $this, 'register_scripts' ) );
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	
	?>
		
		<script>
			jQuery(document).ready(function() {
			    jQuery('.MyDate').datepicker({
			        dateFormat : 'dd-mm-yy'
			    });
			});	
		</script>
				
		<style>
			.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
				color: #555555;
				background-color: transparent;
				border: none;
				border-bottom-color: transparent;
				cursor: default;
			}
			
			.nav-tabs > li > a:hover {
				border-color: #eeeeee #eeeeee #dddddd;
			}
			
			.nav > li > a:hover, .nav > li > a:focus {
				text-decoration: none;
				background-color: #eeeeee;
			}
		</style>	    	  
			    
	    
<?php
/*--------------------------------------*/
/* MAKE THE MODAL
/*--------------------------------------*/
?>	
		
	<!-- MODAL CONTENT -->
	<div class="modal fade" id="addgoal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <!-- ADD FORM -->
		  <form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title">Add SuccessTree Goal</h4>
	      </div>
	      <div class="modal-body">
			 <div id="contact-form" class="formadj">		
				 
				<!-- BEGIN CATEGORY -->
				<div class="clearfix"></div>
				<div class="one-half column-last">
					<h4 class=""><span>Goal Categories</span></h4>
					<div class="span5">
						<div class="form-section">
							<fieldset>
	 							<select name="cat" class="form-control" >
									<?php 
									$args3 = array(
										'orderby'                  => 'name',
										'order'                    => 'ASC',
										'hide_empty'               => 0,
										'hierarchical'             => 1,
										'exclude'                  => '',
										'include'                  => '',
										'number'                   => '',
										'taxonomy'                 => 'ST_cats',
										'pad_counts'               => false,
										);
										
										$idpcats=get_categories($args3); 
			
				                        if ($idpcats){
				                            foreach ($idpcats as $cat){
													echo "<option value='$cat->term_id' class=''/> " . $cat->cat_name;    
				                            }
				                        }
			                        ?> 
	 							</select>
							</fieldset>
						</div>
					</div>
				</div>
				<!-- END CATEGORY -->
	
				<!-- GOAL -->
				<?php if(isset($hasError) && ($hasError == true)) { ?>
					<div class="alert alert-danger"><?php echo $errormsg; ?></div>
					<div class="clearfix"></div>
				<?php } ?>
			
				<fieldset>
					<h4 class="marginbottom0"><span>Goal</span></h4>
					<textarea class="form-control" name="goal" id="goal" value="<?php if (isset($goal)){ echo $goal;} ?>" style="min-height: 150px;"></textarea>
				</fieldset>
			
				<br/>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				
			</div>       
	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success pull-right"><span class="bordertop0" class="button-inner"><?php _e('Add GOAL', 'framework') ?></span></button>
	      </div>
	    </div><!-- /.modal-content -->
		</form>
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
<?php
/*--------------------------------------*/
/* BUILD THE PAGE
/*--------------------------------------*/
?>	

	
	<!-- PAGE CONTENT -->
	<div id="content" class="clearfix row">
		<div id="main" class="col col-lg-12 clearfix" role="main">
		       
			<!-- SHOW THE ITEM HEADER -->
			<div id="item-header" class="well well-sm media clearfix" style="border: medium none;margin-bottom:20px" role="complementary">
		
				<div id="item-header-avatar" class="col-md-1 fs-content-thumbnail">
					<a href="/intranet/members/<?php echo $current_user_username; ?>">
						<?php echo $avatar_100; ?>
					</a>
				</div><!-- #item-header-avatar -->
			
				<div id="item-header-content" class="col-md-9 fs-have-thumbnail" style="margin-left:20px;">
					<h2><a href="/intranet/members/<?php echo $current_user_username; ?>"><?php echo $current_user_displayname; ?></a></h2>
					<div style="margin-bottom:8px;">
						<span class="user-nicename label label-info">@<?php echo $current_user_username; ?></span>
						<span class="label label-default"><?php bp_last_activity( $current_user_id ); ?></span><br/>
					</div>
					<span><?php echo $profile;  ?></span>
				</div>
				
				<div class="col-md-2">
					<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addgoal" style="margin-top: 20px;">Add Goal</button>
				</div>
				
			</div><!-- #item-header -->

			<!-- PAGE HEADER -->
			<div style="padding:20px;text-align: center">
				<h2><?php echo $pageTitle; ?></h2>
				<br/>
			</div>
	    	    
	    
			<!-- SUCCESS TREE -->
			<div class="row" style="min-height:504px;border-top: 4px solid #ccc" role="tabpanel" data-example-id="togglable-tabs">
				
				<div class="col-md-7" style="background:#f5f5f5;min-height:500px;">
					 <div class="row">
						 
						 <div class="col-md-12" style="margin-bottom:10px;">
							<div class="row">
							    <ul id="myTab" class="nav nav-tabs" role="tablist">
							      <li role="presentation" class="col-md-3 active" style="min-height:60px;background:#e7e7e7;padding-left: 0px;padding-right: 0px;text-align: center;">
								      <a href="#mission" id="mission-tab" role="tab" data-toggle="tab" aria-controls="mission" aria-expanded="false" style="border-radius: 0px;border: none;margin-right:0px;padding: 20px 12px 20px 12px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);font-weight: bold;color: #555;margin-top: 0px;margin-bottom: 0px;">Mission/Vision/Goals</a>
								      </li>
							      <li role="presentation" class="col-md-3 " style="min-height:60px;background:#dff0d8;padding-left: 0px;padding-right: 0px;text-align: center;">
								      <a href="#current" role="tab" id="current-tab" data-toggle="tab" aria-controls="current" aria-expanded="false" style="border-radius: 0px;border: none;margin-right:0px;padding: 20px 12px 20px 12px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);font-weight: bold;color: #555;margin-top: 0px;margin-bottom: 0px;">Current State</a>
								      </li>
							      <li role="presentation" class="col-md-3 " style="min-height:60px;background:#fcf8e3;padding-left: 0px;padding-right: 0px;text-align: center;">
								      <a href="#desired" role="tab" id="desired-tab" data-toggle="tab" aria-controls="desired" aria-expanded="false" style="border-radius: 0px;border: none;margin-right:0px;padding: 20px 12px 20px 12px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);font-weight: bold;color: #555;margin-top: 0px;margin-bottom: 0px;">Desired State</a></li>
							      <li role="presentation" class="col-md-3 " style="min-height:60px;background:#F0D8B5;padding-left: 0px;padding-right: 0px;text-align: center;">
								      <a href="#vital" role="tab" id="vital-tab" data-toggle="tab" aria-controls="vital" aria-expanded="false" style="border-radius: 0px;border: none;margin-right:0px;padding: 20px 12px 20px 12px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);font-weight: bold;color: #555;margin-top: 0px;margin-bottom: 0px;">Vital Few</a></li>
							    </ul>
							</div><!-- ROW -->
						 </div>
						 
						<div id="myTabContent" class="tab-content">
							
							<div role="tabpanel" class="tab-pane active" id="mission" aria-labelledby="mission-tab">
								 <div class="col-md-12" style="min-height:100px; margin-bottom:10px;">
									 <div class="row">
										 <div style="padding:20px;height:390px;">
											 <h2><?php echo $dept_name;  ?>'s</h2><h3 style="margin-top:0px;"><em>Mission and Vision</em></h3>
											 <br/>
											 <p><?php echo $dept_description;  ?></p>
										 </div>
									 </div><!-- ROW -->
								 </div>

							</div><!-- MISSION TAB -->

	
								<div role="tabpanel" class="tab-pane" id="current" aria-labelledby="current-tab">
									 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
										 <div class="row">
											 <div style="padding:0px 20px 20px 20px;height:130px;">
												 <p>Current Content here.</p>
											 </div>
										 </div><!-- ROW -->
									 </div>
			
									 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
										 <div class="row">
											 <div style="padding:0px 20px 20px 20px;height:130px;">
												 <p>Current Content here.</p>
											 </div>
										 </div><!-- ROW -->
									 </div>
			
									 <div class="col-md-12" style="min-height:100px;">
										 <div class="row">
											 <div style="padding:0px 20px 20px 20px;height:130px;">
												 <p>Current Content here.</p>
											 </div>
										 </div><!-- ROW -->
									 </div><!-- COL 12-->
								</div><!-- CURRENT STATE TAB -->
		
		
									<div role="tabpanel" class="tab-pane" id="desired" aria-labelledby="desired-tab">
										 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
											 <div class="row">
												 <div style="padding:0px 20px 20px 20px;height:130px;">
													 <p>Desired Content here.</p>
												 </div>
											 </div><!-- ROW -->
										 </div>
				
										 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
											 <div class="row">
												 <div style="padding:0px 20px 20px 20px;height:130px;">
													 <p>Desired Content here.</p>
												 </div>
											 </div><!-- ROW -->
										 </div>
				
										 <div class="col-md-12" style="min-height:100px;">
											 <div class="row">
												 <div style="padding:0px 20px 20px 20px;height:130px;">
													 <p>Desired Content here.</p>
												 </div>
											 </div><!-- ROW -->
										 </div><!-- COL 12-->
									</div><!-- DESIRED STATE TAB -->
		
			
										<div role="tabpanel" class="tab-pane" id="vital" aria-labelledby="vital-tab">
											 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
												 <div class="row">
													 <div style="padding:0px 20px 20px 20px;height:130px;">
														 <p>Vital Content here.</p>
													 </div>
												 </div><!-- ROW -->
											 </div>
					
											 <div class="col-md-12" style="min-height:100px; border-bottom:1px solid #e1e1e1;margin-bottom:10px;">
												 <div class="row">
													 <div style="padding:0px 20px 20px 20px;height:130px;">
														 <p>Vital Content here.</p>
													 </div>
												 </div><!-- ROW -->
											 </div>
					
											 <div class="col-md-12" style="min-height:100px;">
												 <div class="row">
													 <div style="padding:0px 20px 20px 20px;height:130px;">
														 <p>Vital Content here.</p>
													 </div>
												 </div><!-- ROW -->
											 </div><!-- COL 12-->
										</div><!-- VITAL FEW TAB -->

										
						 </div><!-- TAB CONTENT -->

					 </div><!-- ROW -->
				</div><!-- COL-7 -->
				
			
				<div class="col-md-5" style="background:#f9f9f9;min-height:500px;">
					<div class="row">

						<div class="col-md-12" style="min-height:60px;background:#FF7C7D;margin-bottom:10px;padding-top: 12px;text-align: center;"><h5 style="text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3);font-weight: bold;color: #555;">Critical Factors</h5></div>

						<!-- GET THE (3) SUCCESSTREE CATEGORIES -->
						<?php 
							$args3 = array(
								'orderby'                  => 'name',
								'order'                    => 'ASC',
								'hide_empty'               => 0,
								'hierarchical'             => 1,
								'exclude'                  => '',
								'include'                  => '',
								'number'                   => '',
								'taxonomy'                 => 'ST_cats',
								'pad_counts'               => false,
								);
								
							$successTreeCats=get_categories($args3); 
						?>
						
						<!-- IF CATEGORIES ARE RETURNED -->
                        <?php
	                        if ($successTreeCats){
                        ?>    

							<!-- FOR EACH CATEGORY -->
	                        <?php
		                        $i=0;
	                            foreach ($successTreeCats as $successTreeCat){ ?>
	                            
									 <div class="col-md-12" style="min-height:100px; <?php if ($i < 2){ echo 'border-bottom:1px solid #e1e1e1;'; } ?>margin-bottom:10px;">
										 <div class="row">
											 <div style="padding:0px 20px 20px 20px;height:130px;">

											    <?php

												$args = array(
													'orderly' => 'title',
													'show_posts' => '-1', 
													'posts_per_page' => '-1', 
//														'cat' => $successTreeCat->cat_ID,
//														'category_name' => $successTreeCat->slug,
													'post_type' => 'SuccessTree',
													'author' => $current_user_id,
													'post_status' => 'publish',
												);
												
												$wp_query_assigned = new WP_Query($args); 

												?>

													<p><strong><?php echo $successTreeCat->name; ?></strong></p>
															
												<?php
										        if ( $wp_query_assigned->have_posts() ) : 
												?>
													<?php while ($wp_query_assigned->have_posts()) : $wp_query_assigned->the_post();
														$id = get_the_ID();
														$content = get_the_content();
														$title = get_the_title();
														echo '<p style="font-size:12px !important;padding-left:10px;padding-bottom:0px;"><span style=""><a href="#">'.$title.'</a></span></p>';
												   endwhile; ?>
										        <?php else : 
										        ?>
										            
													<p>You have no SuccessTree Goals in <strong><?php echo $successTreeCat->name; ?></strong>.</p>

												<?php endif; ?>
										
										        <?php
													//reset the custom query
													wp_reset_query(); 
												?>
										 
										 	</div>
										 </div><!-- ROW -->
									 </div>
										
	                        <?php
		                         $i++;
		                         } ?>
                            
						<!-- END IF CATEGORIES ARE RETURNED -->
                        <?php
	                        }
                        ?> 

    if ( $wp_query_assigned->have_posts() ) : 
		
		while ($wp_query_assigned->have_posts()) : $wp_query_assigned->the_post();
			$title = get_the_title();
			echo '<p>'.$title.'</p>';
	   endwhile;
	else : 
        
		echo '<p>You have no set Goals';

	endif;
	wp_reset_query(); 
												
												
					 </div><!-- ROW -->
				</div><!-- COL-5 -->

			</div><!-- ROW -->
	    
			<div class="row" style="min-height:60px;border-top: 4px solid #ccc">

				<div class="col-md-12" style="min-height:40px;background:#333;margin-bottom:30px;">
					<div class="row">
	
						<div class="col-md-7" style="min-height:20px;padding-top:10px;">
							<p class="text-muted small"><?php echo $policy; ?></p>
						</div><!-- COL-7 -->
	
						<div class="col-md-5" style="min-height:20px;padding-top:10px;text-align:right;">
							<p class="text-muted small"><?php echo $values; ?></p>
						</div><!-- COL-5 -->
	
					</div><!-- ROW -->
				</div><!-- COL-12 -->
				
			</div><!-- ROW -->



	            
		</div> <!-- end #main -->
	
	</div> <!-- end #content -->

<?php
	//get footer template
	get_footer(); 
?>
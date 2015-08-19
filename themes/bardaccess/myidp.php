<?php
/**
 * Template Name: MyIDP
 * @package BuddyPress
 * @subpackage bp-legacy
  */


// initialize variables
$hasError = false;

// process form
if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
	
	// SET THE GOAL
	if(trim($_POST['idp_goal']) === '') {
		$errormsg = 'Please enter a goal.';
		$hasError = true;
	} else {
		$goal = trim($_POST['idp_goal']);
	}

	// SET SOME NEW POST TITLE
	$postTitle = substr($goal, 0, 40);
	$postTitle .= '...';

	// SET THE CATEGORY
	if(($_POST['cats']) === '') {
	} else {
		$cat = $_POST['cats'];
	}

	// VISIBILITY
	if(($_POST['idp_public']) === '') {
		$public = false;
	} else {
		$public = true;
	}

	// IF THERE ARE NO ERRORS
	if (isset($hasError) && ($hasError == true)){ } else {

		// BUILD THE POST ARRAY
		$post_information = array(
			//'ID' => esc_attr(strip_tags($_POST['postid'])),
			'post_title' => $postTitle,
			'post_content' => $goal,
			'post_type' => 'IDP',
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
		//	update_post_meta($post_id, 'it_projects_deadline', esc_attr(strip_tags($_POST['deadline_date'])));
	
			// Add categories
			wp_set_post_terms($post_id, $cat, 'IDP_cats' );
			
		} // end if post
		
	} // end if no error

} // end if post



/* PAGE VARIABLES */
$pageTitle = 'My IDP';

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
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
			 <div id="contact-form" class="formadj">		
				 
	<?php /*		
				<!-- BEGIN DEADLINE -->
				<div class="clearfix"></div>
				<div class="one-half column-">
			  	  	<h3 class=""><span>Project Deadline</span></h3>
					<fieldset class="width100px floatleft">
						<input type="text" name="deadline_date" id="deadline_date" value="<?php if (isset($deadline)){ echo $deadline;} ?>" placeholder="enter deadline here" class="MyDate inpadj2"/>				
					</fieldset>
				</div>
				<!-- END DEADLINE -->
	*/ ?>		
			
				<!-- BEGIN CATEGORY -->
				<div class="clearfix"></div>
				<div class="one-half column-last">
					<h3 class=""><span>Project Categories</span></h3>
					<div class="span5">
						<div class="form-section">
							<fieldset>
	<!-- 							<select name="cats[]" multiple="multiple multisel2" class="form-control" > -->
									<?php 
									$args3 = array(
										'orderby'                  => 'name',
										'order'                    => 'ASC',
										'hide_empty'               => 0,
										'hierarchical'             => 1,
										'exclude'                  => '',
										'include'                  => '',
										'number'                   => '',
										'taxonomy'                 => 'IDP_cats',
										'pad_counts'               => false,
										);
										
										$idpcats=get_categories($args3); 
			
			                        if ($idpcats){
			                            
			                            foreach ($idpcats as $cat){
												echo "<input type='checkbox' name='cats[]' value='$cat->term_id' class=''/> " . $cat->cat_name;    
												echo '<br>';    
			                            }
			                            
			                        }
			                        ?> 
	<!-- 							</select> -->
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
					<h3 class="marginbottom0"><span>IDP Goal</span></h3>
					<textarea class="form-control" name="idp_goal" id="idp_goal" value="<?php if (isset($goal)){ echo $goal;} ?>"></textarea>
				</fieldset>
			
				<br/>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				
			</div>       
	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success pull-right"><span class="bordertop0" class="button-inner"><?php _e('Add IDP GOAL', 'framework') ?></span></button>
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
		       
		<h2><?php the_title(); ?></h2>
		<br/>

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

	    
			<!-- SHOW THE DEPARTMENT VISION AND GOALS -->
			  <div class="panel panel-primary">
			    <div class="panel-heading" role="tab" id="headingOne">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
			          <?php echo $dept_name;  ?>'s Mission, Vision and Goals
			        </a>
			      </h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      <div class="panel-body">
			        <?php echo $dept_description;  ?>
			      </div>
			    </div>
			  </div>


			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

				<!-- PANEL TWO -->
			  <div class="panel panel-info">
			    <div class="panel-heading" role="tab" id="headingTwo">
			      <h4 class="panel-title">
			        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          Current State
			        </a>
			      </h4>
			    </div>
			    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			      <div class="panel-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>

				<!-- PANEL THREE -->
			  <div class="panel panel-success">
			    <div class="panel-heading" role="tab" id="headingThree">
			      <h4 class="panel-title">
			        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Desired State
			        </a>
			      </h4>
			    </div>
			    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			      <div class="panel-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>


				<!-- PANEL FOUR -->
			  <div class="panel panel-warning">
			    <div class="panel-heading" role="tab" id="headingFour">
			      <h4 class="panel-title">
			        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
			          Vital Few
			        </a>
			      </h4>
			    </div>
			    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
			      <div class="panel-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>


				<!-- PANEL FIVE -->
			  <div class="panel panel-danger">
			    <div class="panel-heading" role="tab" id="headingFive">
			      <h4 class="panel-title">
			        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
			          Critical Factors
			        </a>
			      </h4>
			    </div>
			    <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
			      <div class="panel-body">
			        	<!-- SHOW THE EXISTING IDP GOALS -->
				    	<div id="">
					    		    	
				    	<?php
									$args = array(
									'orderly' => 'title',
									'show_posts' => '-1', 
									'posts_per_page' => '-1', 
				// 					'order' => 'ASC',
									'post_type' => 'IDP',
									'author' => $current_user_id,
									'post_status' => 'publish',
									);
							
									$wp_query_assigned = new WP_Query($args); 
							        if ( $wp_query_assigned->have_posts() ) : ?>
										<ul>
											<?php while ($wp_query_assigned->have_posts()) : $wp_query_assigned->the_post();
											   echo '<li>'; the_title(); echo ' - '; the_author(); echo '</li>';
											endwhile; ?>
							            </ul>
							            <?php else : ?>
							            <p>You have IDP Goals yet.</p>
							        <?php endif; ?>
							
					        <?php
							//reset the custom query
							wp_reset_query(); 
						?>
					    </div><!--  -->
			
			      </div>
			    </div>
			  </div>
			</div>
	
	
	            
		</div> <!-- end #main -->
	
	</div> <!-- end #content -->

<?php
	//get footer template
	get_footer(); 
?>
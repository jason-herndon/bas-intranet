<!doctype html>  
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>
		<?php if ((isset($pageTitle)) && ($pageTitle != '')) {
			echo $pageTitle;
		 } else { ?>

			<?php if ( is_home() ) { ?>
				<?php bloginfo('name'); ?>
				<?php } else { ?>
				<?php wp_title( '|', true, 'right' ); ?>
				 |
				<?php bloginfo('name'); ?>
			<?php } ?>
		<?php } ?>
					
		</title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->	

		<!-- GOOGLE FONT -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,800italic,800,700,700italic,600italic,600,400italic' rel='stylesheet' type='text/css'>
		
	</head>

	<?php
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
/*		
		if ( bp_is_user() && bp_user_has_access() ) {
			$notification_count    = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
			$class    = ( 0 === $notification_count ) ? 'hide no-count' : 'label label-danger count';
		} else {
			$notification_count = 0;
			$class="";
		}
		*/
	?>

	<body <?php body_class(); ?>>
				
		<header role="banner">

			<div class="navbar navbar-bas navbar-fixed-top top-panel">
				<div class="container">

					<div class="navbar-header top-container">

						<!-- TOP MESSAGE -->
						<div class="navbar-left top-message">
							<p>Today is <?php echo current_time("F dS, Y - g:ia"); ?></p>
						</div>

						<!-- TOP LOGIN AREA -->
						<div class="navbar-right top-login">
							<!-- image -->
							<div class="user-logged-in-image">
								<?php echo $avatar; ?>
							</div>
							<!-- logged in user profile -->
							<div class="user-logged-in-info">
								<p><a href="/intranet/members/<?php echo $current_user_username; ?>"><?php echo $current_user_displayname; ?></a></p>
							</div>
							<?php /*
							<!-- image -->
							<div class="user-notifications">
								<p><i class="fa fa-bell"></i> <?php if ($notification_count > 0){ ?><span class="<?php echo $class; ?>"><?php echo $notification_count; ?></span><?php } ?></p>
							</div>
							*/ ?>
						</div>
					</div>

				</div> <!-- end .container -->
			</div> <!-- end .navbar -->

				
			<div class="navbar navbar-default">
				<div class="container">
					          
					<div class="navbar-header">
<!--
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
-->
						<a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo home_url(); ?>/wp-content/themes/bardaccess/images/bard-logo.png"></a>
					</div>

					<div class="collapse navbar-right navbar-collapse navbar-responsive-collapse">
						<?php // wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</div>
					
					<div class=" header-menu">
					</div>

				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->
		
		<div class="container">

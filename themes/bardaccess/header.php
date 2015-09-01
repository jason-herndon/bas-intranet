<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<title><?php if ((isset($pageTitle)) && ($pageTitle != '')) { echo $pageTitle; } else { bloginfo('name'); } ?></title>	

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- wordpress head functions -->
	<?php wp_head(); ?>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
   	<?php
   	// LOGGED IN USER
	$current_user = wp_get_current_user();

	// declare user variables as global
	global $current_user_username;
	global $current_user_email;
	global $current_user_firstname;
	global $current_user_lastname;
	global $current_user_displayname;
	global $current_user_id;

	// set global variables
	if($current_user->user_login)
	{
		$current_user_username = $current_user->user_login;
		$current_user_email = $current_user->user_email;
		$current_user_firstname = $current_user->user_firstname;
		$current_user_lastname = $current_user->user_lastname;
		$current_user_displayname = $current_user->display_name;
		$current_user_id = $current_user->ID;

		// get the current users role
		$user_role = bas_get_user_role();

		// get avatars
		$avatar	= get_avatar( $current_user_email, 25 );
		$avatar_200	= get_avatar( $current_user_email, 220 );
		$loginClass = '4';
		$loginLink = "/intranet/members/".$current_user_username;

	} else {
		$current_user_displayname = 'Login';
		$avatar = '<span class="float:right;"><img src="'.get_template_directory_uri().'/includes/img/bas-avatar.png"></span>';
		$avatar_200 = get_avatar('Bard Access Systems', 220);
		$loginClass = '1';
		$loginLink = "#";
	}

	if (function_exists(bp_is_active)) {
		if ( bp_is_user() && bp_user_has_access() ) {
			$notification_count    = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
		} else {
			$notification_count = 0;
		}
	} else {
		$notification_count = 0;
	}

	?>

  </head>

	<body <?php body_class(); ?>>
 
	<!-- NAVBAR 
	================================================== -->

	<div class="header-full">

		<!-- Begin Navbar -->
		<nav class="top-bar" data-topbar>

			<!-- Login Bar -->
			<div class="login-bar row">
				<div class="header-login large-<?php echo $loginClass;?> columns right">
					<div class="user-avatar">
						<?php echo $avatar; ?>
					</div>
					<div class="user-name">
						<a href="<?php echo $loginLink; ?>"><?php echo $current_user_displayname; ?></a>
					</div>
					<div class="user-notifications right">
						</i> <?php if ($notification_count > 0) { ?><i class="fa fa-bell"><span class="round alert label"><?php echo notification_count; ?></span><?php } ?>
					</div>
				</div>
			</div>

			<!-- Top Nagivation Bar -->
			<div class="top-nav-bar row">
				<div class="large-12 columns">
					<ul class="title-area">
					  <li class="name">
					    <h1>
					      <a href="<?php echo get_bloginfo('url'); ?>">
					        <?php echo bas_get_logo(); ?>
					      </a>
					    </h1>
					  </li>
					  <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
					</ul>

					<section class="top-bar-section">
						<?php echo bas_get_menu(); ?>
					</section>

					<div class="mobile_nav">
						<div id="menu_button" class="show-for-small-only">
							<button class="secondary button" id="mobileMenuButton" href="#mobile-menu">
								<span class="mobile-menu-icon"></span>
								<span class="mobile-menu-icon"></span>
								<span class="mobile-menu-icon"></span>
							</button>
						</div>
					</div>

					<!-- FIX: ADD MOBILE MENU -->

				</div>
			</div>
		</nav>
		<!-- End Navbar -->

	</div>
<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
?>
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
	
   	<!-- LOGGED IN USER -->
	<?php get_template_part( 'includes/partials', 'users' ); ?>

  </head>

	<body <?php body_class(); ?>>
 
	<!-- NAVBAR 
	================================================== -->

	<div class="header-full">

		<!-- Begin Navbar -->
		<nav class="top-bar" data-topbar>
			<div class="row">
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
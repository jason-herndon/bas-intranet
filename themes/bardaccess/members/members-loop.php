<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_members_loop' ); ?>
<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list list-unstyled members-list" role="main">

	<?php while ( bp_members() ) : bp_the_member(); ?>

		<li>
         <div class="panel panel-default"><div class="panel-body" style="padding-left: 0px;padding-bottom: 0px;">
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('width=90&height=90'); ?></a>
			</div>

			<div class="item" style="float: left;padding-top: 15px;">
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>" class="lead friends-list-title"><?php bp_member_name(); ?></a>

					<?php /* if ( bp_get_member_latest_update() ) : ?>

						<span class="update"> <?php bp_member_latest_update(); ?></span>

					<?php endif; */ ?>

				</div>

				<?php /*
					<div class="item-meta"><span class="label label-default"><?php bp_member_last_active(); ?></span></div>
					*/ ?>

				<?php do_action( 'bp_directory_members_item' ); ?>

				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				?>
			</div>

			<div class="action" style="margin-top: 42px;">

				<?php do_action( 'bp_directory_members_actions' ); ?>

			</div>

			<div class="clear clearfix"></div>
         </div></div>    
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div class="clearfix"></div><div id="message" class="info alert alert-info">
		<p><?php _e( "Sorry, no members were found.", 'firmasite' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>

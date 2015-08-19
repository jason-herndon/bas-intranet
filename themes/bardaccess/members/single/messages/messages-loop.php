<?php do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_member_messages_pagination' ); ?>

	<?php do_action( 'bp_before_member_messages_threads'   ); ?>

	<!--<div class="modal firmasite-modal-static"><div class="modal-dialog"><div class="modal-content"><div class="modal-body">-->
	<table id="message-threads" class="messages-notices">
		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

			<tr id="m-<?php bp_message_thread_id(); ?>" class="<?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread<?php else: ?> read<?php endif; ?>">
				<td width="1%" class="thread-count">
					<?php /* <span class="unread-count"><?php bp_message_thread_unread_count(); ?></span> */ ?>
				</td>
				<td width="8%" class="thread-avatar"><?php bp_message_thread_avatar(); ?></td>

				<?php if ( 'sentbox' != bp_current_action() ) : ?>
					<td width="30%" class="thread-from">
						<?php _e( 'From:', 'firmasite' ); ?> <?php bp_message_thread_from(); ?><br />
						<?php /* <span class="label label-default activity"><?php bp_message_thread_last_post_date();?></span> */ ?>
					</td>
				<?php else: ?>
					<td width="30%" class="thread-from">
						<?php _e( 'To:', 'firmasite' ); ?> <?php bp_message_thread_to(); ?><br />
						<?php /* <span class="label label-default activity"><?php bp_message_thread_last_post_date(); ?></span> */ ?>
					</td>
				<?php endif; ?>

				<td width="50%" class="thread-info">
					<p style="margin-bottom: 0px;margin-top: 10px;"><a href="<?php bp_message_thread_view_link(); ?>" title="<?php esc_attr_e( "View Message", 'firmasite' ); ?>"><?php bp_message_thread_subject(); ?></a></p>
					<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
				</td>

				<?php do_action( 'bp_messages_inbox_list_item' ); ?>

				<td width="6%" class="thread-options" style="text-align:right;">
					<input type="checkbox" name="message_ids[]" value="<?php bp_message_thread_id(); ?>" />
					<a class="btn btn-default btn-xs button confirm" href="<?php bp_message_thread_delete_link(); ?>" title="<?php esc_attr_e( "Delete Message", 'firmasite' ); ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
				</td>
			</tr>

		<?php endwhile; ?>
	</table><!-- #message-threads -->
	<!--</div></div></div></div>-->

	<div class="messages-options-nav">
		<?php bp_messages_options(); ?>
	</div><!-- .messages-options-nav -->

	<?php do_action( 'bp_after_member_messages_threads' ); ?>

	<?php do_action( 'bp_after_member_messages_options' ); ?>

<?php else: ?>

	<div class="clearfix"></div><div id="message" class="info alert alert-info">
		<p><?php _e( 'Sorry, no messages were found.', 'firmasite' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_messages_loop' ); ?>

<?php

/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_activity_entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">
 <div class="panel panel-default"><div class="panel-body media">
  <?php if ( bp_activity_has_content() ) { ?>
    <div class="activity-header text-muted row fs-content-thumbnail">
	
		<div class="" style="margin-bottom: 10px;">
        <div class="activity-avatar">
            <a href="<?php bp_activity_user_link(); ?>">
    
                <?php bp_activity_avatar('type=thumb&width=30&user_id=' . bp_get_activity_comment_user_id()); ?>
    
            </a>
        </div>
        
        <p>
	        <?php bp_activity_action(); ?>
 <?php
	/* 
           <a href="<?php bp_activity_user_link(); ?>" style="color:#109a9c;font-weight:600;font-size: 16px;">
                <?php global $activities_template;
                     echo $activities_template->activity->display_name; 
                ?>
            </a>
	*/
	?>

        </p>
<div class="clearfix"></div>
<?php
	/* 
		<button class="btn btn-link" data-container="body" data-toggle="popover" data-rel="popover" data-html="true" data-placement="right" data-original-title="" data-content="<?php echo esc_attr(bp_get_activity_action()); ?>">
            <span class="edit-link text-muted"><span class="icon-cog"></span> <?php _e( 'Details', 'firmasite' );?></span>
         </button>
      */
?>      

	</div>
   
  <?php } ?>
  
	<div class="activity-content fs-have-thumbnail">

			<div class="activity-inner">

				<?php if ( bp_activity_has_content() ) { ?>

                    <?php bp_activity_content_body(); ?>

                <?php } else {?>

                    <?php bp_activity_action(); ?>

                <?php } ?>

			</div>

		<?php do_action( 'bp_activity_entry_content' ); ?>

	</div>


		<div class="activity-meta">

			<?php if ( bp_get_activity_type() == 'activity_comment' ) : ?>

				<a href="<?php bp_activity_thread_permalink(); ?>" class="btn-xs text-info button view bp-secondary-action" title="<?php esc_attr_e( 'View Conversation', 'firmasite' ); ?>"><i class="fa fa-comments-o"></i> <?php _e( 'View Conversation', 'firmasite' ); ?></a>

			<?php endif; ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php if ( bp_activity_can_favorite() ) : ?>

					<?php if ( !bp_get_activity_is_favorite() ) : ?>

						<a href="<?php bp_activity_favorite_link(); ?>" class="btn-xs text-info button fav bp-secondary-action" title="<?php esc_attr_e( 'Mark as Favorite', 'firmasite' ); ?>"><i class="fa fa-thumbs-o-up"></i> Like</a>

					<?php else : ?>

						<a href="<?php bp_activity_unfavorite_link(); ?>" class="btn-xs text-info button unfav bp-secondary-action" title="<?php esc_attr_e( 'Remove Favorite', 'firmasite' ); ?>"><i class="fa fa-thumbs-o-down"></i> Unlike</a>

					<?php endif; ?>

				<?php endif; ?>

				<?php if ( bp_activity_can_comment() ) : ?>

					<a href="<?php bp_activity_comment_link(); ?>" class="btn-xs text-info button acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id(); ?>"><i class="fa fa-comment-o"></i> <?php printf( __( 'Comments <span class="label label-info" style="padding: 0.1em 0.3em;font-weight: 400;">%s</span>', 'firmasite' ), bp_activity_get_comment_count() ); ?></a>

				<?php endif; ?>

				<?php if ( bp_activity_user_can_delete() ) bp_activity_delete_link(); ?>

					<?php do_action( 'bp_activity_entry_meta' ); ?>

			<?php endif; ?>



		</div>



	<?php do_action( 'bp_before_activity_entry_comments' ); ?>

	<?php if ( ( bp_activity_get_comment_count() || bp_activity_can_comment() ) || bp_is_single_activity() ) : ?>

		<div class="activity-comments">

			<?php bp_activity_comments(); ?>

			<?php if ( is_user_logged_in() && bp_activity_can_comment() ) : ?>

				<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>
					<?php /* <div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div> */ ?>
					<div class="ac-reply-content">
						<div class="ac-textarea">
							<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input bp-suggestions" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
						</div>
						<input type="submit" class="btn btn-xs btn-success pull-right" name="ac_form_submit" value="<?php esc_attr_e( 'Post', 'firmasite' ); ?>" />
						<?php /* 
							&nbsp; 
							<a href="#" class="ac-reply-cancel">
							_e( 'Cancel', 'firmasite' ); </a> 
						*/ ?>
						<br/>
						<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
					</div>

					<?php do_action( 'bp_activity_entry_comments' ); ?>

					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>

				</form>

			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_activity_entry_comments' ); ?>
 </div></div>
</li>

<?php do_action( 'bp_after_activity_entry' ); ?>
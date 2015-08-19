<?php

/*--------------------------------------*/
/* Comment Layout
/*--------------------------------------*/
			
	// Comment Layout
	function wp_bootstrap_comments($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="clearfix">
				<div class="comment-author vcard clearfix">
					<div class="avatar col-sm-3">
						<?php echo get_avatar( $comment, $size='75' ); ?>
					</div>
					<div class="col-sm-9 comment-text">
						<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
						<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>
	                    
	                    <?php if ($comment->comment_approved == '0') : ?>
	       					<div class="alert-message success">
	          				<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
	          				</div>
						<?php endif; ?>
	                    
	                    <?php comment_text() ?>
	                    
	                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
	                    
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                </div>
				</div>
			</article>
	    <!-- </li> is added by wordpress automatically -->
	<?php
	} // don't remove this bracket!
	
	// Display trackbacks/pings callback function
	function list_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	?>
	        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
	<?php 
	
	}
	

<?php
	
// SLIDER => Customize the position of the meta boxes
add_action('do_meta_boxes', 'slider_move_meta_box');

function slider_move_meta_box(){
    remove_meta_box( 'postimagediv', 'slide', 'side' );
    add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'slide', 'normal', 'high');
}

	
// SMILE GALLERY => Customize the position of the meta boxes
add_action('do_meta_boxes', 'smile_move_meta_box');

function smile_move_meta_box(){
    remove_meta_box( 'postimagediv', 'smile', 'side' );
    add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'smile', 'normal', 'high');
}
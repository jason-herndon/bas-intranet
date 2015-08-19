<?php

// Remove menu item
	function remove_menu_items() {
	  global $menu;
	  $restricted = array( __('Links'), __('Comments'), __('Media'), __('Tools'), __('Settings'));
	  end ($menu);
	  while (prev($menu)){
	    $value = explode(' ',$menu[key($menu)][0]);
	    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
	      unset($menu[key($menu)]);}
	    }
	  }
	add_action('admin_menu', 'remove_menu_items');

// Modify footer
	function modify_footer_admin () {
	  echo 'Created by <a href="http://example.com">Orthopreneur</a>.';
	  echo ' Powered by<a href="http://WordPress.org">WordPress</a>.';
	}
	add_filter('admin_footer_text', 'modify_footer_admin');

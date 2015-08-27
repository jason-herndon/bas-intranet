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

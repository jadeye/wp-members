<?php

/*
 * Plugin Name: User Membership Registration
 * Description: A WordPress plugin to allow users to register
 * Version: 1.0
 * Author: Jadeye
 * Author URI: https://nwg.co.il
 * Text Domain: members
 */

if ( !function_exists( 'add_action')){
	die( "Hi there! I'm just a plugin, not much I can do when called directly.");
}

//define( 'RECIPE_PLUGIN_FOLDER', __FILE__);

// Setup
define( 'MEMBER_PLUGIN_URL', __FILE__);


// Include
include( 'includes/front/enqueue.php');
include( 'includes/member-auth.php');
include( 'process/create-account.php');

// Hooks
add_action( 'wp_enqueue_scripts', 'm_enqueue_scripts', 100);
add_action( 'wp_ajax_nopriv_member_create_account', 'member_create_account');

// Shortcodes
add_shortcode( 'member_auth_form', 'm_member_auth_form_shortcode');
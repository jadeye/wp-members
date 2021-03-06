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

// Setup
define( 'MEMBER_PLUGIN_URL', __FILE__);


// Include
//include( 'includes/activate.php');
include( 'includes/front/enqueue.php');
include( 'includes/member-auth.php');
include( 'process/create-account.php');
include( 'process/member-login.php');
include( 'includes/admin/dashboard-widgets.php');

// Hooks
//register_activation_hook(__FILE__, 'm_activate_plugin');
add_action( 'wp_enqueue_scripts', 'm_enqueue_scripts', 100);
add_action( 'wp_ajax_nopriv_member_create_account', 'member_create_account');
add_action( 'wp_ajax_nopriv_member_user_login', 'member_user_login');
add_action( 'wp_dashboard_setup', 'm_add_dashboard_widgets');

// Shortcodes
add_shortcode( 'member_auth_form', 'm_member_auth_form_shortcode');
<?php
function m_member_auth_form_shortcode(){

	if( is_user_logged_in() ) {
		add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 1 );
		return '';
	}
	$formHTML                   =   file_get_contents(
		'member-auth-template.php',
		true);

	$formHTML                   =   str_replace(
		'NONCE_FIELD_PH',
		wp_nonce_field( "member_auth", "_wpnonce", true, FALSE),
		$formHTML
	);

	$formHTML                  =   str_replace(
		'SHOW_REG_FORM',
		get_option('users_can_register') ? '' : 'style="display:none;"',
		$formHTML
	);

	return $formHTML;
}

function add_loginout_link( $items) {
	$items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
	return $items;
}
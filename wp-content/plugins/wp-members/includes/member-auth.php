<?php
function m_member_auth_form_shortcode(){
	$formHTML                   =   file_get_contents(
		'member-auth-template.php',
		true);

	$formHTML                   =   str_replace(
		'NONCE_FIELD_PH',
		wp_nonce_field( "member_auth", "_wpnonce", true, FALSE),
		$formHTML
	);

	return $formHTML;
}
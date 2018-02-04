<?php

include('output-messages.php');

function member_user_login(){

	$nonce                  =   isset($_POST['_wpnonce']) ? $_POST['_wpnonce'] : '';

	if( !wp_verify_nonce( $nonce, 'member_auth')) {
		compileOutput(1, 'NONCE!');
	}

	if ( ( $_POST['username'] == '') || ($_POST['pass'] == '') ) {
		compileOutput(3, 'Please fill in all the fields!');
	}

	$username               =   sanitize_text_field( $_POST['username']);
	$pass                   =   sanitize_text_field( $_POST['pass']);

	$user                   =   wp_signon([
		'user_login'        =>  $username,
		'user_password'     =>  $pass,
		'remember'          =>  TRUE

	], FALSE);

	if( is_wp_error($user)) {
		compileOutput(4, 'An error has occurred. Please try again!');
	}

	compileOutput(2 , 'You have Logged in successfully!');
}
<?php

function member_create_account(){

	$nonce                  =   isset($_POST['_wpnonce']) ? $_POST['_wpnonce'] : '';

	if( !wp_verify_nonce( $nonce, 'member_auth')) {
		compileOutput(1, 'NONCE!');
	}

	if ( ( $_POST['username'] == '') || ($_POST['email'] == '') || ($_POST['pass'] == '') || ($_POST['confirm_pass'] ) == '') {
		compileOutput(3, 'Please fill in all the fields!');
	}

	$name                   =   sanitize_text_field( $_POST['name']);
	$username               =   sanitize_text_field( $_POST['username']);
	$email                  =   sanitize_email( $_POST['email']);
	$pass                   =   sanitize_text_field( $_POST['pass']);
	$conform_pass           =   sanitize_text_field( $_POST['confirm_pass']);

	if( username_exists( $username ) ) {
		compileOutput(4, 'The username you have chosen already exists!');
	} else if ( email_exists( $email ) ) {
		compileOutput(5, 'The email you have chosen is already registered!');
	} else if ( $pass != $conform_pass ) {
		compileOutput(6, 'The passwords you have entered do not match!');
	} else if ( !is_email($email) ) {
		compileOutput(7, 'The email you have chosen is incorrect!');
	}

	$user_id                =   wp_insert_user([
		'user_login'        =>  $username,
		'user_pass'         =>  $pass,
		'user_email'        =>  $email,
		'user_nicename'     =>  $name
	]);

	if ( is_wp_error( $user_id)) {
		$output                 =   [ 'status' => 1 , 'msg' => 'USER_ID'];
		wp_send_json($output);
	}

	$user                   =   get_user_by( 'id', $user_id);
	wp_set_current_user( $user_id, $user->user_login );
	wp_set_auth_cookie( $user_id, FALSE);
	do_action( 'wp_login', $user->user_login, $user );

	compileOutput(2 , 'Account created successfully!');

}
<?php

function member_create_account(){
	//$output                 =   [ 'status' => 1 , 'msg' => 'ONE'];
	$nonce                  =   isset($_POST['_wpnonce']) ? $_POST['_wpnonce'] : '';

	if( !wp_verify_nonce( $nonce, 'member_auth')) {
		$output = compileOutput(1, 'NONCE!');
		//die(print_r($output));
		wp_send_json($output);
	}

	/*if ( ( $_POST['username'] == '') || ($_POST['email'] == '') || ($_POST['password'] == '') || ($_POST['repassword'] ) == '') {
		$output = compileOutput(3, 'Please fill in all the fields!');
		wp_send_json($output);
	}*/

	$name                   =   sanitize_text_field( $_POST['name']);
	$username               =   sanitize_text_field( $_POST['username']);
	$email                  =   sanitize_email( $_POST['email']);
	$pass                   =   sanitize_text_field( $_POST['pass']);
	$conform_pass           =   sanitize_text_field( $_POST['confirm_pass']);

	if( username_exists( $username ) ) {
		$output = compileOutput(4, 'The username you have chosen already exists!');
		wp_send_json($output);
	} else if ( email_exists( $email ) ) {
		$output = compileOutput(5, 'The email you have chosen is already registered!');
		wp_send_json($output);
	} else if ( $pass != $conform_pass ) {
		$output = compileOutput(6, 'The passwords you have entered do not match!');
		wp_send_json($output);
	} else if ( !is_email($email) ) {
		$output = compileOutput(7, 'The email you have chosen is incorrect!');
		wp_send_json($output);
	}

	// wp_create_user()
	// wp_insert_user()

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

	$output                 =   compileOutput(2 , 'Account created successfully!');
	wp_send_json($output);

	// wp_signon()

}

function compileOutput($code = 1, $msg = '') {
	$output                 =   [
		'status'            => $code,
		'msg'               => $msg
	];
	return $output;
	//wp_send_json($output);
}
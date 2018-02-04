<?php

function compileOutput($code = 1, $msg = '') {
	$output                 =   [
		'status'            => $code,
		'msg'               => $msg
	];
	//return $output;
	wp_send_json($output);
}
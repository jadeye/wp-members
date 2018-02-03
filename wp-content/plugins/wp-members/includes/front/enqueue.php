<?php

function m_enqueue_scripts(){

	wp_register_script(
		'm_main',
		plugins_url( '/assets/scripts/member-main.js', MEMBER_PLUGIN_URL),
		array('jquery'),
		'1.0.0',
		TRUE
	);

	wp_localize_script( 'm_main', 'member_obj', array(
		'ajax_url'              =>  admin_url( 'admin-ajax.php'),
		'home_url'              =>  home_url('/')
	));

	wp_enqueue_script( 'm_main');
}
<?php

function m_add_dashboard_widgets(){
	wp_add_dashboard_widget(
		'm_latest_members_registering_widgets',
		'Latest Members Registering',
		'm_latest_members_registering_display'
	);
}

function m_latest_members_registering_display(){
	global $wpdb;

	$latest_members                 =   $wpdb->get_results(
		"SELECT * FROM `" . $wpdb->prefix . "users` ORDER BY `ID` DESC LIMIT 5 "
	);

	echo '<ul>';

	foreach ( $latest_members as $member ) {
		$user_id                    =   $member->ID;
		$username                   =   $member->user_login;
		$user_email                 =   $member->user_email;

		?>
		<li>
			<a href="<?php echo get_edit_user_link( $user_id ); ?>"><?php echo $username; ?></a>
			Email: <?php echo $user_email; ?>
		</li>
		<?php
	}

	echo '</ul>';
}
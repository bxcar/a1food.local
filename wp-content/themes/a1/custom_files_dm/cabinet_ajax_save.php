<?php
require_once("../../../../wp-load.php");


if(isset($_POST['contact-email'])) {

	update_field('user_email_field', $_POST['contact-email'], 'user_' . get_current_user_id());
    $args = array(
        'ID'         => get_current_user_id(),
        'user_email' => $_POST['contact-email']
    );
    wp_update_user( $args );

	echo json_encode(
	    [
	        'success' => 'true'
	    ]
	);
} else if(isset($_POST['birth-date'])) {

	update_field('user_birth_date_field', $_POST['birth-date'], 'user_' . get_current_user_id());

	echo json_encode(
	    [
	        'success' => 'true'
	    ]
	);
} else if(isset($_POST['contact-name'])) {

	 update_field('user_name_field', $_POST['contact-name'], 'user_' . get_current_user_id());

	 echo json_encode(
	    [
	        'success' => 'true'
	    ]
	);
} else {
	echo json_encode(
	    [
	        'success' => 'false'
	    ]
	);
}
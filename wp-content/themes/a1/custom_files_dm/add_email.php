<?php
require_once("../../../../wp-load.php");

if (isset($_POST['contact-email'])) {
    update_field('user_email_field', $_POST['contact-email'], 'user_' . get_current_user_id());
    $args = array(
        'ID'         => get_current_user_id(),
        'user_email' => $_POST['contact-email']
    );
    wp_update_user( $args );

    echo json_encode(
        [
            'data' => 'success'
        ]
    );
} else {
    echo json_encode(
        [
            'data' => 'email_is_not_set'
        ]
    );
}

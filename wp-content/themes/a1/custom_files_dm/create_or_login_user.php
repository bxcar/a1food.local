<?php
require_once("../../../../wp-load.php");

$user_name = $_POST['user_phone'];
$user_phone_format = $_POST['user_phone_format'];

if(!username_exists( $user_name )) {
    wp_create_user( $user_name, 'standard_user');
}

$user = get_user_by('login', $user_name );
update_field('user_phone_field', $user_phone_format, 'user_'.$user->ID);

// Redirect URL //
if ( !is_wp_error( $user ) )
{
    wp_clear_auth_cookie();
    wp_set_current_user ( $user->ID );
    wp_set_auth_cookie  ( $user->ID );

    /*$redirect_to = user_admin_url();
    wp_safe_redirect( $redirect_to );
    exit();*/
}

echo json_encode(
    [
        'success' => 'true',
    ]
);

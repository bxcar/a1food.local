<?php
require_once("../../../../wp-load.php");

$row = array(
    'street' => $_POST['street'],
    'building'   => $_POST['house'],
    'entrance'  => $_POST['entrance'],
    'floor'  => $_POST['floor'],
    'apartment'  => $_POST['apartment']
);

add_row('user_addresses_list_field', $row, 'user_'.get_current_user_id());


echo json_encode(
    [
        'data' => $_POST
    ]
);

<?php
require_once("../../../../wp-load.php");

if(!$_POST['entrance']) {
    $_POST['entrance'] = 0;
}

if(!$_POST['floor']) {
    $_POST['floor'] = 0;
}

if(!$_POST['apartment']) {
    $_POST['apartment'] = 0;
}

if(!$_POST['comment']) {
    $_POST['comment'] = '';
}

$row = array(
    'street' => $_POST['street'],
    'building'   => $_POST['house'],
    'entrance'  => $_POST['entrance'],
    'floor'  => $_POST['floor'],
    'apartment'  => $_POST['apartment'],
    'comment'  => $_POST['comment']
);

add_row('user_addresses_list_field', $row, 'user_'.get_current_user_id());


echo json_encode(
    [
        'data' => $_POST
    ]
);

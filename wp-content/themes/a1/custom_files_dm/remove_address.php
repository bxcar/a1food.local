<?php
require_once("../../../../wp-load.php");


$row_number = $_POST['row_number'];

delete_row('user_addresses_list_field', $row_number, 'user_'.get_current_user_id());

echo json_encode(
    [
        'success' => 'true'
    ]
);
